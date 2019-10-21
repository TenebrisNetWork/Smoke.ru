<?php
//Определяем переменную местоположения ROOT
define("ROOT", dirname(__FILE__)."/application/");
//Подключаем файл роутера
require_once(ROOT."/components/router.php");


//Создаем объект роутера и вызываем метод run
$router = new Router();
$router->run();