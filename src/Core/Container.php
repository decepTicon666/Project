<?php
/* Im Core werden alle Objekte aller Klassen erzeugt.
   Ziel ist es wenn irgendwo ein Attribut oder eine Variable hinzugefügt werden muss,
   müssen dann nicht viele dateien angepasst werden sondern nur die hier.
   Besonders wichtig ist es, wenn man dauernd $pdo übergeben muss an neue objektinstanz,
   sobald eine zweite Variable dazuübergeben muss, muss man alle Dateien, wo objektinstanzen erstellt werden,
   geändert werden.
   Mit dieser Schreibweise muss es nur hier geändert werden, weil dann im code nichts mehr übergeben muss. */
namespace App\Core;

use App\Controller\AdminController;
use App\Controller\HomeController;
use App\Controller\RegisterController;
use App\Controller\LoginController;
use App\Controller\ResetController;
use App\Auth\LoginService;
use App\Repository\PasswordResetRepository;
use App\Repository\UsersRepository;
use App\User\PasswordResetService;
use App\Register\RegisterService;
use PDO;
use PDOException;

// Erstellen der Objekte aller Klassen
class Container
{
    private const DB_HOST     = '127.0.0.1';
    private const DB_PORT     = 3307;
    private const DB_DATABASE = 'myproject';
    private const DB_USER     = 'root';
    private const DB_PASSWORD = '12345muh';

    private $instances = [];
    private $recipes   = [];

    //Rezeptesammlung für jede Art eines Objekts
    public function __construct()
    {
        $this->initRecipes();
        $this->initDatabase();
    }

    private function initRecipes()
    {
        $this->recipes = [
            'homeController' => function () {
                return new HomeController(
                    $this->make('loginService')
                );
            },
            'loginController' => function () {
                return new LoginController(
                    $this->make('loginService')
                );
            },
            'adminController' => function () {
                return new AdminController(
                    $this->make('loginService')
                );
            },
            'loginService' => function () {
                return new LoginService(
                    $this->make('usersRepository')
                );
            },
            'registerController' => function () {
                return new RegisterController(
                    $this->make('registerService')
                );
            },
            'registerService' => function () {
                return new RegisterService(
                    $this->make('usersRepository')
                );
            },
            'resetController' => function () {
                return new ResetController(
                    $this->make('usersRepository'),
                    $this->make('passwordResetService')
                );
            },
            'passwordResetService' => function () {
                return new PasswordResetService(
                    $this->make('passwordResetRepository')
                );
            },
            'passwordResetRepository' => function () {
                return new PasswordResetRepository(
                    $this->make("pdo")
                );
            },
            'usersRepository' => function () {
                return new UsersRepository(
                    $this->make("pdo")
                );
            }
        ];
    }

    // Erstellung aller objekte mit der Funtkion make und Übergabe von Strings
    // Die Instanz wird nur einmal erstellt und kann mehrmals abgerufen werden
    public function make($name)
    {
        if (!empty($this->instances[$name])) {
            return $this->instances[$name];
        }
        if (isset($this->recipes[$name])) {
            $this->instances[$name] = $this->recipes[$name]();
        }

        return $this->instances[$name];
    }

    private function initDatabase()
    {
        $this->recipes['pdo'] = function () {
            try {
                $dsn = 'mysql:host='.self::DB_HOST.';port='.self::DB_PORT.';dbname='.self::DB_DATABASE;
                $pdo = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                return $pdo;
            } catch (PDOException $e) {
                echo "Verbindung zur Datenbank fehlgeschlagen";
            }
        };
    }

    /*
      private $pdo;
      private $postsRepository;

    //Erstellen der Datenverbindung
      public function getPdo(){
        //prüft, ob eine Datenverbindung steht, um eine weitere Instanz zu verhindern, sollten 2 gleiche Instanzen einer Klasse erfolgen
        if (!empty($this->pdo)){
          return $this->pdo;
        }
        $this->pdo = new PDO('mysql:host=localhost;dbname=BLOG', 'test', 'test');
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $this->pdo;
      }

      public function getPostsRepository(){
        if (!empty($this->postsRepository)){
          return $this->postsRepository;
        }
        //Übergabe der Datenbankverbindung und Ausgabe des Objektes PostsRepository, das dann im Objekt der Klasse Container hinterlegt wird
        $this->postsRepository = new PostsRepository($this->getPdo());

        return $this->postsRepository;
      }*/
}
