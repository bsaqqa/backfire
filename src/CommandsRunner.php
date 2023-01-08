<?php

namespace BSaqqa\Backfire;

use RuntimeException;

class CommandsRunner
{

    /**
     * Commands runner
     * @param  array  $commands
     * @return void
     * @throws RuntimeException
     */
    public static function run(array $commands): void
    {
        // get the command name
        $commandName = getArgs()[1] ?? 'help';

        // is the command exists
        self::isCommandExists($commandName, $commands);

        // is backfire initialized
        self::checkInitialization($commandName);

        // get the command class
        $commandClass = $commands[$commandName];

        // create an instance of the command class
        $command = new $commandClass;

        // is the command class implements the CommandInterface
        self::isCommandImplementsInterface($command);

        // print the command name
        self::printInformationOfCommand($commandName);

        // run the command
        $command->run(getArgs());
        echo PHP_EOL;
    }

    /**
     * Show "running command <command> ..." message
     * @param  mixed  $commandName
     */
    protected static function printInformationOfCommand(mixed $commandName): void
    {
        if ($commandName !== 'help') {
            echo "\nRunning command ". warnText("<$commandName>") . " ... \n\r";
            echo "----------------------------------------\n".PHP_EOL;
        }
    }

    /**
     * Check if the command exists
     * @param  mixed  $commandName
     * @param  array  $commands
     */
    protected static function isCommandExists(mixed $commandName, array $commands): void
    {
        if (!array_key_exists($commandName, $commands)) {
            echoError("Command not found");
            throw new RuntimeException("Command not found");
        }
    }

    /**
     * @param  mixed  $commandName
     */
    protected static function checkInitialization(mixed $commandName): void
    {
        if (!isConfigInitialized() && !in_array($commandName, ['help', 'initialize'])) {
            echo "\r\nPlease in the first time   run the command: \n".PHP_EOL;
            echo warnText("  backfire initialize\n\r").PHP_EOL;
            throw new RuntimeException("The configuration file not found");
        }
    }

    /**
     * @param  mixed  $command
     */
    protected static function isCommandImplementsInterface(mixed $command): void
    {
        if (!($command instanceof Contracts\CommandInterface)) {
            echoError("Command must implement the CommandInterface");
            throw new RuntimeException("Command must implement the CommandInterface");
        }
    }

}