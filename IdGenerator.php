<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 12:23
 */

class IdGenerator
{
    protected static $id = null;

    public static function generate()
    {
        if(!isset(self::$id)) {
            self::$id = 1;
            global $employeeArray;
            $employeeArray = [];
        } else {
            self::$id +=1;
        }
        return self::$id;
    }
}