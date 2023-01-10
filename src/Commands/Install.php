<?php

namespace BSaqqa\Backfire\Commands;

use BSaqqa\Backfire\Contracts\CommandInterface;

class Install extends Command implements CommandInterface
{
    // Description of the command
    protected static string $description = "Installs the backfire configuration file";

    /**
     * Run the command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args): void
    {
        try{
            $configPath = config('backfire.config_path');
            $configName = config('backfire.config_name');

            $configPath = getHomePath().'/'. rtrim($configPath, '/') . '/';

            $configFullPath = $configPath . $configName;

            if (file_exists($configFullPath)) {
                echoError("The configuration file already exists.");

                echo "You can edit it from: $configFullPath" . PHP_EOL;
                return;
            }
            $configContent = file_get_contents(__DIR__.'/../../stubs/config.stub.php');

            if (!file_exists($configPath) && !mkdir($configPath, 0777, true) && !is_dir($configPath)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $configPath));
            }

            file_put_contents($configFullPath, $configContent);

            echoSuccess("The configuration file created successfully");
        }catch (\Exception $e) {
            echoError($e->getMessage());
        }

    }

}