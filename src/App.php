<?php

namespace BSaqqa\Backfire;

class App
{
    /**
     * @var App|null
     */
    private static ?self $initialized = null;

    public ?Config $config;

    /*
     * Commands List
     */
    private array $commands = [];


    /**
     * Initialize the application
     * @return App
     */
    public static function init(): self
    {
        $app = self::getInstance();

        // load the config file
        $app->registerConfig();

        // set settings for the application
        $app->setAppSettings();

        // load the commands
        $app->registerCommands();


        // run the application
        $app->run();

        return $app;
    }

    /**
     * Get the instance of the application
     * @return App
     */
    public static function getInstance(): self
    {
        if (!self::$initialized) {
            self::$initialized = new self();
        }
        return self::$initialized;
    }


    private function registerCommands(): void
    {
        if($this->commands) {
            return;
        }
        // get all commands from config
        $commands = config('backfire.commands');

        // register all commands
        foreach ($commands as $name => $command) {
            $this->commands[$name] = $command;
        }
    }

    private function registerConfig(): void
    {
        $this->config = Config::init();
    }


    private function setAppSettings(): void
    {
        // set the timezone
        date_default_timezone_set(config('app.timezone', 'UTC'));

        // set display errors
        ini_set('display_errors', config('app.display_error', "Off"));

        // set disable functions
        ini_set('disable_functions', config('app.disable_functions', ''));

        // set memory limit
        ini_set('memory_limit', config('app.memory_limit', -1));

        // set max execution time
        ini_set('max_execution_time', config('app.max_execution_time', 0));

        // set the error reporting
        error_reporting(config('app.error_reporting', E_ERROR | E_PARSE));

        // set chdir to the project root
        chdir( getHomePath() . '/' . config('app.chdir', '/'));

        // set charset
        ini_set('default_charset', config('app.charset', 'UTF-8'));
    }

    /**
     * Run the application
     * this method will run the command that the user entered the terminal
     * @return void
     */
    private function run(): void
    {
        try {
            // run the command
            CommandsRunner::run($this->commands);
        } catch (\Exception $e) {
            echoError($e->getMessage());
        }
    }

}