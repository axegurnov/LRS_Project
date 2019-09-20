<?php
namespace app\core;

class View
{
    static protected $_instance = NULL;

    protected $_layout = 'main';

    static public function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new View();
        }
        return self::$_instance;
    }

    public function setLayout($layout)
    {
        $this->_layout = $layout;
    }

    public function generate($template, $vars = [])
    {
        if (file_exists('../app/views/layouts/' . $this->_layout . '.php')) {
            extract($vars);
            if (file_exists('../app/views/' . $template . '.php')) {
                ob_start();
                require '../app/views/' . $template . '.php';
                $content = ob_get_contents();
                ob_end_clean();
            }
            else {
                $content = "view doesnt exist";
            }
            require '../app/views/layouts/' . $this->_layout . '.php';
        }
        else {
            echo "file not found";
        }
    }

    public function generateHandle($vars = [])
    {
        if (file_exists('../app/views/errors/handler.tlp.php')) {
            extract($vars);
            require '../app/views/errors/handler.tlp.php';
        }
        else {
            echo "file not found";
        }
    }
}

?>
