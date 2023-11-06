<?php
namespace App\Helpers;

class ErrorHandler
{
    /**
     * Handle and extracts the data of an error object and logs it.
     * @param \Throwable $throwable
     * @param int $code
     * @param string $message
     * @return void
     */
    public static function handleError(\Throwable $throwable, $code = null, $message = null)
    {
        $date = date("Y-m-d H:i:s", time());
        $description = $throwable->getMessage();
        $file = $throwable->getFile();
        $line = $throwable->getLine();
        $trace = $throwable->getTraceAsString();

        $th = [$date, $description, $file, $line, $trace];
        Logger::log($th, "error");
    }

    /**
     * Handle and Logs "Not Found 404" error.
     * @param \Throwable $throwable
     * @return void
     */
    public static function notFound($throwable)
    {
        self::handleError($throwable, 404);
        require_once('../app/views/errors/404.php');
        die();
    }

    /**
     * Handle and Logs "Server 500" error.
     * @param \Throwable $throwable
     * @return void
     */
    public static function serverError(\Throwable $throwable)
    {
        self::handleError($throwable, 500);
        require_once('../app/views/errors/500.php');
        die();

    }
}