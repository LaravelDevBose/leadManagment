<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->latest()->get();
        return Inertia::render('Admin/User/Index', compact('users'));
    }

    public function create()
    {
        $roles = array_flip(User::Roles);
        return Inertia::render('Admin/User/CreateUpdate', compact('roles'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role'=>['required']
        ])->validateWithBag('userFormBag');

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'=>$request->role
            ]);
            if (!empty($user)){
                DB::commit();
                return redirect()->route('admin.users.index')->with('success', 'User Created Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function show(Request $request,$id)
    {
        $userInfo = User::findOrFail($id);
        $attendances = UserAttendance::where('user_id', $id)->searchBy($request)->latest()->get();
        return Inertia::render('Admin/User/Show', compact('userInfo', 'attendances'));
    }

    public function edit($id)
    {
        $userdata = User::findOrFail($id);
        $roles = array_flip(User::Roles);
        return Inertia::render('Admin/User/CreateUpdate', compact('userdata', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'=>['required']
        ])->validateWithBag('userFormBag');

        try {
            DB::beginTransaction();

            if (isset($request->photo)) {
                $user->updateProfilePhoto($request->photo);
            }

            $user = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role'=>$request->role
            ]);
            if (!empty($user)){
                DB::commit();
                return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            if (!empty($user)){
                $user->deleteProfilePhoto();
                $user->tokens->each->delete();
                $user->delete();
                DB::commit();
                return redirect()->back()->with('success', 'User Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
