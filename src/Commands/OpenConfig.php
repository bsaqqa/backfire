<?php

namespace BSaqqa\Backfire\Commands;

use BSaqqa\Backfire\Contracts\CommandInterface;

class OpenConfig extends Command implements CommandInterface
{
    // Description of the command
    protected static string $description = "Open the backfire configuration file";

    /**
     * Run the command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args): void
    {
        $configPath = config('backfire.config_path');
        $configName = config('backfire.config_name');

        $configPath = $_SERVER['HOME'].'/'. rtrim($configPath, '/') . '/';
        $configFullPath = $configPath . $configName;

        if (!file_exists($configFullPath)) {
            echoError("The configuration file does not exist.");
            echo "You can create it by running: ". warnText("backfire init") . PHP_EOL;
            return;
        }

        // hint: we are using the "code" command to open the config file
        echo warnText("Hint: ") . "We are using the " . warnText("code") . " command to open the config file" . PHP_EOL;

        echo warnText("Opening the configuration file ...\n\r");
        echo "Path: $configFullPath" . PHP_EOL;
        echo "----------------------------------------" . PHP_EOL;

        // open the config file
        exec( "code $configFullPath &", $output, $return_var );

        if ($return_var) {
            echoError("Failed to open the configuration file.");
            echo "You can open it manually from: $configFullPath" . PHP_EOL;
        }else{
            echoSuccess("The configuration file opened successfully");
        }
    }

}