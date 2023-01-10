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
        // Get the configurations
        [
            $dbHost, $dbUser, $dbPassword, $dbPort, $dbName, $backupPath, $backupFullPath
        ] = self::getConfigurations($database, $connection);

        // check if the backup path exists
        self::checkBackupPath($backupPath);

        $command = "mysqldump  --user={$dbUser} --password={$dbPassword} --host={$dbHost} --port=$dbPort  {$dbName}".
            " > $backupFullPath --opt --routines --skip-set-charset --default-character-set=utf8mb4 --single-transaction ".
            "--quick --lock-tables=false 2>null"; // 2>null to hide the password warning from the output

        if(isDebugMode()){
            // remove > errors.log to show the errors
            $command = str_replace('2>null', '', $command);
            echoInfo("Run command: $command");
        }

        exec($command, $output, $return);

        if ($return !== 0) {
            report($output[0]?? null, 'error');
            throw new BackupException("Error while creating the backup for the database \"$dbName\"", [
                'file' => $backupFullPath,
            ]);
        }

        return $backupFullPath;
    }
}