<?php
namespace App\Helper;

class CsrfTokenConst 
{
    static $CSRF_MAIN_TOKEN_NAME = "main_csrf_token";

    public static function getCsrfMainTokenName () {
        return self::$CSRF_MAIN_TOKEN_NAME;
    }
}