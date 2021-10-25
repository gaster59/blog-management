<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName   = pathinfo($originName, PATHINFO_FILENAME);
            $extension  = $request->file('upload')->getClientOriginalExtension();
            $fileName   = $fileName . '_' . time() . '.' . $extension;

            $folder = 'images';
            $pathImages = public_path($folder);
            if (!file_exists($pathImages)) {
                // create folder and file index.html
                mkdir($pathImages);
                $disk = Storage::build([
                    'driver' => 'local',
                    'root' => public_path($folder),
                ]);
                $disk->put('index.html', 'deny all');
            }

            $request->file('upload')->move(public_path($folder), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url             = asset($folder . '/' . $fileName);
            $msg             = 'Image successfully uploaded';
            $response        = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
