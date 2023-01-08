<?php

if (!function_exists('config'))
{
    /**
     * Get the specified configuration value.
     *
     * @param  string  $key
     * @param  mixed|null  $default
     * @return mixed
     */
    function config(string $key, mixed $default = null): mixed
    {
        return BSaqqa\Backfire\Config::init()->get($key, $default);
    }
}


if (!function_exists('echoError'))
{
    /**
     * Show error message
     *
     * @param  string  $message
     * @return void
     */
    function echoError(string $message): void
    {
        echo "\nError: \033[31m" . $message . "\033[0m\n\r" . PHP_EOL;
    }
}

if (!function_exists('echoSuccess'))
{
    /**
     * Show success message
     *
     * @param  string  $message
     * @return void
     */
    function echoSuccess(string $message): void
    {
        echo "\n\033[32m" . $message . "\033[0m\n\r" . PHP_EOL;
    }
}

if(!function_exists('getArgs')){
    /**
     * Get the arguments from the command line
     *
     * @return array
     */
    function getArgs(): array
    {
        return  $_SERVER['argv'];
    }
}

// is config initialized?
if(!function_exists('isConfigInitialized')){
    /**
     * Check if the config is initialized
     *
     * @return bool
     */
    function isConfigInitialized(): bool
    {
        return BSaqqa\Backfire\Config::init()->isInitialized();
    }
}

//warnText
if(!function_exists('warnText')){
    /**
     * @param  string  $text
     * @return string
     */
    function warnText(string $text): string
    {
        return "\033[33m" . $text . "\033[0m";
    }
}

//report
if(!function_exists('report')){
    /**
     * @param  string  $message
     * @param  string  $type
     * @return void
     */
    function report(string $message, string $type = 'info'): void
    {
        $type = strtolower($type);
        // write the message to the log file
        $log = new BSaqqa\Backfire\Log();
        $log->write($message, $type);
    }
}

// getHomePath
if(!function_exists('getHomePath')){
    /**
     * @return string
     */
    function getHomePath(): string
    {
        return $_SERVER['HOME'] ?? $_SERVER['HOMEPATH'] ?? $_SERVER['USERPROFILE'];
    }
}