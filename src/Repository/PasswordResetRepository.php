<?php

namespace App\Repository;

class PasswordResetRepository extends AbstractRepository
{
    public function getTableName()
    {
        return 'passwordReset';
    }

    public function getModelName()
    {
        // TODO: Implement getModelName() method.
    }

    public function newPasswordReset(string $email): string
    {
        $table = $this->getTableName();

        $stmt = $this->pdo->prepare("INSERT INTO `" . $table . "` (`token`, `email`) VALUES (:token, :email)");

        $token = $this->newResetToken();

        $stmt->execute([
            'token' => $token,
            'email' => $email
        ]);

        return $token;
    }

    private function newResetToken(): string
    {
        return uniqid('pwdreset_');
    }
}