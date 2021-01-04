<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.lead.index');
    }

    public function get_notifications()
    {
        $notifications = auth()->user()->notifications;
        return response()->json([
            'status'=>200,
            'data'=>[
                'notification'=>$notifications,
                'unread'=> auth()->user()->unreadNotifications->count()
            ]
        ]);
    }

    public function read_notification($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if (!empty($notification)){
            $leadId = $notification->data['lead_id'];
            $notification->update(['read_at'=> now()]);

            return redirect()->route('admin.lead.show', $leadId);
        }else{
            return redirect()->back()->with('error', 'Invalid Lead Information');
        }
    }

    public function read_all_notification()
    {
        $notifications = auth()->user()->unreadNotifications->markAsRead();
        if (!empty($notifications)){
            return redirect()->route('admin.lead.index');
        }else{
            return redirect()->back()->with('error', 'Something wrong. Try Again!');
        }
    }
}
