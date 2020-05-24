<?php

namespace App\Command\Commands;

use App\Command\AbstractCommand;

class AddRegisterComponentCommand extends AbstractCommand
{
    private const COMMAND           = 'add:component:register';
    private const DIR_BASE          = __DIR__ . '/../..';
    private const DIR_COMPONENT_TPL = 'Components/Register';
    private const DIRECTORIES = [
        'Register',
        'Register/Exception'
    ];
    private const FILES       = [
        'Register/Exception/PasswordsNotEqualException.php',
        'Register/Exception/RegisterFormErrorException.php',
        'Register/Exception/UserExistsException.php',
        'Register/RegisterService.php'
    ];

    public static function getCommand(): string
    {
        return self::COMMAND;
    }

    public function run(string $commandArgument = null)
    {
        $this->createDirectoriesIfMissing();
        $this->createFilesIfMissing();
    }

    private function createDirectoriesIfMissing()
    {
        foreach (self::DIRECTORIES as $directory)
        {
            $path = self::DIR_BASE . '/' . $directory;

            if (!is_dir($path)) {
                mkdir($path);
            }
        }
    }

    private  function createFilesIfMissing()
    {
        foreach (self::FILES as $file)
        {
            $baseNameTpl = str_replace('.php', '.tpl', basename($file));
            $fileTpl     = $this->getFileTemplateDirectory() . '/' . self::DIR_COMPONENT_TPL . '/' . $baseNameTpl;
            $fileDest    = self::DIR_BASE . '/' . $file;

            if (!file_exists($fileDest)) {
                copy($fileTpl, $fileDest);
            }
        }
    }
}