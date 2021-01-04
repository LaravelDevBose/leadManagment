<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendData;
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
        $leadBoards = Lead::isOpen()->orderBy('current_step', 'asc')->get()->groupBy('current_step');
        return Inertia::render('Admin/Lead/Index', compact('leadBoards'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function table(Request $request)
    {
        $leads = Lead::isOpen()->searchBy($request)->orderBy('current_step', 'asc')->get();
        $searchKey = !empty($request->search_key)? $request->search_key : '';
        return Inertia::render('Admin/Lead/Table', compact('leads', 'searchKey'));
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

    public function print($id)
    {
        $lead = Lead::findOrFail($id);
        $contactUs = FrontendData::where('key', FrontendData::DataKeys['Contact us'])->first();
        return view('print.lead_print', [
            'lead'=>$lead,
            'contactUs'=>$contactUs
        ]);
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
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
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
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
            'payment_type' => ['required', 'min:1', 'max:255'],
            'lein_holder_info' => ['nullable', 'string'],
        ])->validateWithBag('vehicleForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'current_step'=> $lead->current_step > Lead::Steps['Documentation'] ? $lead->current_step : Lead::Steps['Vehicle'] ,
                'vin_no'=>$request->input('vin_no'),
                'year'=>$request->input('year'),
                'make'=>$request->input('make'),
                'model'=>$request->input('model'),
                'color'=>$request->input('color'),
                'mileage'=>$request->input('mileage'),
                'lein_holder_info'=>$request->input('lein_holder_info'),
                'payment_type'=>$request->input('payment_type'),
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
            'trans_status' => ['required', 'string', 'max:20'],
            'trans_issue' => ['nullable','min:4', 'max:255'],
        ])->validateWithBag('transactionForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'current_step'=> $lead->current_step > Lead::Steps['Special'] ? $lead->current_step : Lead::Steps['Payment'] ,
                'trans_status'=>$request->input('trans_status'),
                'trans_issue'=>$request->input('trans_issue'),
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
                'current_step'=> $lead->current_step > Lead::Steps['Vehicle'] ? $lead->current_step : Lead::Steps['Special'] ,
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
