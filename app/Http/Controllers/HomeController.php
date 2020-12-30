<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index()
    {
        return view('welcome');
    }


    public function lead_register()
    {
        return Inertia::render('Frontend/CustomerRegister');
    }

    public function thank_you_page()
    {
        return Inertia::render('Frontend/ThankYouPage');
    }

    public function store_lead_info(Request $request)
    {
        Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'max:10'],
        ])->validateWithBag('registerLead');

        try {
            DB::beginTransaction();
            $lead = Lead::create([
                'current_step'=>1,
                'full_name'=>$request->input('full_name'),
                'phone_no'=>$request->input('phone_no'),
                'email'=>$request->input('email'),
                'address'=>$request->input('address'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'postal_code'=>$request->input('postal_code'),
            ]);
            if (!empty($lead)){
                DB::commit();
                return redirect()->route('thank.you');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
