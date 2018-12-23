<?php
require_once __DIR__ . '/src/Whoops.php';

try {
    throw new Exception("Hello");
} catch (Exception $exception) {

    \Karamel\Whoops\Whoops::start([
        'exception' => $exception,
        'get' => $_GET,
        'post' => $_POST,
        'files' => $_FILES,
        'server' => $_SERVER,
        'session' => $_SESSION,
        'env' => $_ENV
    ]);
}