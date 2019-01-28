<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 12:23
 */

class InstanceGenerator
{
    protected static $id = null;

    public static function generate()
    {
        if(!isset(self::$id)) {
            self::$id = new self();
            global $employeeArray;
            $employeeArray = [];
        }
        self::$id++;
        return self::$id;
    }
}