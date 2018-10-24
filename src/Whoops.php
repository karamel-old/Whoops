<?php

namespace Karamel\Whoops;
class Whoops
{
    public static function start($options)
    {
        ob_end_clean();
        $exception = $options['exception'];
        include __DIR__ . '/Template/Whoops.php';
    }
}