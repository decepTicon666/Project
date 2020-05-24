<?php

namespace App\Controller;

use App\Register\Exception\PasswordsNotEqualException;
use App\Register\Exception\RegisterFormErrorException;
use App\Register\RegisterService;

class RegisterController extends AbstractController
{
    private $registerService;
    private $errors          = [];
    private $registerSuccess = false;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    //zeigt die Registrierseite an
    public function show()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $this->checkFormData();
            } catch (\Exception $exception) {
                $this->errors[] = $exception->getMessage();
            }

            if (empty($this->errors)) {
                $this->processRegisterSubmit();
                $this->registerSuccess = true;
            }
        }

        $this->render('user/register', [
            'errors'          => $this->errors,
            'registerSuccess' => $this->registerSuccess
        ]);
    }

    private function processRegisterSubmit()
    {
        try {
            $this->registerService->register();
        } catch (\Exception $exception) {
            $this->errors[] = $exception->getMessage();
        }
    }

    /**
     * @throws RegisterFormErrorException
     * @throws PasswordsNotEqualException
     */
    private function checkFormData()
    {
        if (empty($_POST['surname']) ||
            empty($_POST['lastname']) ||
            empty($_POST['country']) ||
            empty($_POST['email']) ||
            empty($_POST['username']) ||
            empty($_POST['password']) ||
            empty($_POST['passwordRepeat']) ||
            !is_numeric($_POST['phone'])
        ) {
            throw new RegisterFormErrorException('Bitte alle Pflichtfelder ausfüllen.');
        }

        if ($_POST['password'] != $_POST['passwordRepeat']) {
            throw new PasswordsNotEqualException('Die Passwörter müssen übereinstimmen.');
        }
    }

    public function attemptRegister($password, $passwordRepeat)
    {
        if ($password == $passwordRepeat) {
            return true;
        } else {
            return false;
        }
    }
}

?>
