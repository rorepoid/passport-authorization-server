<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request)
    {
        $photo = $request->file('avatar')->store(
            "avatars/u/{$request->user()->id}", 'public'
        );
        auth()->user()->update(
            ['avatar' => Storage::url($photo)]
        );
        return response()->json([
            'url' => Storage::url($photo)
        ]);
    }
}
