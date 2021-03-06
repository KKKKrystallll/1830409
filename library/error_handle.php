<?php

#Revision history:
#
#DEVELOPER DATE COMMENTS
#TianzhenSun(1830409) 2021-03-05 error handler
#

require_once 'config.php';
error_reporting(E_ALL);
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');

//deal with error as exception
function errorHandler($errno, $errstr, $errfile, $errline, $errcontext = []) {
    throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
}

/**
 * @param $e Exception
 */
function exceptionHandler($e){
    $time = $_SERVER['REQUEST_TIME'];
    $dir = LOG_PATH;
    if (!is_dir($dir)) {
        mkdir($dir, 0755);
    }

    //the name of log file
    $filename = $dir . date('Y-m-d', $time) . '.log';

    //the detail of exception
    $file = $e->getFile();
    $line = $e->getLine();
    $code = $e->getCode();
    $message = $e->getMessage();
    $date = date('Y/m/d H:i:s', $time);

    //transform millisecond to microsecond
    $microsecond = date('u', $time) * 1000;

    //the format of exception information
    $error = sprintf("[%s.%d]File:%s,Line:%s,Code:%s,Message:%s\n", $date, $microsecond, $file, $line, $code, $message);

    //write to log file
    file_put_contents($filename, $error, FILE_APPEND);

    //whether throw a detail exception to user depend of DEBUG constant
    if (DEBUG) {
        throw $e;
    }
}
