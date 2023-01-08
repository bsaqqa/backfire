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
        'initialize' => \BSaqqa\Backfire\Commands\Initialize::class,
        'backup' => \BSaqqa\Backfire\Commands\CreateBackup::class,
        // 'db:restore' => \BSaqqa\Backfire\Commands\DBRestore::class,
        'open-config' => \BSaqqa\Backfire\Commands\OpenConfig::class,
        'help' => \BSaqqa\Backfire\Commands\Help::class,
    ],
];