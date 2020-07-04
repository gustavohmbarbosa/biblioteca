<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait Upload {
    private function imageUpload($image)
    {

        $uploadedImage = $image->store('book_cape', 'public');

        return $uploadedImage;
    }
}
