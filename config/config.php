<?php

return [

    /**
     * Database config
     *
     */
    "default_connection" => "default", // the default connection to use when no connection is specified

    "connections" => [
        "default" => [ // connection name that will be used in the command line to select the connection (you can add more than one connection)
            'type' => 'mysql', // in the future we will support more types
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'backfire',
        ],
        // ... more connections
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
     * Backup config
     *
     */
    "backup" => [
        'type' => 'zip', // in the future we will support more types
        'name' => '{{databaseName}}' .'-' . date('Y-m-d').'-'. time(), // the name of the backup file, you can use {{databaseName}} to get the database name
    ],


];