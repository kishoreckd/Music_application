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
                        case'addplaylistname':
                            $this->controller->addplaylistname($_POST);
                            break;
                        case'showplaylist':
                            $this->controller->showplaylist();
                            break;
                        case'addplaylistview':
                            $this->controller->addplaylistview($_POST);
                            break;
                        case'addplaylist':
                            $this->controller->addplaylist($_POST);
                            break;
                        case'addsongplaylist':
                            $this->controller->addsongplaylist($_POST);
                            break;

                            case'musiclist':
                        $this->controller->musiclist();
                        break;

                             case'addartist':
                            $this->controller->addArtist($_POST,$_FILES);
                            break;
                        case'approve':
                            $this->controller->approve($_POST);
                            break;
                        case'requestpremium':
                            $this->controller->requestpremium($_POST);
                            break;
                        case'checkrequest':
                            $this->controller->checkrequest($_POST);
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


