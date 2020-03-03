<?php


/**
 * создание польз-ля
 * @param string $name
 * @param string $password
 *      */

class User
{
   /**    
     * проверяем, существует ли пользователь с заданными $login и $password
     * @param string $login
     * @param string $password
     * @return mixed: integer user id or false
     */

    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM public.user WHERE login =  :login AND password =  :password';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     *
     */

    public static function auth($userId)
    {
//        session_start();// сессия - запоминает данные о пользователе на сервере
        $_SESSION['user'] = $userId;
    }


    public static function checkLogged()
    {
//        session_start();
        // Если сессия есть, вернем идентификатор пользователя

        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");

    }

    /**
     * проверяет пользователя: гость или нет
     *если сессии нет, то это гость, если сессия есть - то это не гость
     */
    public static function isGuest()
    {
//        session_start();
            if (isset($_SESSION['user'])) {
            return false;
        }
        return true;

    }



    /**
     * проверяет имя: не меньше, чем 2 символа
     *
     */

    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }





}





