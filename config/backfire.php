<?php

return [
    /*
     * User config file path
     */
    "config_path" => ".backfire", // relative to the user home directory
    "config_name" => "backfire.config.php", // the name of the config file


    /*
     * Commands List
     */
    'commands' => [
        'install' => \BSaqqa\Backfire\Commands\Install::class,
        'backup' => \BSaqqa\Backfire\Commands\CreateBackup::class,
        'open-config' => \BSaqqa\Backfire\Commands\OpenConfig::class,
        'help' => \BSaqqa\Backfire\Commands\Help::class,
    ],
];