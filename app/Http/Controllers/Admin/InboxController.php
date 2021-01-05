<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendAdminMail;
use App\Models\Inbox;
use App\Models\Service;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class InboxController extends Controller
{

    use HelperTrait;

    public function index(Request $request)
    {
        $inboxes = Inbox::searchBy($request)->with('user')->latest()->paginate(30);
        return Inertia::render('Admin/Email/Inbox', compact('inboxes'));
    }

    public function send_mail(Request $request)
    {
        Validator::make($request->all(), [
            'mail_tos' => ['required', 'array'],
            'mail_tos.*'=>['required', 'string', 'email'],
            'mail_ccs' => ['nullable','array'],
            'mail_ccs.*'=>['required', 'string', 'email'],
            'mail_subject' => ['nullable', 'string'],
            'mail_body' => ['required', 'string',],
            'mail_attachments' => ['nullable', 'array'],
        ])->validateWithBag('sendMailBag');

        try {
            DB::beginTransaction();
            $attachments = array();
            if (!empty($request->mail_attachments) && count($request->mail_attachments) > 0 && !empty($request->mail_attachments[0])){
                foreach ($request->mail_attachments as $attachment){
                    array_push($attachments, $this->store_attachment($attachment));
                }
            }
            $inbox = Inbox::create([
                'mail_tos'=>json_encode($request->input('mail_tos')),
                'mail_ccs'=>!empty($request->input('mail_ccs')) ? json_encode($request->input('mail_ccs')) : '',
                'mail_subject'=> !empty($request->input('mail_subject')) ? $request->input('mail_subject') : ' ',
                'mail_body'=>$request->input('mail_body'),
                'sender_id'=> auth()->id(),
                'mail_attachments'=> json_encode($attachments),
            ]);
            if (!empty($inbox)){
                DB::commit();
                Mail::send(new SendAdminMail($inbox->fresh()));
                return redirect()->route('admin.email.inbox')->with('success', 'Email Send Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $inboxes = Inbox::whereIn('id', $request->ids)->get();
            if (!empty($inboxes) && Inbox::whereIn('id', $request->ids)->delete()){
                DB::commit();
                return redirect()->route('admin.email.inbox')->with('success', 'Mail Deleted Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }
}


/*$emails = $request->input('mail_tos');
$ccs = $request->input('mail_ccs');
$subject = !empty($request->input('mail_subject'))? $request->input('mail_subject') : 'Email from'.config('app.name');
$body = $request->input('mail_body');
Mail::send([],[], function($message) use ($emails, $ccs, $subject, $body, $attachments) {
    $message->to($emails)
        ->cc($ccs)
        ->subject($subject)
        ->setBody($body, 'text/html');
    foreach ($attachments as $key => $attachment){
        $message->attach(asset('storage/'.$attachment));
    }
    return $message;
});*/
