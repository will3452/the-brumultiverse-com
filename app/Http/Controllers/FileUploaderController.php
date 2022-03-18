<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileUploaderController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = Storage::disk('local')->path("{$file->getClientOriginalName()}");

        File::append($path, $file->get());
        $file = "";
        $isDone = false;
        if ($request->has('is_last') && $request->boolean('is_last')) {
            $name = basename($path, '.part');
            $file = storage_path('app\\public\\' . $name);
            File::move($path, $file);
            $file = $name;
            $isDone = true;
        }

        return response()->json([
            'uploaded' => true,
            'is_done' => $isDone,
            'file' => $file,
        ]);
    }

    public function filePond(Request $request)
    {
        $serverId = uniqid();
        Storage::disk('local')->makeDirectory('tmp/' . $serverId);
        return $serverId;
    }

    public function filePondUpdate(Request $request)
    {
        $file = "tmp/" . $request->patch . DIRECTORY_SEPARATOR . $request->header('Upload-name');
        $path = Storage::disk('local')->path($file);
        File::append($path, $request->getContent());
        return response($request->header('Upload-Offset'), 200, ["Content-Type" => "text/plain"]);
    }

    public function filePondRevert(Request $request)
    {
        $payload = $request->getContent();
        $result = Storage::disk('local')->deleteDirectory("tmp/$payload");
        return $result;
    }
}
