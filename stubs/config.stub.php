<?php

return [

    /**
     * Database config
     *
     */
    "default_connection" => "default", // the default connection to use when no connection is specified

    "connections" => [
        "default" => [ // connection name that will be used in the command line to select the connection (you can add more than one connection)
            'driver' => 'mysql', // in the future we will support more types
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'backfire',
        ],
        // ... more connections
    ],


    /**
     * Backup config
     *
     */
    "backup" => [
        'type' => 'zip', // in the future we will support more types
        /**
         * The name of the backup file
         * You can use the following placeholders:
         * {{connection_name}}: the name of the connection
         * {{database_name}}: the name of the database
         */
        'name' => '{{connection_name}}-{{database_name}}-'. date('Y-m-d').'-'. time(),
    ],


    /**
     * Storage config
     *
     */
    "storage" => [
        'type' => 'local', // in the future we will support more types
        'path' => 'storage/backups', // relative to the user home directory
    ],


    /**
     * Error reporting config
     *
     */
    "reporting" => [
        'type' => 'file', // in the future we will support more types
        'log_path' => 'storage/logs', // relative to the user home directory
        'log_name' => 'backfire.log',
    ],


    // PHP settings
    "app" => [
        'timezone' => 'UTC',
        "display_error" => "off",  // if you want to see the errors, set it to "on"
        "disable_functions" => "", // comma separated list of functions to disable
        "memory_limit" => "4096M", // 4GB
        "max_execution_time" => 0, // 0 means no limit
        "chdir" => "/", // relative to the user home directory
        "error_reporting" => E_ERROR | E_PARSE, // E_ALL | E_STRICT | E_NOTICE
        "charset" => "UTF-8",
    ],
];