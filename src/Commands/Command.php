<?php

namespace BSaqqa\Backfire\Commands;

abstract class Command
{

    // Description of the command
    protected static string $description = 'No description provided';


    /**
     * Get the description of the command
     * @return string
     */
    public static function description(): string
    {
        return static::$description;
    }

}