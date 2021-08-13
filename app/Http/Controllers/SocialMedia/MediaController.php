<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function uploadArticleImage(Request $request)
    {
        $img = Image::make($request->upload)->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('jpg', 80);

        $name = \time() . '.jpg';

        Storage::disk('posts')->put($name, $img);

        return \response()->json([
            'url' => Storage::disk('posts')->url($name),
        ]);
    }

    public function download(Media $media)
    {
        return response()->download($media->getPath(), $media->name);
    }
}
