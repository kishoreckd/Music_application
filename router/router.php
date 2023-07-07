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



    public function routing()
    {
        foreach ($this->router as $router) {
            if ($router['uri']==$_SERVER['REQUEST_URI']){
                if ($router['action']) {
                    switch ($router['action']) {
                        case'login':
                            $this->controller->loginPage($_POST);
                            break;
                        case'logout':
                            $this->controller->logout();
                            break;
                        case'addmusic':
                            $this->controller->addMusic($_POST,$_FILES);
                            break;
                        case'artistlist':
                            $this->controller->artistlist();
                            break;
                        case'addplaylist':
                            $this->controller->addplaylist($_POST);
                            break;
                            case'musiclist':
                        $this->controller->musiclist();
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


