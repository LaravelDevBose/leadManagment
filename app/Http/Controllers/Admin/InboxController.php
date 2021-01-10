<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendAdminMail;
use App\Models\Inbox;
use App\Models\Mail as ModelsMail;
use App\Models\MailFolder;
use App\Models\Service;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Webklex\IMAP\Facades\Client;
use Carbon\Carbon;

class InboxController extends Controller
{

    use HelperTrait;
    public function index(Request $request, $folderName)
    {
        $folders = MailFolder::get();
        if($folderName == 'All Mail'){
            $inboxes = ModelsMail::paginate(20);
        }else{
            $ufolder = MailFolder::where('name', $folderName)->whereTime('last_fetch','<=', Carbon::now()->subMinutes(10))->first();
            if(!empty($ufolder)){
                $client = Client::account("default");
                $client->connect();
                $folder = $client->getFolder($ufolder->name);
                if(!empty($folder)){
                    $messages = $folder->messages()->all()->get();
                    foreach($messages as $oMessage){
                        $mail = Mail::firstOrCreate([
                            'message_id'=> $oMessage->message_id
                        ], [
                            'message_no'=> $oMessage->message_no,
                            'uuid'=> $oMessage->uid,
                            'subject'=> $oMessage->subject,
                            'to'=> $oMessage->to,
                            'from'=> $oMessage->from,
                            'text_body'=> json_encode($oMessage->getTextBody()),
                            'date'=> $oMessage->date,
                            'folder_id'=> $ufolder->id,
                        ]);
                    }
                    $ufolder->update([
                        'last_fetch'=> now()
                    ]);
                    
                }
            }
            $inboxes = ModelsMail::where('folder_id', $ufolder->id)->paginate(20);
        }
        return Inertia::render('Admin/Email/Inbox', compact('inboxes', 'folders', 'folderName'));
    }

    public function details($folderName, $id){
        $mail = ModelsMail::where('message_id', $id)->firstOrFail();
        $oClient = Client::account('default');
        $oClient->connect();
        $oFolder = $oClient->getFolder($folderName);
        $messages = $oFolder->query()
        ->markAsRead()
        ->whereMessageId('<'.$id.'>')
        ->get();
        $sMail = [];
        foreach($messages as $message){
            $sMail = [
                'to'=> $mail->to,
                'subject'=> $mail->subject,
                'from'=> $mail->from,
                'text_body'=> $message->getTextBody(),
                'html_body'=>$message->getHTMLBody(true) ,
                'date'=> $mail->date,
            ];
        };
        return response()->json(
            [
                'status'=> 200,
                'data'=> $sMail,
            ]
        );
    }

    public function moveToTrash($folderName, $id)
    {
        $mail = ModelsMail::where('message_id', $id)->firstOrFail();
        $oClient = Client::account('default');
        $oClient->connect();
        $oFolder = $oClient->getFolder($folderName);
        $messages = $oFolder->query()
        ->markAsRead()
        ->whereMessageId('<'.$id.'>')
        ->get();
        
        foreach($messages as $message){
            //  imap_mail_move($oClient->getConnection(), $message->uid, 'Trash', CP_UID);
            if($message->move('[Gmail]/Trash') == true){
                sleep(5);
                $oClient->expunge();
                $folderi = MailFolder::where('name', 'Trash')->first();
                $mail->update([
                    'folder_id'=>$folderi->id
                ]);
                return redirect()->route('admin.email.inbox', $folderName)->with('success', 'Mail Deleted Successfully');
            }else{
                return redirect()->route('admin.email.inbox', $folderName)->with('error',  'Message could not be moved'); ;
            }
            break;
        };
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
                return redirect()->route('admin.email.inbox', 'INBOX')->with('success', 'Email Send Successfully');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function destroy($folderName, $id)
    {
        $mail = ModelsMail::where('message_id', $id)->firstOrFail();
        $oClient = Client::account('default');
        $oClient->connect();
        $oFolder = $oClient->getFolder($folderName);
        $messages = $oFolder->query()
        ->markAsRead()
        ->whereMessageId('<'.$id.'>')
        ->get();
        
        foreach($messages as $message){
            //  imap_mail_move($oClient->getConnection(), $message->uid, 'Trash', CP_UID);
            if($message->delete() == true){
                sleep(5);
                $oClient->expunge();
                $mail->delete();
                return redirect()->route('admin.email.inbox', $folderName)->with('success', 'Mail Restored Successfully');
            }else{
                return redirect()->route('admin.email.inbox', $folderName)->with('error',  'Message could not be Restored'); ;
            }
            break;
        };
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
