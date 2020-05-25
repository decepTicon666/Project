<?php

namespace App\Controller;

use App\Auth\LoginService;

class AdminController extends AbstractController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function admin()
    {
        $isAdmin = $this->loginService->isAdmin();

        $this->render('admin/admin', ['isAdmin' => $isAdmin]);
    }
}