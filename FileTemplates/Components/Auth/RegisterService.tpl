<?php

namespace App\Register;

use App\Register\Exception\UserExistsException;
use App\Repository\UsersRepository;

class RegisterService
{
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @throws UserExistsException
     */
    public function register()
    {
        $username = $_POST['username'];

        $user = $this->usersRepository->findByUsername($username);

        if ($user) {
            throw new UserExistsException('Ein Benutzer mit dem Benutzername ' . $username . ' existiert bereits.');
        }

        $this->createNewUser();
    }

    private function createNewUser()
    {
        $username = $_POST['username'];
        $surname  = $_POST['surname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $street   = $_POST['street'];
        $number   = $_POST['number'];
        $adress   = $_POST['adress'];
        $zipCode  = $_POST['zipCode'];
        $city     = $_POST['city'];
        $country  = $_POST['country'];
        $phone    = $_POST['phone'];
        $email    = $_POST['email'];

        $this->usersRepository->insertUser(
            $username,
            $password,
            $surname,
            $lastname,
            $street,
            $number,
            $adress,
            $zipCode,
            $city,
            $country,
            $phone,
            $email
        );
    }
}
