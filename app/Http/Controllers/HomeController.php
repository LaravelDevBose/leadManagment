<?php

namespace App\Http\Controllers;

use App\Models\ContactUsMessage;
use App\Models\Lead;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use App\Notifications\NewLeadRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index()
    {
        $services = Service::get();
        $testimonials = Testimonial::latest()->get();
        return view('welcome', compact('services', 'testimonials'));
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
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
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'phone_no'=>$request->input('phone_no'),
                'email'=>$request->input('email'),
                'address'=>$request->input('address'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'postal_code'=>$request->input('postal_code'),
            ]);
            if (!empty($lead)){
                DB::commit();
                $admins = User::all();
                Notification::send($admins, new NewLeadRegistered($lead->fresh()));
                return redirect()->route('thank.you');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function store_contact_us_message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone_no' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);
        if ($validator->passes()){
            try {
                DB::beginTransaction();
                $message = ContactUsMessage::create([
                    'first_name'=>$request->input('first_name'),
                    'last_name'=>$request->input('last_name'),
                    'phone_no'=>$request->input('phone_no'),
                    'email'=>$request->input('email'),
                    'message'=>$request->input('message'),
                ]);
                if (!empty($message)){
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'statusText'=>'Success',
                    ]);
                }
            }catch (\Exception $exception){
                DB::rollBack();
                return response()->json([
                    'status'=>400,
                    'statusText'=>'Error',
                    'message'=>$exception->getMessage()
                ]);
            }
        }else{
            $errors = array_values($validator->errors()->getMessages());
            $message = null;
            foreach ($errors as $error){
                if(!empty($error)){
                    foreach ($error as $errorItem){
                        $message .=  $errorItem .'<br>';
                    }
                }
            }
            return response()->json([
                'status'=>400,
                'statusText'=>'Error',
                'message'=>$message,
            ]);
        }
    }
}
