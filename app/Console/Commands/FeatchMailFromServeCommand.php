<?php

namespace App\Console\Commands;

use App\Models\Mail;
use App\Models\MailFolder;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\FolderFetchingException;
use Webklex\PHPIMAP\Folder;
use Webklex\PHPIMAP\Message;

class FeatchMailFromServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Mail From Server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        Log::info(now().': Start Fetching Mail ...');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var Client $client */
        $client = Client::account("default");
        try {
            $client->connect();
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        /** @var Folder $folder */
        try {
            $folderName = MailFolder::whereTime('last_fetch','<=', Carbon::now()->subMinutes(10))->first();
            if(!empty($folderName)){
                $folder = $client->getFolder($folderName->name);
            }
            
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        } catch (FolderFetchingException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        try {
            if(!empty($folder)){
                echo 'Featching.....';
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
                        'folder_id'=> $folderName->id,
                    ]);
                    Log::info(json_encode($mail));
                    //echo $oMessage->getHTMLBody(true);
                }
                $folderName->update([
                    'last_fetch'=> now()
                ]);
                echo '\t Done';
            }else{
                Log::error('Folder Not Found');
                return 0;
            }
            
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        return 0;
    }

    // /**
    //  * Execute the console command.
    //  *
    //  * @return int
    //  */
    // public function handle()
    // {
    //     /** @var Client $client */
    //     $client = Client::account("default");
    //     try {
    //         $client->connect();
    //     } catch (ConnectionFailedException $e) {
    //         Log::error($e->getMessage());
    //         return 1;
    //     }

    //     /** @var Folder $folder */
    //     try {
    //         $folderName = MailFolder::whereTime('last_fetch','<=', Carbon::now()->subMinutes(2))->first();
    //         if(!empty($folderName)){
    //             $folder = $client->getFolder($folderName->name);
    //         }
            
    //     } catch (ConnectionFailedException $e) {
    //         Log::error($e->getMessage());
    //         return 1;
    //     } catch (FolderFetchingException $e) {
    //         Log::error($e->getMessage());
    //         return 1;
    //     }

    //     try {
    //         if(!empty($folder)){
    //             $messages = $folder->messages()->all()->paginate(15);
    //             foreach($messages as $oMessage){
    //                 $mail = Mail::firstOrCreate([
    //                     'uuid'=> $oMessage->uid,
    //                 ], [
    //                     'subject'=> json_encode($oMessage->getSubject()),
    //                     'from'=> json_encode($oMessage->getFromAddress()),
    //                     'text_body'=> json_encode($oMessage->getTextBody()),
    //                     'date'=> json_encode($oMessage->getDate()),
    //                     'folder_id'=> $folderName->id,
    //                 ]);
    //                 Log::info(json_encode($mail));
    //                 //echo $oMessage->getHTMLBody(true);
    //             }
    //             $folderName->update([
    //                 'last_fetch'=> now()
    //             ]);
    //         }else{
    //             Log::error('Folder Not Found');
    //             return 0;
    //         }
            
    //     } catch (ConnectionFailedException $e) {
    //         Log::error($e->getMessage());
    //         return 1;
    //     }

    //     return 0;
    // }
}
