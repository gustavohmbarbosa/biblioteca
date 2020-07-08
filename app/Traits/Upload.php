<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait Upload {
    /**
     * @param object $image
     * @param string $table
     */

    private function imageUpload($image, $table)
    {

        switch ($table) {
            case 'books':
                $uploadedImage = $image->store('book_cape', 'public');
                break;

            case 'readers':
                $uploadedImage = $image->store('reader_photo', 'public');
                break;

            default:
                break;
        }

        return $uploadedImage;
    }
}
