<?php
require __DIR__ . "/autoload.php";
//require __DIR__ . "/database.php";

//Verhindert XSS Attacken
function e ($str) {
  return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

//Damit steht immer eine Instanz des Containers zur Verfügung
$container = new App\Core\Container();
//Hier kann man jede Repository testen, ob die Instanz erstellt wird oder nicht
//$usersRepository = $container->make("usersRepository");
//var_dump($usersRepository->findByUsername("erik"));

//die();
 ?>
