<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait Upload {

    /**
     * Upload Image
     * 
     * @param object $image
     * @param string $directory
     */
    private function imageUpload($image, $directory)
    {

        $uploadedImage = $image->store($directory, 'public');

        return $uploadedImage;
    }
}
