<?php

namespace App\Controller;

use App\Mailer\Exception\MissingMailDataException;
use App\Repository\UsersRepository;
use App\Auth\PasswordResetService;

class ResetController extends AbstractController
{
    private $usersRepository;
    private $passwordReset;
    private $resetTokenSent = false;

    public function __construct(UsersRepository $usersRepository, PasswordResetService $passwordReset)
    {
        $this->usersRepository = $usersRepository;
        $this->passwordReset   = $passwordReset;
    }

    /**
     * @throws MissingMailDataException
     */
    public function showReset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            $this->passwordReset->newPasswordReset($email);
            $this->resetTokenSent = true;
        }

        $this->render("user/passwordReset", ['resetTokenSent' => $this->resetTokenSent]);
    }

    public function showChange()
    {
        $this->render("user/passwordChange", []);
    }
}
