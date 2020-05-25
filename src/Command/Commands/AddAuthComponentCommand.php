<?php

namespace App\Command\Commands;

use App\Command\AbstractCommand;

class AddAuthComponentCommand extends AbstractCommand
{
    private const COMMAND           = 'add:component:auth';
    private const DESCRIPTION       = 'Add the authentication service to your application.';
    private const DIR_BASE          = __DIR__ . '/../..';
    private const DIR_COMPONENT_TPL = 'Components/Auth';
    private const DIRECTORIES = [
        'Auth',
        'Controller',
        'Models',
        'Register',
        'Register/Exception',
        'Repository',
        '../Views/admin',
        '../Views/user',
    ];
    private const FILES       = [
        'Auth/LoginService.php',
        'Auth/PasswordResetService.php',
        'Controller/AdminController.php',
        'Controller/LoginController.php',
        'Controller/RegisterController.php',
        'Controller/ResetController.php',
        'Models/UsersModel.php',
        'Register/Exception/PasswordsNotEqualException.php',
        'Register/Exception/RegisterFormErrorException.php',
        'Register/Exception/UserExistsException.php',
        'Register/RegisterService.php',
        'Repository/UsersRepository.php',
        'Repository/PasswordResetRepository.php',
        '../Views/admin/admin.php',
        '../Views/user/dashboard.php',
        '../Views/user/login.php',
        '../Views/user/passwordChange.php',
        '../Views/user/passwordReset.php',
        '../Views/user/register.php'
    ];

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
        return null;
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