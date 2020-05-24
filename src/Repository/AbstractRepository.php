<?php
namespace App\Repository;

use PDO;

abstract class AbstractRepository
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //Damit wird sichergestellt, dass dort wo die Klasse erweitert wird auch die beiden abstracten Methoden drin sind

    function all()
    {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->query("SELECT * FROM `$table`");
        $posts = $stmt->fetchAll(PDO::FETCH_CLASS, $model);

        return $posts;
    }

    abstract public function getTableName();

    //Festlegen gemeinsamer Funktionen und Übergabe der Tabelle und Models durch die Kindklasse
    //Einfache Abfrage wird mit query gemacht

    abstract public function getModelName();

    //Bei einzelnen abfragen muss setFetchMode gesetzt werden, weil PHP es so vorgibt und man auf die einzelnen Attribute des Objekts sonst nicht zugreifen kann
    //Einzelabfragen werden maskiert

    function find($id)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE id= :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $post = $stmt->fetch(PDO::FETCH_CLASS);

        return $post;
    }
}

?>
