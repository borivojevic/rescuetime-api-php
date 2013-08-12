<?php
define('FAKES_PATH', __DIR__ . '/MirkoIO/RescueTime/Fakes');

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('MirkoIO\RescueTime\Tests', __DIR__);
