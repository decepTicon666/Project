<?php

namespace App\Command\Commands;

use App\Command\AbstractCommand;
use App\Command\Exception\UnknownFileTemplateException;

class CreateLoginControllerCommand extends AbstractCommand
{
    private const COMMAND         = 'make:controller:login';
    private const DESCRIPTION     = 'Add a login controller to your application.';
    private const NOTICE          = 'After running this command add your route into "public/index.php".';
    private const DIR_CONTROLLERS = __DIR__ . '/../../Controller';
    private const NAME_CONTROLLER = 'LoginController';

    public static function getCommand(): string
    {
        return self::COMMAND;
    }

    public function getDescription(): string
    {
        return self::DESCRIPTION;
    }

    public function getNotice(): ?string
    {
        return self::NOTICE;
    }

    /**
     * @throws UnknownFileTemplateException
     */
    public function run(string $commandArgument = null)
    {
        $fileContent = $this->getTemplateContent(self::NAME_CONTROLLER);
        $filePath    = $this->getFilePathByControllerName();

        file_put_contents($filePath, $fileContent);
    }

    private function getFilePathByControllerName(): string
    {
        return self::DIR_CONTROLLERS . '/' . self::NAME_CONTROLLER . '.php';
    }
}