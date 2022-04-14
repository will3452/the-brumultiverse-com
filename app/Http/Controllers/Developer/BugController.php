<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\AvatarAsset;
use App\Models\AvatarBase;
use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BugController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'uri' => 'required',
            'problem' => 'required',
            'replacement' => ''
        ]);
        Bug::create($data);
        return back()->withSuccess('bugs submitted!');
    }

    public function bugs()
    {
        $bugs = Bug::get();
        return view('dev.bugs', compact('bugs'));
    }

    public function markAsFixed(Request $request, Bug $bug)
    {
        $bug->update([
            'status' => Bug::STATUS_FIXED,
        ]);

        return back();
    }

    public function downloadAssets()
    {
        $zipFileName = "avatarasset.zip";
        $zip = new ZipArchive;

        $basesPath = AvatarBase::get()->pluck('path');
        $assetsPath = AvatarAsset::get()->pluck('path');
        $zipFilePath = Storage::disk('public')->path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE)) {
            foreach ($basesPath as $path) {
                $zip->addFile(Storage::disk('public')->path($path), $path);
            }

            foreach ($assetsPath as $path) {
                $zip->addFile(Storage::disk('public')->path($path), $path);
            }

            $zip->close();
        }

        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];

        if (file_exists($zipFilePath)) {
            return response()->download($zipFilePath, $zipFileName, $headers);
        }
    }
}
