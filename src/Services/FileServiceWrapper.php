<?php

namespace App\Services;

use resource;

class FileServiceWrapper
{
    /**
     * @param string $filename
     * @param bool $use_include_path
     * @param resource|null $context
     * @param int $offset
     * @param int|null $length
     * @return string|false
     */
    public function fileGetContents(string $filename, bool $use_include_path = false, $context = null, int $offset = 0, ?int $length = null)
    {
        return file_get_contents($filename, $use_include_path, $context, $offset, $length);
    }

    /**
     * @param string $fileName
     * @param int $flags
     * @param resource|null $context
     * @return array|false
     */
    public function file(string $fileName, int $flags = 0, $context = null)
    {
        return file($fileName, $flags, $context);
    }
}