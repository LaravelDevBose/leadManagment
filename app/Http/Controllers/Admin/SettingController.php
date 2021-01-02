<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function about_us_page()
    {
        $setting = FrontendData::where('key', FrontendData::DataKeys['About Us'])->first();
        return Inertia::render('Admin/Setting/AboutUsPage', compact('setting'));
    }

    public function contact_us_page()
    {
        $setting = FrontendData::where('key', FrontendData::DataKeys['Contact us'])->first();
        return Inertia::render('Admin/Setting/ContactUsPage', compact('setting'));
    }

    public function about_us_update(Request $request)
    {
        Validator::make($request->all(), [
            'details' => ['required', 'string', 'min:100', 'max:2000'],
        ])->validateWithBag('aboutUsForm');

        try {
            DB::beginTransaction();
            $data = FrontendData::updateOrCreate([
                'key'=>FrontendData::DataKeys['About Us'],
            ],[
                'data'=>json_encode($request->except('_method', 'token')),
            ]);
            if (!empty($data)){
                DB::commit();
                return redirect()->back()->with('success', 'About Us Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function contact_us_update(Request $request)
    {
        Validator::make($request->all(), [
            'address' => ['required', 'string', 'min:10', 'max:200'],
            'email' => ['required', 'email'],
            'phone_no' => ['required', 'string'],
            'fax_no' => ['required', 'string'],
            'open_date' => ['required', 'string'],
            'open_time' => ['required', 'string'],
        ])->validateWithBag('contactUsForm');

        try {
            DB::beginTransaction();
            $data = FrontendData::updateOrCreate([
                'key'=>FrontendData::DataKeys['Contact us'],
            ],[
                'data'=>json_encode($request->except('_method', 'token')),
            ]);
            if (!empty($data)){
                DB::commit();
                return redirect()->back()->with('success', 'Contact Us Updated Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
