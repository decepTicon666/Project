<?php

namespace App\Auth;

use App\Repository\UsersRepository;

class LoginService
{
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    //Validierungsfunktion
    public function attempt($username, $password)
    {
        //Usersuche
        $user = $this->usersRepository->findByUsername($username);

        //Validierung der UserDaten
        if (empty($user)) {
            return false;
        }
        if (password_verify($password, $user->password)) {
            $_SESSION['login']     = $user->username;
            $_SESSION['userLevel'] = $user->userLevel_id;
            //stellt sicher, dass nur noch der User die SessionID besitzt
            session_regenerate_id(true);

            return true;
        } else {
            return false;
        }
    }

    //Ausloggen des Users
    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['userLevel']);
        session_regenerate_id(true);
        echo "Sie wurden ausgeloggt";
    }

    public function check(): bool
    {
        if (isset($_SESSION['login'])) {
            return true;
        }

        return false;
    }

    public function isAdmin()
    {
        if ($this->check()) {
            return $_SESSION['userLevel'];
        }

        return false;
    }
}
