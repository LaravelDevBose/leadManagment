<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return Inertia::render('Admin/Testimonial/Index', compact('testimonials'));
    }

    public function create()
    {
        return Inertia::render('Admin/Testimonial/CreateUpdate');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'client_name' => ['required', 'string', 'max:255'],
            'testimonial_details' => ['required','string', 'max:255'],
        ])->validateWithBag('testimonialForm');

        try {
            DB::beginTransaction();
            $testimonial = Testimonial::create([
                'client_name'=>$request->input('client_name'),
                'testimonial_details'=>$request->input('testimonial_details'),
            ]);
            if (!empty($testimonial)){
                DB::commit();
                return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return Inertia::render('Admin/Testimonial/CreateUpdate', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'client_name' => ['required', 'string', 'max:255'],
            'testimonial_details' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('testimonialForm');

        try {
            DB::beginTransaction();

            $testimonial = Testimonial::findOrFail($id);

            $testimonial = $testimonial->update([
                'client_name'=>$request->input('client_name'),
                'testimonial_details'=>$request->input('testimonial_details'),
            ]);
            if (!empty($testimonial)){
                DB::commit();
                return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Updated Successfully');
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
            $testimonial = Testimonial::findOrFail($id);
            if (!empty($testimonial) && $testimonial->delete()){
                DB::commit();
                return redirect()->back()->with('success', 'Testimonial Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
