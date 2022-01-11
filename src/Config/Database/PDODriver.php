<?php


namespace App\Config\Database;


class PDODriver implements IDriver
{
    private static $_handel;
    private static $_instance;

    public function __construct()
    {
        self::init();
    }

    static function init()
    {
        try {
            self::$_handel = new \PDO(
                'mysql:host=' . DATABASE_HOST . ';port=' . DATABASE_PORT . ';dbname=' . DATABASE_NAME,
                DATABASE_USERNAME,
                DATABASE_PASSWORD,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            );
        } catch (\PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }

    static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance =  new self();
        }

        return self::$_instance;
    }

    static function getConnection()
    {
        return self::$_handel;
    }
}