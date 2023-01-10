<?php

namespace BSaqqa\Backfire\Commands;

use BSaqqa\Backfire\Contracts\CommandInterface;

class Update extends Command implements CommandInterface
{
    // Description of the command
    protected static string $description = "Updates the backfire package dependencies";

    /**
     * Run the command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args): void
    {
        echoSuccess("Backfire updated successfully");
    }

}