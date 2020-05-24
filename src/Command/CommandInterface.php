<?php

namespace App\Command;

interface CommandInterface
{
    public static function getCommand(): string;
    public function getDescription(): string;
    public function getNotice(): ?string;
    public function run(string $commandArgument = null);
}