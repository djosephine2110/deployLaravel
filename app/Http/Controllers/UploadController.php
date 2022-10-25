<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $fileUpload = $request->file('file');
        $timestamp = Carbon::now()->timestamp;
        $extension = $fileUpload->clientExtension();
        $filename = $fileUpload->getClientOriginalName();
        $name = "assets/files/uploaded-$filename";
        
        Storage::disk('oss')->put($name, file_get_contents($fileUpload));

        if (Storage::disk('oss')->exists($name)) {
            $fileUrl = "https://cdn.erakomp.co.id/$name";
            User::Where('id',Auth::id())->update([
                'image' => $fileUrl
            ]);
            return response()->json([
                'url' => $fileUrl,
            ]);
            if($fileUrl == null){
                $fileUrl = "no attachment";
                return view('getFileUploaded', compact('fileUrl'));
            }else{
                return view('getFileUploaded', compact('fileUrl'));
            }
        }

        return response()->json([
            'error' => 'Failed to upload file',
        ]);
    }
}
