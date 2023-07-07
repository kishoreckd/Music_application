<?php
require ("models/model.php");

class Controller {
    private $Model;

    public function __construct() {


        $this->Model = new Model();
    }


    /**In home page normal user can see alll the songs and artist**/
    public function home(){
        $album=$this->Model->showMusic();
        require "views/home.view.php";
    }

    /**It returns artist list**/
    public  function  artistlist(){
        $artist=$this->Model->showArtist();
        require "views/home.view.php";
    }
    /**It returns music list**/

    public  function  musiclist(){
        $album=$this->Model->showMusic();
        require "views/home.view.php";
    }
    public  function addplaylist($datas){
        if ($datas){
            if ($datas['playlist_for'] =='Artist'){
                $artist=$this->Model->showArtist();
                $_SESSION['Artist']=$datas['playlist_for'];
                require "views/addplaylistartist.view.php";
            }
            if ($datas['playlist_for'] =='Album'){
                $album=$this->Model->showMusic();
                $_SESSION['Album']=$datas['playlist_for'];
                require "views/addplaylistalbum.view.php";
            }
        }
        else{
            require "views/addplaylist.view.php";
        }

    }
    public function addplaylistalbum($albums){
//        addplaylist
        $this->Model->addplaylistalbums($albums);
        $this->home();

    }
    public function addplaylistartist($albums){
//        addplaylist
        $this->Model->addplaylistartist($albums);
        $this->home();

    }


    /**checking if the user is logged in **/
    public function loginPage($data){
        if ($data){
           $checkadmin= $this->Model->checkadmin($data);
           $check =$this->Model->registration($data);
           if ($checkadmin){
               $_SESSION['admin']=$checkadmin->username;
               $this->home();

           }
           elseif ($check){
               $_SESSION['user']=$check->username;
//               $_SESSION['id']=$check->id;
               $checking_id=$check->id;
               $checkpremium =$this->Model->checkpremium($checking_id);
               $_SESSION['id']=$checkpremium->id;
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

    public function checkrequest(){
        $checkrequest =$this->Model->checkingrequest();
        require "views/home.view.php";
    }

    /**logged out logout user*/
    public function logout(){
        session_destroy();
        header("location:/");

    }
    /**Adding Music*/

    public function addMusic($data,$musicImage){
        if ($data and $musicImage){
            $this->Model->addMusic($data,$musicImage);
            $this->home();

        }
        else{
            $artistname =$this->Model->showArtist();
            require "views/addmusic.view.php";
        }
    }

    /**Adding Artist*/
    public function addArtist($artist,$image)
    {
        if ($artist and $image) {
            $this->Model->addArtist($artist, $image);
            $this->home();
        } else {
            require "views/addartist.view.php";
        }
    }
    /**send requests premium*/
    public function requestpremium($id){
        $this->Model->sendrequest($id['request_user_id']);
//        $this->home();
        require "views/home.view.php";
    }
    /**approve requests premium by admin*/
    public function approve($data){

        $this->Model->approveondb( $data['user_id']);
        header("location:/checkrequest");
    }

}