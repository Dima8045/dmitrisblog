<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Class StorageHelper
 *
 * @package App\Helpers
 */
abstract class StorageHelper
{
    public const PUBLIC_DISK = 'public';

    /**
     * @param string|null $extension
     *
     * @return string
     */
    public static function randomName(?string $extension = null): string
    {
        $name = Str::random(25);

        return $extension ? $name . '.' . $extension : $name;
    }


    /**
     * @param null|string $folder
     * @param bool $autoSubFolder
     * @param string $disk
     *
     * @return false|string
     */
    public static function uploadFile(UploadedFile $file,
        ?string $folder = null,
        bool $autoSubFolder = false,
        string $disk = self::PUBLIC_DISK
    ) {
        $name = $file->getClientOriginalName();

        if ($autoSubFolder) {
            $folder .= '/' . self::prependWithSubFolders($name, true);
        }

        $file->storeAs($folder, $name, ['disk' => $disk]);
        return $name;
    }

    /**
     * @param string $name
     * @param bool   $onlyFolder
     *
     * @return string
     */
    public static function prependWithSubFolders(string $name, bool $onlyFolder = false): string
    {
        $folder = substr($name, 0, 1);

        if (strlen($name) > 1) {
            $folder .= '/' . substr($name, 1, 1);
        }

        return $onlyFolder ? $folder : $folder . '/' . $name;
    }

}