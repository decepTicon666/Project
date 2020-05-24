<?php

require __DIR__ . "/../autoload.php";

use \App\Command\CommandManager;

$commandManager = new CommandManager();

try {
    $commandName     = isset($argv[1]) ? $argv[1] : null;
    $commandArgument = isset($argv[2]) ? $argv[2] : null;

    if (!$commandName) {
        $commandsAvailable = $commandManager->getCommandsAvailable();

        echo "\nAvailable commands";
        echo "\n==================\n\n";

        foreach ($commandsAvailable as $commandName => $description) {
            echo $commandName . ' (' . $description . ")\n";
        }

        echo "\n\n";
    }

    $notice = $commandManager->runCommand($commandName, $commandArgument);

    if ($notice) {
        echo "\n" . $notice . "\n";
    }

} catch (Exception $exception) {
    echo "\n" . $exception->getMessage() . "\n";
}
