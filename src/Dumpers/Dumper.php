<?php

namespace BSaqqa\Backfire\Dumpers;

abstract class Dumper
{
    /**
     * @param  string  $backupPath
     */
    public static function checkBackupPath(string $backupPath): void
    {
        if (!file_exists($backupPath) && !mkdir($backupPath, 0777, true) && !is_dir($backupPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $backupPath));
        }
    }

    /**
     * @param  mixed  $database
     * @param  int|string  $connection
     * @return array
     */
    public static function getConfigurations(mixed $database, int|string $connection): array
    {
        $dbHost = $database['host'];
        $dbUser = $database['username'];
        $dbPassword = $database['password'];
        $dbPort = $database['port'];
        $dbName = $database['database'];

        $backupPath = config('storage.path');

        $fileName = config('backup.name');
        $fileName = str_replace(array('{{database_name}}', '{{connection_name}}'), array($dbName, $connection),
            $fileName);

        $backupPath = getHomePath().'/'.rtrim($backupPath, '/').'/';

        $backupName = rtrim($fileName, '.sql').'.sql';

        $backupFullPath = $backupPath.$backupName;

        return array($dbHost, $dbUser, $dbPassword, $dbPort, $dbName, $backupPath, $backupFullPath);
    }
}