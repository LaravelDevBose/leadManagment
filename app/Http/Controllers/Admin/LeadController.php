<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class LeadController extends Controller
{
    /**
     * Display a Lead Board of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $leadBoards = Lead::orderBy('current_step', 'asc')->get()->groupBy('current_step');
        return Inertia::render('Admin/Lead/Index', compact('leadBoards'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function table(Request $request)
    {
        $leads = Lead::searchBy($request)->orderBy('current_step', 'asc')->get();
        $searchKey = !empty($request->search_key)? $request->search_key : '';
        return Inertia::render('Admin/Lead/Table', compact('leads', 'searchKey'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return Inertia::render('Admin/Lead/Show', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePersonalInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'max:10'],
        ])->validateWithBag('personalInfoForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'full_name'=>$request->input('full_name'),
                'phone_no'=>$request->input('phone_no'),
                'email'=>$request->input('email'),
                'address'=>$request->input('address'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'postal_code'=>$request->input('postal_code'),
            ]);
            if (!empty($leadU)){
                DB::commit();
                return redirect()->back()->with('success', 'Personal Information Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVehicleInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'vin_no' => ['required', 'string', 'max:20'],
            'year' => ['required','min:4', 'max:4'],
            'make' => ['required', 'min:4', 'max:10'],
            'model' => ['required', 'string', 'max:25'],
            'color' => ['required', 'string', 'max:25'],
            'mileage' => ['required', 'min:1', 'max:255'],
            'lein_holder_info' => ['nullable', 'string'],
        ])->validateWithBag('vehicleForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'current_step'=> $lead->current_step > 1 ? $lead->current_step : 2 ,
                'vin_no'=>$request->input('vin_no'),
                'year'=>$request->input('year'),
                'make'=>$request->input('make'),
                'model'=>$request->input('model'),
                'color'=>$request->input('color'),
                'mileage'=>$request->input('mileage'),
                'lein_holder_info'=>$request->input('lein_holder_info'),
            ]);
            if (!empty($leadU)){
                DB::commit();
                return redirect()->back()->with('success', 'Vehicle Information Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTransactionInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'trans_status' => ['required', 'string', 'max:5'],
            'payment_type' => ['required','min:4', 'max:20'],
        ])->validateWithBag('transactionForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'current_step'=> $lead->current_step > 2 ? $lead->current_step : 3 ,
                'trans_status'=>$request->input('trans_status'),
                'payment_type'=>$request->input('payment_type'),
            ]);
            if (!empty($leadU)){
                DB::commit();
                return redirect()->back()->with('success', 'Transaction Information Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSpecialReqInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'special_note' => ['nullable', 'string', 'min:10'],
        ])->validateWithBag('specialReqForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'current_step'=> $lead->current_step > 3 ? $lead->current_step : 4 ,
                'special_note'=>$request->input('special_note'),
            ]);
            if (!empty($leadU)){
                DB::commit();
                return redirect()->back()->with('success', 'Special Request Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
