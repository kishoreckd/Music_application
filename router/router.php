<?php

class router
{
    public $router = [];
    public $controller;

    public function __construct()
    {
        $this->controller = new Controller();
    }


    public function get($uri, $action)
    {
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'GET',
        ];
        return $this;
    }
    public function post($uri, $action)
    {
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'POST',
        ];
        return $this;
    }
    public function delete($uri, $action)
    {
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'DELETE',
        ];
        return $this;
    }
    public function patch($uri, $action)
    {
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'PATCH',
        ];
        return $this;
    }


    public function routing()
    {
        foreach ($this->router as $router) {
            if ($router['uri']==$_SERVER['REQUEST_URI']){
                if ($router['action']) {
                    switch ($router['action']) {
                        case'login':
//                            echo "";
                            $this->controller->loginPage($_POST);
                            break;
                        case'logout':
//                            echo "";
                            $this->controller->logout();
                            break;
                        case'addmusic':
//                            echo "";
                            $this->controller->addMusic($_POST,$_FILES);
                            break;

                             case'addartist':
//                            echo "";
                            $this->controller->addArtist($_POST,$_FILES);
                            break;

                        default:
                            $this->controller->home();
                    }

                } else {
                    $this->controller->home();
                }

            }

        }

    }
}


