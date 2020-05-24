<?php

require __DIR__ . "/../autoload.php";

use \App\Command\CommandManager;
use \App\Command\Exception\NoCommandArgument;

$commandManager = new CommandManager();

try {
    $commandName     = isset($argv[1]) ? $argv[1] : null;
    $commandArgument = isset($argv[2]) ? $argv[2] : null;

    if (!$commandName) {
        throw new NoCommandArgument('no command argument given');
    }

    $commandManager->runCommand($commandName, $commandArgument);
} catch (Exception $exception) {
    echo "\n" . $exception->getMessage() . "\n";
}
