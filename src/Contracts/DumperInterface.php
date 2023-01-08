<?php

namespace BSaqqa\Backfire\Contracts;

interface DumperInterface
{
    // for creating the dump of the database
    public static function dump(int|string $connection, mixed $database): string;

    // for checking the backup path and creating it if it doesn't exist
    public static function checkBackupPath(string $backupPath): void;

    // for getting the configurations from database and connection
    public static function getConfigurations(mixed $database, int|string $connection): array;


}