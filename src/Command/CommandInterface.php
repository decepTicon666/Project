<?php

namespace App\Command;

interface CommandInterface
{
    public static function getCommand(): string;
    public function run(string $commandArgument = null);
}