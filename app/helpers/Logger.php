<?php

class Logger
{

    /** 
     * Logs a string to a json file.
     * @param array $message
     * @param string $logFile
     * @return void
     */
    public static function log($message, $logFile)
    {
        $log = array_merge(array('timestamp' => date('Y-m-d H:i:s', time())), $message);
        $jsonLog = json_encode($log);
        file_put_contents(LOGS . $logFile, $jsonLog . PHP_EOL, FILE_APPEND);
    }
}