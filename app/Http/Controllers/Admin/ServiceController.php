<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::latest()->get();
        return Inertia::render('Admin/Service/Index', compact('services'));
    }

    public function create()
    {
        return Inertia::render('Admin/Service/CreateUpdate');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'service_title' => ['required', 'string', 'max:255'],
            'service_icon' => ['required','string', 'max:255'],
            'service_details' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('serviceForm');

        try {
            DB::beginTransaction();
            $service = Service::create([
                'service_title'=>$request->input('service_title'),
                'service_icon'=>$request->input('service_icon'),
                'service_details'=>$request->input('service_details'),
            ]);
            if (!empty($service)){
                DB::commit();
                return redirect()->route('admin.services.index')->with('success', 'Service Created Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return Inertia::render('Admin/Service/CreateUpdate', compact('service'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'service_title' => ['required', 'string', 'max:255'],
            'service_icon' => ['required','string', 'max:255'],
            'service_details' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('serviceForm');

        try {
            DB::beginTransaction();

            $service = Service::findOrFail($id);

            $service = $service->update([
                'service_title'=>$request->input('service_title'),
                'service_icon'=>$request->input('service_icon'),
                'service_details'=>$request->input('service_details'),
            ]);
            if (!empty($service)){
                DB::commit();
                return redirect()->route('admin.services.index')->with('success', 'Service Updated Successfully');
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
            $service = Service::findOrFail($id);
            if (!empty($service) && $service->delete()){
                DB::commit();
                return redirect()->back()->with('success', 'Service Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
