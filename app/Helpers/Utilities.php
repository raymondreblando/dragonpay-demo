<?php

namespace App\Helpers;

class Utilities
{
    /**
     * Generate alphanumeric characters
     * 
     * @return string
     */
    public static function generateAlphaNum(): string
    {
        $uniqueId = uniqid();
        return substr(md5($uniqueId), 0, 16);
    }
}
