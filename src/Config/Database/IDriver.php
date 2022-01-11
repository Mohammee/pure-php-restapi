<?php


namespace App\Config\Database;


interface IDriver
{
    function __construct();

    static function init();

    static function getInstance();

    static function getConnection();
}