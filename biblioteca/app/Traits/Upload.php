<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait Upload {
    /**
     * @param object $image
     * @param string $table
     */

    private function imageUpload($image, $directory)
    {

        $uploadedImage = $image->store($directory, 'public');

        return $uploadedImage;
    }
}
