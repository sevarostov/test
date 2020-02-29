<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT .'/config/db_params.php';
        $params = include($paramsPath);//получили массив с параметрами из ф-ла db_params.php

        //создаем объект класса PDO
        $dsn = "pgsql:host={$params['host']}; dbname={$params['dbname']}";
        $db = new PDO($dsn,  $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//        $db->exec("set names utf8");// исправляет конфликты кодировки при выгрузке из БД

        return $db;// возвращаем объект класса PDO

    }




}