<?php

namespace App\User;

use App\Mailer\Exception\MissingMailDataException;
use App\Mailer\Mailer;
use App\Repository\PasswordResetRepository;

class PasswordResetService
{
    private const EMAIL_SUBJECT = 'Passwort zrurück setzen';
    private $passwordResetRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    /**
     * @throws MissingMailDataException
     */
    public function newPasswordReset(string $email)
    {
        $token = $this->passwordResetRepository->newPasswordReset($email);

        $mailer = new Mailer();
        $mailer->setReceiver($email);
        $mailer->setSubject(self::EMAIL_SUBJECT);

        $content = $this->passwordResetMail($token);
        $mailer->setContent($content);

        $mailer->send();
    }

    private function passwordResetMail(string $token): string
    {
        $resetUrl = $_SERVER['HTTP_HOST'] . '/passwordChange?token=' . $token;

        return 'Rufe <a href="' . $resetUrl . '">' . $resetUrl . '</a> auf, um dein Passwort zurück zu setzen!';
    }
}