<?php

define('DATABASE_HOST', 'host.docker.internal');
define('DATABASE_PORT', '3306');
define('DATABASE_NAME', 'blog');
define('DATABASE_USERNAME', 'mohammad');
define('DATABASE_PASSWORD', 'secret');


if (!function_exists('response')) {
    function response($data, $key, $status_code = 200)
    {
        return json_encode([
            'status' => ['status' => strval($status_code)[0] == 2 , 'status_code' => $status_code],
            $key => $data
        ]);
    }
}
