<?php

namespace BSaqqa\Backfire;

use Adbar\Dot;

class Config
{

    private static ?self $instance = null;

    public array $config = [];

    /**
     * @return static
     */
    public static function init(): self
    {
        // register the config
        $config = self::getInstance();
        $config->registerConfig();

        return $config;
    }

    /**
     * @return static
     */
    private static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Register the config file
     * @return void
     */
    private function registerConfig(): void
    {
        $backfireConfig = require __DIR__ . '/../config/backfire.php';

        // load the main config file from user settings or get the default one
        $userConfig = $_SERVER['HOME'] . '/' . $backfireConfig['config_path'] . '/' . $backfireConfig['config_name'];

        if (!file_exists($userConfig)) {
            $userConfig = __DIR__ . '/../stubs/config.stub.php';
        }

        // get all config files from config folder
        $configFiles = glob(__DIR__ . '/../config/*.php');

        $config = require $userConfig;
        // load all config files
        foreach ($configFiles as $file) {
            // get the config name from the file name
            $configName = lcfirst(str_replace('.php', '', basename($file)));
            $config[$configName] = require $file;
        }

        // register the config
        $this->config = $config;
    }

    /**
     * @param  string  $key
     * @param  null  $default
     * @return mixed
     */
    public function get(string $key, $default = null): mixed
    {
        // get the value from the config
        $value = $this->config;

        // handle the dot notation
        return (new Dot($value, true))->get($key, $default);
    }

    public function isInitialized(): bool
    {
        $configPath = config('backfire.config_path');
        $configName = config('backfire.config_name');

        $configPath = $_SERVER['HOME'].'/'. rtrim($configPath, '/') . '/';

        $configFullPath = $configPath . $configName;
        // if user config file is exists
        return file_exists($configFullPath);
    }


}