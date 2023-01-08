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
}