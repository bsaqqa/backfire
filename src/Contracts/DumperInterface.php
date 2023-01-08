<?php

namespace BSaqqa\Backfire\Contracts;

interface DumperInterface
{
    public static function dump(int|string $connection, mixed $database): string;

    public static function checkBackupPath(string $backupPath): void;

}