<?php

// set strict mode
declare(strict_types=1);

// disable the warnings messages
error_reporting(E_ERROR | E_PARSE);

// load the composer autoloader
require __DIR__ . '/../vendor/autoload.php';


// run the application
BSaqqa\Backfire\App::init();

