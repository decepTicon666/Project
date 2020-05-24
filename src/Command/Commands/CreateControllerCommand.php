<?php

namespace App\Command\Commands;

use App\Command\AbstractCommand;
use App\Command\Exception\UnknownFileTemplateException;

class CreateControllerCommand extends AbstractCommand
{
    private const COMMAND            = 'make:controller';
    private const DESCRIPTION        = 'Add a controller to your application.';
    private const NOTICE             = 'After running this command add your route into "public/index.php".';
    private const CLASS_NAME_REPLACE = '##ControllerName##';
    private const DIR_CONTROLLERS    = __DIR__ . '/../../Controller';

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
    public function run(string $controllerName = null)
    {
        $content = $this->getTemplateContent('Controller');

        $fileContent = str_replace(self::CLASS_NAME_REPLACE, $controllerName, $content);
        $filePath    = $this->getFilePathByControllerName($controllerName);

        file_put_contents($filePath, $fileContent);
    }

    private function getFilePathByControllerName(string $controllerName): string
    {
        return self::DIR_CONTROLLERS . '/' . $controllerName . '.php';
    }
}
