<?php

namespace BSaqqa\Backfire\Commands;

use BSaqqa\Backfire\Contracts\CommandInterface;

class Help extends Command implements CommandInterface
{
    // Description of the command
    protected static string $description = 'Show the help message';

    /**
     * Run the command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args): void
    {
        $commands = config('backfire.commands');

        // green color
        $color = "\e[32m";
        $endColor = "\e[0m";
        echo "\nAvailable Commands: \n".PHP_EOL;
        foreach ($commands as $commandName => $commandClass) {
            echo "  $color $commandName$endColor \t" . $commandClass::description() . "" . PHP_EOL;
        }
        echo "\n".PHP_EOL;

        echo "Example: \n";
        echo "  backfire$color db:backup$endColor \n";

        echo PHP_EOL;
    }

}