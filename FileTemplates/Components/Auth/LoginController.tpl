<?php

namespace App\Controller;

use App\Auth\LoginService;
use App\Models\UsersModel;

class LoginController extends AbstractController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    //View für dashboard
    public function dashboard()
    {
        $this->loginService->check();
        $this->render("user/dashboard", ['username' => $_SESSION['login']]);
    }

    //logout + View
    public function logout()
    {
        $this->loginService->logout();
        header("location: login");
    }

    //User einloggen
    public function login()
    {
        $error = false;
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //Authentifizierung
            if ($this->loginService->attempt($username, $password)) {
                //damit wird hinter dem letzten / der string ersetzt
                //Es folgt die Route /dashboard
                header("Location: dashboard");

                return;
            } else {
                $error = "Die Benutzerdaten sind leider falsch";
            }
        }
        $this->render("user/login", ['error' => $error]);
    }
}
