<?php
namespace Core;

use Config\Configurations;

class PageLoader
{
    private static $instance;
    private $menuOptions;

    private function __clone() {}

    private function __wakeup() {}

    private function __construct()
    {
        $this->menuOptions = Configurations::getPages();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PageLoader();
        }

        return self::$instance;
    }

    public function setMain($page)
    {
        if (!empty($page) &&  file_exists("app/views/{$page}View.php")) {
            require_once "app/views/{$page}View.php";
        } else {
            require_once "app/views/ListagemEventosView.php";
        }
    }

    public function setHeader()
    {
        $header = file_get_contents( "resources/app/html/header.html" );

        $menubar = "";
        foreach ($this->menuOptions as $page => $title) {
            $menubar .= '<li><a href="index.php?page='.$page.'">'.$title.'</a></li>';
        }

        $header = str_replace("{OPTIONS}", $menubar, $header);

        echo $header;
    }

    public function setFooter()
    {
        echo file_get_contents("resources/app/html/footer.html");
    }

    public function setStyles()
    {
        echo file_get_contents("resources/app/html/styles.html");
    }

    public function setScripts()
    {
        echo file_get_contents("resources/app/html/scripts.html");
    }
}
