<?php

/**
 * 
 */
class controller_new
{

    /**
     * Action для главной страницы
     */
    public function action_index()
    {
        // Подключаем вид
        require_once(ROOT . '/views/test/new.php');
        return true;
    }

    /**
     * Сохранение задачи
     */
    public function action_submit()
    {
        if(empty($_POST['name'])  or 
           empty($_POST['email']) or 
           empty($_POST['text'])  or 
           empty($_POST['state']) or 
           !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
           echo "No arguments Provided!";
           return false;
       }

       $name = strip_tags(htmlspecialchars($_POST['name']));
       $email = strip_tags(htmlspecialchars($_POST['email']));
       $text = strip_tags(htmlspecialchars($_POST['text']));
       $state = strip_tags(htmlspecialchars($_POST['state']));

        // Соединение с БД
        $db = Db::getConnection();
        $sql = 'INSERT INTO tickets (name, email, text, state) '
            . 'VALUES (:name, :email, :text, :state)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':state', $state, PDO::PARAM_STR);
        $result->execute();

        header("Location: /test/?message=true");
        exit();

        // include ROOT . "/controllers/controller_test.php";
        // $controller = new controller_test;
        // $controller->action_index(true);

    }

    /**
     * редактирование статуса задачи
     */
    public function action_edit()
    {
        if(empty($_POST['success'])  or 
           empty($_POST['id']))
        {
           echo "No arguments Provided!";
           return false;
       }

       $text = strip_tags(htmlspecialchars($_POST['success']));
       $id = strip_tags(htmlspecialchars($_POST['id']));
       
        // Соединение с БД
        $db = Db::getConnection();
        $sql = 'UPDATE tickets SET state = :state where id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':state', $text, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
      
        $result->execute();

    }

    /**
     * редактирование текста задачи
     */
    public function action_text()
    {
        if(empty($_POST['text'])  or 
           empty($_POST['id']))
        {
           echo "No arguments Provided!";
           return false;
       }

       $text = strip_tags(htmlspecialchars($_POST['text']));
       $id = strip_tags(htmlspecialchars($_POST['id']));
       
        // Соединение с БД
        $db = Db::getConnection();
        $sql = 'UPDATE tickets SET text = :text where id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
      
        $result->execute();

    }
}
