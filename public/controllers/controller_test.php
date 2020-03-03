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
        $message = (isset($_GET['message'])) ? ($_GET['message']) : false;
        $sortDir = (isset($_GET['sortDir'])) ? ($_GET['sortDir']) : 1;
        $sortField = (isset($_GET['sortBy'])) ? ($_GET['sortBy']) : '';
        
        $total = Test::getCountList();
        $limit = 3;
        $pages = ceil($total / $limit);

        // What page are we currently on?
        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));

        // Calculate the offset for the query
         $offset = ($page - 1)  * $limit;

        // Some information to display to the user
        $start = $offset + 1;
        $end = min(($offset + $limit), $total);

        // The "back" link
        $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

        // The "forward" link
        $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

        if ($offset == (int)('-3')) {
            $offset = 0;
        }
        $list = Test::getStmt($limit, $offset, $sortField, $sortDir);
        
        // Подключаем вид
        require_once(ROOT . '/views/test/index.php');
        return true;
    }


    /**
     * личный кабинет
     */
    public function action_login()
    {
        $errors = [];
        // Форма отправлена?
        if (isset($_POST['submit'])) {
            // Форма отправлена? - Да
            // Считываем данные формы
            $userName = $_POST['text'];
            $password = $_POST['password'];

            // Форма заполнена корректно?
            if ($errors == false) {

//               авторизированные пользователи
            $userId = User::checkLogged();
            
            }
        }

        require_once(ROOT . '/views/test/login.php');
        return true;
    }
    
}
