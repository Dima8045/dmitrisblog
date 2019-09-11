<?php

namespace App\Helpers;

/**
 * Class StorageHelper
 *
 * @package App\Helpers
 */
abstract class StorageHelper
{
    /**
     * @param string|null $extension
     *
     * @return string
     */
    public static function randomName(?string $extension = null): string
    {
        $name = str_random(25);

        return $extension ? $name . '.' . $extension : $name;
    }
}