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

    /**
     * Run the application
     * this method will run the command that the user entered the terminal
     * @return void
     */
    private function run(): void
    {
        try {
            CommandsRunner::run($this->commands);
        } catch (\Exception $e) {
            echoError($e->getMessage());
        }
    }

}