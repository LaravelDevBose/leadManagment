<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ContactUsMessageController extends Controller
{
    public function index()
    {
        $messages = ContactUsMessage::latest()->get();
        return Inertia::render('Admin/ContactUsMessage/Index', compact('messages'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $message = ContactUsMessage::findOrFail($id);
            if (!empty($message) && $message->delete()){
                DB::commit();
                return redirect()->back()->with('success', 'Message Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}
