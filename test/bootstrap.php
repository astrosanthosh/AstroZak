<?php

require_once(__DIR__.'/../src/AstroZak/AutoLoader.php');
$loader = new AstroZak\AutoLoader();
$loader->registerNamespace('AstroZak', realpath(__DIR__ . '/../src/'));
$loader->register();

define ('SWEPH_PATH', __DIR__ . '/../data/ephe/');

//require_once(__DIR__.'/../vendor/autoload.php');

