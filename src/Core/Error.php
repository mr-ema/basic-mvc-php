<?php

namespace Core;

use Config\App as CONFIG;

/**
 * Error and exception handler
 *
 * PHP version 7.0
 */
class Error
{

    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $level  Error level
     * @param string $message  Error message
     * @param string $file  Filename the error was raised in
     * @param int $line  Line number in the file
     *
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        // Code is 404 (not found) or 500 (general error)
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (CONFIG::SHOW_ERRORS) {
            echo "<head>";
            echo "<link rel='stylesheet' type='text/css' href='css/main.css'>";
            echo "<link rel='stylesheet' type='text/css' href='css/utilities.css'>";
            echo "</head";
            echo "<body>";
            echo "<div class='dev-error'>";
            echo "<div>";
            echo "<h1>Fatal error</h1>";
            echo "<span>Uncaught exception: '" . get_class($exception) . "'</span>";
            echo "<span>Message: '" . $exception->getMessage() . "'</span>";
            echo "<span>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></span>";
            echo "<span>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</span>";
            echo "</div>";
            echo "</div>";
            echo "</body>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);

            View::render("Codes/$code.php");
        }
    }
}