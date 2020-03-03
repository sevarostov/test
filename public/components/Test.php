<?php

class Test {

    private static $sortFields = [
        'Статус'              => 'state',
    ];

    /**
     * 
     * @return array
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


    /**
     * Возвращает количество
     * @return int
     */
    public static function getCountList()
    {

     $db = Db::getConnection();

     return $result = $db->query('SELECT COUNT(*) as num FROM public.tickets')->fetchColumn();;
    
    }

    /**
     */
    public static function getStmt($limit, $offset, $sortField, $sortDir)
    {
         $db = Db::getConnection();
    
         $stmt = $db->prepare('SELECT * FROM public.tickets '. ( $sortField ? 'ORDER BY '. $sortField. ' '. (($sortDir == 1) ? 'asc' : 'desc') : '') .' LIMIT :limit OFFSET :offset');
        
        // $stmt->bindParam(':orderBy', $sortField, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        // Do we have any results?
        if ($stmt->rowCount() > 0) {
            // Define how we want to fetch the results
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $iterator = new IteratorIterator($stmt);
            $i = 0;
            // Display the results
            foreach ($iterator as $row) {
                
            $ticketList[$i]['id'] = $row['id'];
            $ticketList[$i]['name'] = $row['name'];
            $ticketList[$i]['email'] = $row['email'];
            $ticketList[$i]['text'] = $row['text'];
            $ticketList[$i]['state'] = $row['state'];
            $i++;
            }

        return $ticketList;

        }
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

