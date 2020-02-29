<?php

// FRONT CONTROLLER


// 1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();// для всех страниц сайта начало сессии

// 2. Подключение файлов системы

define('ROOT', dirname(__FILE__));// используется полный путь к файлу на диске
require_once(ROOT.'/components/Autoload.php');
//require_once(ROOT.'/components/Router.php');  // удалили после подключения AVTOLOAD
//require_once(ROOT.'/components/Db.php');


// 3. Установка соединения с БД



// 4. Вызов Router

$router = new Router();//создаем экз класса роутер
$router->run();// передаем на него управление

