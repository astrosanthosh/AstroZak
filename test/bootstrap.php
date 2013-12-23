<?php

require_once(__DIR__.'/../src/AstroZak/AutoLoader.php');
$loader = new AstroZak\AutoLoader();
$loader->registerNamespace('AstroZak', realpath(__DIR__ . '/../src/'));
$loader->register();

AstroZak\Sweph::init( __DIR__ . '/../data/ephe/');

//require_once(__DIR__.'/../vendor/autoload.php');

