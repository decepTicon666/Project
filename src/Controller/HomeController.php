<?php

namespace App\Controller;

use App\Auth\LoginService;

class HomeController extends AbstractController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function home()
    {
        $isLoggedin = $this->loginService->check();

//        header("location: login");

        $this->render('home/home', ['isLoggedin' => $isLoggedin]);
    }
}
