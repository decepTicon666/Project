<?php

namespace App\Models;

//Objektmodell mit Attributen, das für den FETCH_CLASS Mode benötigt wird
class UsersModel extends AbstractModel
{
    public $id;
    public $username;
    public $password;
    public $surname;
    public $lastname;
    public $street;
    public $adress;
    public $zipCode;
    public $city;
    public $country;
    public $phone;

}
