<?php

namespace App\Services;

use Yish\Generators\Foundation\Service\Service;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    protected $repository;

    public function multiple_images($images, $path)
    {
        foreach($images as $file){
 
            //get filename with extension
            $filenamewithextension = $file->getClientOriginalName();
 
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
            //get file extension
            $extension = $file->getClientOriginalExtension();
 
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('public/images/'.$path.'/'.$filenametostore, fopen($file, 'r+'));
 
            //Resize image here
            $thumbnailpath = public_path('storage/images/'.$path.'/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(600, null, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }
    }
}
