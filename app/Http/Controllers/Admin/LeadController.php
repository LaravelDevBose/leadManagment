<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendData;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

class LeadController extends Controller
{
    /**
     * Display a Lead Board of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $tenDays = Lead::isOpen()->whereDate('created_at', '>', Carbon::today()->subDays(10))->get();
        $tDays = Lead::isOpen()
        ->whereDate('created_at', '>', Carbon::today()->subDays(20))
        ->whereDate('created_at', '<', Carbon::today()->subDays(11))
        ->get();
        $allDays = Lead::isOpen()
        ->whereDate('created_at', '<', Carbon::today()->subDays(20))
        ->get();
        return Inertia::render('Admin/Lead/Index', compact('tenDays', 'tDays', 'allDays'));
    }

    /**
     * Display a Lead Board of the resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Lead/Create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone_no' => ['required', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'max:10'],
        ])->validateWithBag('leadForm');

        try {
            DB::beginTransaction();
            $lead = Lead::create([
                'current_step'=> Lead::Steps['Documentation'],
                'first_name'=>!empty($request->input('first_name'))? $request->input('first_name') :'',
                'last_name'=>!empty($request->input('last_name'))? $request->input('last_name') : '',
                'sec_client_first_name'=>!empty($request->input('sec_client_first_name'))? $request->input('sec_client_first_name') : '',
                'sec_client_last_name'=>!empty($request->input('sec_client_last_name'))? $request->input('sec_client_last_name') : '',
                'dealer_name'=>!empty($request->input('dealer_name'))? $request->input('dealer_name') : '',
                'phone_no'=>$request->input('phone_no'),
                'email'=>!empty($request->input('email'))? $request->input('email') :'',
                'address'=>$request->input('address'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'postal_code'=>$request->input('postal_code'),
            ]);
            if (!empty($lead)){
                $lead->logs()->create([
                    'user_id'=> auth()->id(),
                    'lead_step'=> Lead::Steps['Documentation'],
                    'log_message'=> 'Client Documentation Added By '. auth()->user()->name,
                ]);
                DB::commit();
                return redirect()->route('admin.lead.show', $lead->lead_id)->with('success', 'New Lead Created Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function table(Request $request)
    {
        $leads = Lead::searchBy($request)->orderBy('current_step', 'asc')->orderBy('first_name', 'asc')->paginate(30);

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
        $lead = Lead::with('logs')->where('lead_id', $id)->firstOrFail();
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
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone_no' => ['required', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'max:10'],
        ])->validateWithBag('personalInfoForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $leadU =$lead->update([
                'first_name'=>!empty($request->input('first_name'))? $request->input('first_name') : '',
                'last_name'=>!empty($request->input('last_name'))? $request->input('last_name') : '',
                'sec_client_first_name'=>!empty($request->input('sec_client_first_name'))? $request->input('sec_client_first_name') : '',
                'sec_client_last_name'=>!empty($request->input('sec_client_last_name'))? $request->input('sec_client_last_name') : '',
                'dealer_name'=>!empty($request->input('dealer_name'))? $request->input('dealer_name') : '',
                'phone_no'=>$request->input('phone_no'),
                'email'=>!empty($request->input('email'))? $request->input('email'): '',
                'address'=>$request->input('address'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'postal_code'=>$request->input('postal_code'),
            ]);
            if (!empty($leadU)){
                $lead->logs()->create([
                    'user_id'=> auth()->id(),
                    'lead_step'=> Lead::Steps['Documentation'],
                    'log_message'=> 'Client Documentation Updated By '. auth()->user()->name,
                ]);
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
                'current_step'=> $lead->current_step > Lead::Steps['Documentation'] ? $lead->current_step : Lead::Steps['Vehicle'] ,
                'vin_no'=>$request->input('vin_no'),
                'year'=>$request->input('year'),
                'make'=>$request->input('make'),
                'model'=>$request->input('model'),
                'color'=>$request->input('color'),
                'mileage'=>$request->input('mileage'),
                'lein_holder_info'=>$request->input('lein_holder_info'),
            ]);
            if (!empty($leadU)){
                $lead->logs()->create([
                    'user_id'=> auth()->id(),
                    'lead_step'=> Lead::Steps['Vehicle'],
                    'log_message'=> 'Client Vehicle Info Updated By '. auth()->user()->name,
                ]);
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
        $validation = Validator::make($request->all(), [
            'trans_status' => ['required', 'string', 'max:20'],
            'payment_type' => ['nullable', 'min:1', 'max:255'],
            'trans_type' => ['required','min:4', 'max:255'],
        ]);
        $validation->sometimes([
            'trans_status_extra',
            'trans_status_extra.dmv_tracking'],
            [
                'required', 'string'
            ],
            function($input){
                    return $input->trans_issue == 'At DMV';
        });
        $validation->sometimes([
            'trans_status_extra',
            'trans_status_extra.complete_plate',
            ], [ 'required', 'string' ], function($input){  return $input->trans_issue == 'Completed'; });

        $validation->sometimes([
            'trans_status_extra',
            'trans_status_extra.issue_note',
            ], [ 'required', 'string' ], function($input){  return $input->trans_issue == 'Issue'; });

        $validation->sometimes([
            'payment_type_extra',
            'payment_type_extra.amount',
            'payment_type_extra.type',
            ], [ 'required'], function($input){  return !empty($input->payment_type); });

        $validation->validateWithBag('transactionForm');

        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            $paymentExtra = $lead->payment_type_extra;

            if(!empty($request->payment_type)){
                if(empty($paymentExtra) || !is_array($paymentExtra)){
                    $paymentExtra = array();
                }
                array_push($paymentExtra, [
                    'payment_type'=> $request->payment_type,
                    'track_no'=> $request->payment_type_extra['track_no'],
                    'amount'=> $request->payment_type_extra['amount'],
                    'type'=> $request->payment_type_extra['type'],
                ]);
            }

            $transExtra = $lead->trans_status_extra;

            if(!empty($request->trans_status)){
                if(empty($transExtra) || !is_array($transExtra)){
                    $transExtra = array();
                }
                array_push($transExtra, [
                    'trans_status'=> $request->trans_status,
                    'trans_type'=> $request->trans_type,
                    'trans_date'=> !empty($request->trans_status_extra['trans_date'])? $request->trans_status_extra['trans_date'] : now(),
                    'dmv_tracking'=> !empty($request->trans_status_extra['dmv_tracking'])? $request->trans_status_extra['dmv_tracking'] : '',
                    'complete_plate'=> !empty($request->trans_status_extra['complete_plate'])? $request->trans_status_extra['complete_plate'] : '',
                    'issue_note'=> !empty($request->trans_status_extra['issue_note'])? $request->trans_status_extra['issue_note'] : '',
                ]);
            }

            $leadU =$lead->update([
                'current_step'=> $lead->current_step > Lead::Steps['Vehicle'] ? $lead->current_step : Lead::Steps['Payment'] ,
                'trans_status'=>$request->input('trans_status'),
                'payment_type'=>!empty($request->input('payment_type'))? $request->input('payment_type') : '',
                'trans_type'=>$request->input('trans_type'),
                'trans_status_extra'=> json_encode($transExtra),
                'payment_type_extra'=> json_encode($paymentExtra),
                // 'lead_status'=> $request->input('trans_status') == 'Completed' ? Lead::Status['Closed'] : Lead::Status['Open']
            ]);
            if (!empty($leadU)){
                $lead->logs()->create([
                    'user_id'=> auth()->id(),
                    'lead_step'=> Lead::Steps['Payment'],
                    'log_message'=> 'Client Payment Info Updated By '. auth()->user()->name,
                ]);
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
                'current_step'=> $lead->current_step > Lead::Steps['Payment'] ? $lead->current_step : Lead::Steps['Special'] ,
                'special_note'=>$request->input('special_note'),
            ]);
            if (!empty($leadU)){
                $lead->logs()->create([
                    'user_id'=> auth()->id(),
                    'lead_step'=> Lead::Steps['Special'],
                    'log_message'=> 'Client Special Request Info Updated By '. auth()->user()->name,
                ]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($id);
            if (!empty($lead) && $lead->delete()){
                DB::commit();
                return redirect()->back()->with('success', 'Lead Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function make_complete_lead($leadId)
    {
        try {
            DB::beginTransaction();
            $lead = Lead::findOrFail($leadId);

            $leadU = $lead->update([
                'lead_status'=> Lead::Status['Closed'],
            ]);
            if (!empty($leadU)){
                DB::commit();
                return redirect()->back()->with('success', 'Lead Mark as Completed Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
