<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Uploader
{
    public function uploadImage($dir, $file)
    {
        $result = null;
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move($dir, $namaFile);
        $result = $namaFile;
        return $result;
    }
}