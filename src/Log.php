<?php

namespace BSaqqa\Backfire;

class Log
{
    /**
     * Write the message to the log file
     *
     * @param  string  $message
     * @param  string  $type
     * @return void
     */
    public function write(string $message, string $type = 'info'): void
    {
        $logPath = config('reporting.log_path');
        $logName = config('reporting.log_name');

        $logPath = $_SERVER['HOME'].'/'. rtrim($logPath, '/') . '/';

        $logFullPath = $logPath . $logName;

        if (!file_exists($logPath) && !mkdir($logPath, 0777, true) && !is_dir($logPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $logPath));
        }

        $logContent = file_get_contents($logFullPath);

        $logContent .= date('Y-m-d H:i:s') . " [$type] $message" . PHP_EOL;

        file_put_contents($logFullPath, $logContent);
    }

}