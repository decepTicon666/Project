<?php

namespace App\Repository;

use PDO;
use App\Models\UsersModel;

// Klasse erbt von Abstract Klasse
class UsersRepository extends AbstractRepository
{
    private const TABLE_USERS     = 'users';
    private const TABLE_USER_DATA = 'userData';
    private const USER_LEVEL      = 2;

    // gibt den Namen der Tabelle aus
    public function findByUsername($username)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare('SELECT * FROM `' . $table . '` WHERE username= :username');
        $stmt->execute([':username' => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);

        return $stmt->fetch(PDO::FETCH_CLASS);
    }

    // gibt den Namen des Models aus
    public function getTableName()
    {
        return "users";
    }

    // sucht nach bestimmten User
    public function getModelName()
    {
        return UsersModel::class;
    }

    // Speichern von User
    public function insertUser(
        $username, $password, $surname, $lastname, $street, $number, $address, $zipCode,
        $city, $country, $phone, $email)
    {
        $dataId = $this->insertUserDataToDb($surname, $lastname, $street, $number, $address, $zipCode, $city, $country, $phone, $email);

        $this->insertUserToDb($username, $password, $dataId);
    }

    private function insertUserDataToDb($surname, $lastname, $street, $number, $address, $zipCode, $city, $country, $phone, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `" . self::TABLE_USER_DATA . "` (`surname`, `lastname`, `street`, `number`, `address`, `zipCode`,
                                    `city`, `country`, `phone`, `email`, `registerDate`) VALUES (:surname, :lastname, :street, :number, :address, :zipCode,
                                    :city, :country, :phone, :email, :registerDate)"
        );

        $stmt->execute([
            'surname'      => $surname,
            'lastname'     => $lastname,
            'street'       => $street,
            'number'       => $number,
            'address'      => $address,
            'zipCode'      => $zipCode,
            'city'         => $city,
            'country'      => $country,
            'phone'        => $phone,
            'email'        => $email,
            'registerDate' => $this->newMysqlDate()
        ]);

        return $this->pdo->lastInsertId();
    }

    private function newMysqlDate()
    {
        return date('Y-m-d H:i:s');
    }

    private function insertUserToDb(string $userName, string $password, int $dataId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `" . self::TABLE_USERS . "` 
                                    (`username`, `password`, `userData_id`, `userLevel_id`) VALUES (:username, :passwordHash, :dataId, :userLevelId)");

        $stmt->execute([
            'username'     => $userName,
            'passwordHash' => $this->hashUserPassword($password),
            'dataId'       => $dataId,
            'userLevelId'  => self::USER_LEVEL
        ]);
    }

    private function hashUserPassword(string $password): string
    {
        return password_hash($password, CRYPT_SHA256);
    }
}
