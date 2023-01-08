<?php

namespace BSaqqa\Backfire\Contracts;

interface CommandInterface
{
    /**
     * Run the command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args): void;

    /**
     * Get the description of the command
     *
     * @return string
     */
    public static function description(): string;
}