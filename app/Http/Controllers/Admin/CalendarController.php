<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        $schedules = Schedule::get();
        return Inertia::render('Admin/Calendar/Calendar', compact('schedules'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'start' => ['required','string', 'max:255'],
            'end' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
        ])->validateWithBag('scheduleForm');

        try {
            DB::beginTransaction();
            $schedule = Schedule::create([
                'title'=>$request->input('title'),
                'start'=>date('Y-m-d h:i:s', strtotime($request->input('start'))) ,
                'end'=>date('Y-m-d h:i:s', strtotime($request->input('end'))) ,
                'state'=>$request->input('state'),
                'isAllday'=>!empty($request->input('isAllday')) ? $request->input('isAllday') : 0,
            ]);
            if (!empty($schedule)){
                DB::commit();
                return redirect()->back()->with('success', 'New Schedule Created Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'start' => ['required','string', 'max:255'],
            'end' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
        ])->validateWithBag('scheduleForm');

        try {
            DB::beginTransaction();
            $schedule = Schedule::findOrFail($id);
            $schedule = $schedule->update([
                'title'=>$request->input('title'),
                'start'=>date('Y-m-d h:i:s', strtotime($request->input('start'))),
                'end'=>date('Y-m-d h:i:s', strtotime($request->input('end'))) ,
                'state'=>$request->input('state'),
                'isAllday'=>!empty($request->input('isAllday')) ? $request->input('isAllday') : 0,
            ]);
            if (!empty($schedule)){
                DB::commit();
                return redirect()->back()->with('success', 'Schedule Updated Successfully');
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
            $schedule = Schedule::where('id',intval($id))->firstOrFail();
            if (!empty($schedule) && $schedule->delete()){
                DB::commit();
                return redirect()->back()->with('success', 'Schedule Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
