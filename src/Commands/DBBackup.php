<?php

namespace BSaqqa\Backfire\Commands;

use BSaqqa\Backfire\Contracts\CommandInterface;

class DBBackup extends Command implements CommandInterface
{
    // Description of the command
    protected static string $description = 'Backup the database';

    /**
     * Run the command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args): void
    {
        $dbHost = config('backfire.db.host');
        $dbName = config('backfire.db.name');
        $dbUser = config('backfire.db.user');
        $dbPassword = config('backfire.db.password');

        $backupPath = config('backfire.backup_path');
        $backupName = config('backfire.backup_name');

        $backupPath = rtrim($backupPath, '/') . '/';
        $backupName = rtrim($backupName, '.sql') . '.sql';

        $backupFullPath = $backupPath . $backupName;

        $command = "mysqldump -h $dbHost -u $dbUser -p$dbPassword $dbName > $backupFullPath --opt " .
            "--routines --skip-set-charset --default-character-set=utf8mb4 --single-transaction " .
            "--quick --lock-tables=false";

        exec($command);

        echoSuccess("Database backup created successfully");
    }

}