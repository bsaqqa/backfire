<?php

namespace BSaqqa\Backfire\Commands;

use BSaqqa\Backfire\Contracts\CommandInterface;
use BSaqqa\Backfire\Dumpers\MySQLDumper;
use BSaqqa\Backfire\Exceptions\BackupException;

class CreateBackup extends Command implements CommandInterface
{
    // Description of the command
    protected static string $description = 'Backup the database';

    /**
     * Run the command
     *
     * @param  array  $args
     * @return void
     * @throws \Exception
     */
    public function run(array $args): void
    {
        try {
            // Get the databases configuration
            $databases = config('connections');

            foreach($databases as $connection => $database){
                $backup = match ($database['driver']) {
                    'mysql' => $this->backupMysql($connection, $database),
                    default => throw new \Exception("The driver {$database['driver']} is not supported yet."),
                };

                // archive the backup
                $this->zipBackup($backup);
                echoSuccess("The database \"{$database['database']}\" has been backed up successfully.");
            }

            echoSuccess("Database backup created successfully");
        }catch(BackupException $e){
            $errorData = $e->getData();
            if($errorData && isset($errorData['file'])){
                unlink($errorData['file']);
            }
            throw $e;
        }catch (\Exception $e) {
            // report the error
            report($e->getMessage(), 'error');
            throw $e;
        }
    }

    /**
     * @throws BackupException
     */
    private function backupMysql(int|string $connection, mixed $database): string
    {
        return MySQLDumper::dump($connection, $database);
    }



    /**
     * @param  string  $backup
     */
    private function zipBackup(string $backup): void
    {
        $zip = new \ZipArchive();

        $zipName = rtrim($backup, '.sql') . '.zip';

        if ($zip->open($zipName, \ZipArchive::CREATE) !== true) {
            throw new \RuntimeException("Error while creating the zip file for the backup \"$backup\"");
        }

        $zip->addFile($backup, basename($backup));
        $zip->close();

        // delete the sql file
        unlink($backup);
    }

}