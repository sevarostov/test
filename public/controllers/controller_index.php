<?php

/**
 * Контроллер controller_index
 */
class controller_index
{

    /**
     * Action для главной страницы
     */
    public function action_index()
    {
        $recomendedArticles = array();
        $recomendedArticles=Article::getRecomendedArticles();

//        echo '<pre>';
//        var_dump($recomendedArticles);
        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    
}
