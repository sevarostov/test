<?php

class Test {
    /**
     * Возвращает список пуктов статей
     * @return array <p>Список пуктов статей</p>
     */
    public static function getTicketList()
    {
// Соединение с БД
        $db = Db::getConnection();

// Получение и возврат результатов
        $result = $db->query('SELECT * FROM public.tickets ORDER BY id DESC');
        $ticketList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ticketList[$i]['id'] = $row['id'];
            $ticketList[$i]['name'] = $row['name'];
            $ticketList[$i]['email'] = $row['email'];
            $ticketList[$i]['text'] = $row['text'];
            $ticketList[$i]['state'] = $row['state'];
            $i++;
        }
        return $ticketList;
    }


    public static function saveData() 
    {
        // Соединение с БД
        $db = Db::getConnection();
        $sql = 'INSERT INTO tickets (name, email, text, state) '
            . 'VALUES (:name, :email, :text, :state)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':state', $state, PDO::PARAM_STR);
        return $result->execute();
    }
   
}

