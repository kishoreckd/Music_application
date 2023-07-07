<?php
require ("models/model.php");

class Controller {
    private $Model;

    public function __construct() {


        $this->Model = new Model();
    }


    public function home(){
        require "views/home.php";
    }

    /**checking if the user is logged in **/
    public function loginPage($data){
        if ($data){
           $checked= $this->Model->registration($data);
           if ($checked){
               $_SESSION['name']=$checked->username;
               $this->home();
           }
           else{
               $session['error']='user is not existed';
               require "views/registration/login.php";
           }
        }
        else{
            require "views/registration/login.php";
        }
    }


    /*logged out logout user*/
    public function logout(){
        session_destroy();
        $this->home();

    }
}