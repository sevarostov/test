<?php
include ROOT . '/models/User.php';

class controller_user
{


    /**
     * Action для страницы Личный кабинет
     */
    public function action_index()
    {
        $login = '';
        $password = '';

        if (isset ($_POST['submit'])) {
            $login = $_POST['text'];
            $password = $_POST['password'];

            $errors = false;

            //Проверяем, существует ли пользователь
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                //Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                //Перенаправляем пользователя в закрытую часть - кабинет
                header("Location: /test/cabinet/");
            }


        }
        // Подключаем вид
        require_once(ROOT . '/views/test/login.php');
        return true;
    }


    public function action_logout()
    {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /test/");
    }


}