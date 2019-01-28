<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 12:23
 */

class IdGenerator
{
    public static $numb = null;

    public static function generate()
    {
        if(!isset(self::$numb)) {
            self::$numb = 1;
        } else {
            self::$numb +=1;
        }
        return self::$numb;
    }
}