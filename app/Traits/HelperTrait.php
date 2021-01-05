<?php
/*
* Author: Arup Kumer Bose
* Email: arupkumerbose@gmail.com
* Company Name: Brainchild Software <brainchildsoft@gmail.com>
*/

namespace App\Traits;


use App\Helpers\AttachmentHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait HelperTrait
{
    function checkDir($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->checkDir($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    public function store_attachment($file)
    {
        $ext = $file->guessExtension();
        $original_name = $file->getClientOriginalName();

        $name =  md5(rand(1111, 9999). time()) .'.'.$ext;

        $name_full = 'attachments/' . $name;
        Storage::disk(config('filesystems.default'))->put( $name_full, File::get($file));
        return[
            'path'=>$name_full,
            'file_name'=> $original_name
        ];
    }
}
