<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    public function fileUpload(Request $request, string $fieldName, ?string $oldPath = null, string $dir = 'uploads'): ?String
    {
        // Request has file
        if(!$request->hasFile($fieldName))
        {
            return null;
        }

        // Delete the existing image if have
        if($oldPath && File::exists(public_path($oldPath)))
        {
            File::delete(public_path($oldPath));
        }

        $file = $request->file($fieldName);
        $extension = $file->getClientOriginalExtension();
        $randFileName = Str::random(30) . '.' . $extension;

        $destination = public_path($dir);
        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $randFileName);

        return $randFileName;
    }
}