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
        'db:backup' => \BSaqqa\Backfire\Commands\DBBackup::class,
        // 'db:restore' => \BSaqqa\Backfire\Commands\DBRestore::class,
        'help' => \BSaqqa\Backfire\Commands\Help::class,
    ],
];