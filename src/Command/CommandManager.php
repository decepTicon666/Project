<?php

namespace App\Command;

use App\Command\Commands\AddRegisterComponentCommand;
use App\Command\Commands\CreateControllerCommand;
use App\Command\Exception\UnknownCommandException;

class CommandManager
{
    private $commands = [];

    public function __construct()
    {
        $this->registerCommands();
    }

    private function registerCommands()
    {
        $this->commands = [
            CreateControllerCommand::getCommand()     => new CreateControllerCommand(),
            AddRegisterComponentCommand::getCommand() => new AddRegisterComponentCommand()
        ];
    }

    /**
     * @throws UnknownCommandException
     */
    public function runCommand(string $commandName, string $commandArgument = null)
    {
        $command = $this->getCommandByName($commandName);
        $command->run($commandArgument);
    }

    /**
     * @throws UnknownCommandException
     */
    private function getCommandByName(string $commandName): CommandInterface
    {
        if (!isset($this->commands[$commandName])) {
            throw new UnknownCommandException('command with name: ' . $commandName . ' is unknown');
        }

        return$this->commands[$commandName];
    }
}