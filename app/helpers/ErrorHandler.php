<?php

class ErrorHandler
{

    /**
     * Handle and extracts the data of an error object and logs it.
     * @param Throwable $throwable
     * @param int $code
     * @param string $message
     * @return array
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

        return [
            'code' => $code ? $code : 500,
            'message' => $message ? $message : 'Something went wrong, please try again later.'
        ];

    }


}