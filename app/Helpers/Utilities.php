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

    /**
     * Get current date
     * 
     * @return string 
     */
    public static function getCurrentDate(): string
    {
        return date("Y-m-d H:i:s");
    }
}
