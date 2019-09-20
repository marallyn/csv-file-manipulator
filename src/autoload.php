<?php

use Redcat\Autoload;

$dir = __DIR__ . '/lib/Redcat';

require_once $dir . '/Autoload.php';

$autoLoader = Autoload::getInstance([
    dirname($dir)
]);
