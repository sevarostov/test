<?php

/**
 * Контроллер controller_test
 */
class controller_test
{

    /**
     * Action для главной страницы
     */
    public function action_index()
    {
		$list = Test::getTicketList();
        
        // Подключаем вид
        require_once(ROOT . '/views/test/index.php');
        return true;
    }

    
}
