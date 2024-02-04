<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadPhotoTrait
{
    public function UploadPhoto(Request $request, $folderName, $fileName)
    {
        $request->validate([
            $fileName => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if (!empty($request->photo)) {
            return $this->errorResponse('error',401);
        }
         else {
            $path = $this->UploadPhoto($request, 'folderName', 'fileName');

            return $this->errorResponse('There was an error adding this image',401);
          // $path = null;
        }
        $photo = time() . '.' . $request->file($fileName)->getClientOriginalName();
        $path = $request->file($fileName)->storeAs($folderName, $photo, 'Bas_images');
        return $path;
    }


}
