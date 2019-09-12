<?php


namespace App\Http\Services;


use App\Helpers\StorageHelper;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageService
 * @package App\Http\Services
 */
class ImageService
{
    /**
     * @param UploadedFile $image
     *
     * @return array
     */
    public function upload(UploadedFile $image, $path) : string
    {
        return StorageHelper::uploadFile($image, $path, false);
    }
}