<?php

declare(strict_types = 1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\MailHandler;

// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG, false));
$logger->pushHandler(new BrowserConsoleHandler(Logger::INFO, false));
$logger->pushHandler(new BrowserConsoleHandler(Logger::NOTICE, false));
$logger->pushHandler(new StreamHandler(__DIR__.'/warning.log', Logger::WARNING));
$logger->pushHandler(new FirePHPHandler());

// You can now use your logger
$logger->info($_GET['message']);

require_once 'buttons.html';