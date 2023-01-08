<?php

namespace BSaqqa\Backfire\Dumpers;

use BSaqqa\Backfire\Commands\CreateBackup;
use BSaqqa\Backfire\Contracts\DumperInterface;
use BSaqqa\Backfire\Exceptions\BackupException;

class MySQLDumper extends Dumper implements DumperInterface
{

    /**
     * @throws BackupException
     */
    public static function dump(int|string $connection, mixed $database): string
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

        $backupPath = $_SERVER['HOME'].'/'.rtrim($backupPath, '/').'/';

        $backupName = rtrim($fileName, '.sql').'.sql';

        $backupFullPath = $backupPath.$backupName;

        self::checkBackupPath($backupPath);

        $command = "mysqldump  --user={$dbUser} --password={$dbPassword} --host={$dbHost} --port=$dbPort  {$dbName}".
            " > $backupFullPath --opt --routines --skip-set-charset --default-character-set=utf8mb4 --single-transaction ".
            "--quick --lock-tables=false 2>null"; // 2>null to hide the password warning from the output

        exec($command, $output, $return);

        if ($return !== 0) {
            throw new BackupException("Error while creating the backup for the database \"$dbName\"", [
                'file' => $backupFullPath,
            ]);
        }

        return $backupFullPath;
    }
}