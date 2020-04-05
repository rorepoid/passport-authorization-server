<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoUploadController extends Controller
{
    public function store(Request $request)
    {
        $local_disk = Storage::disk('public');
        $file = $request->file;
        $photo = $file->store('avatar', 'public');
        $local_disk->setVisibility($photo, 'public');
        $url = $local_disk->url($photo);
        return response()->json([
            'url' => $url
        ]);
    }
}
