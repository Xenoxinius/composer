<?php

declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;

// Create the logger
// NOTICE AND INFO ARE ALSO PART OF DEBUG SO ONLY NEED ONE LINE
$logger = new Logger('my_logger');
$logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/info.log', Logger::DEBUG));


// Now add some handlers
if (isset($_GET['type'])) {
    if ($_GET['type'] == 'DEBUG') {
        $logger->debug($_GET['message'] ?? "");
    } elseif ($_GET['type'] == 'INFO') {
        $logger->info($_GET['message'] ?? "");
    } elseif ($_GET['type'] == 'NOTICE') {
        $logger->notice($_GET['message'] ?? "");
    };


    if ($_GET['type'] == 'WARNING') {
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::WARNING));
        $logger->warning($_GET['message'] ?? "");
    }


    if ($_GET['type'] == 'ERROR') {
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::ERROR));
        $logger->pushHandler(new NativeMailerHandler('yolo@gmail.com', 'poggers', 'matthijs'));
        $logger->error($_GET['message'] ?? "");
    } elseif ($_GET['type'] == 'CRITICAL') {
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::CRITICAL));
        $logger->critical($_GET['message'] ?? "");
    }elseif ($_GET['type'] == 'ALERT') {
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::ALERT));
        $logger->critical($_GET['message'] ?? "");
    }


    if ($_GET['type'] == 'EMERGENCY') {
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/emergency.log', Logger::EMERGENCY));
        $logger->emergency($_GET['message'] ?? "");
    }

}

// You can now use your logger
require_once 'buttons.html';