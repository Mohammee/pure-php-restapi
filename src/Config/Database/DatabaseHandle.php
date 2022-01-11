<?php

namespace App\Config\Database;

abstract class DatabaseHandle
{
    private static $conn;

    public static function factory(IDriver $driver)
    {
        if (!isset(self::$conn)) {
           return  $driver->getConnection();
        }
        return self::$conn;
    }


}
