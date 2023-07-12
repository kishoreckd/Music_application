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
    public  function addplaylistname($datas){
        if ($datas){
            $this->Model->addplaylistname($datas);
            $this->home();
        }
        else{
            $album=$this->Model->showMusic();

            require "views/addplaylist.view.php";
        }

    }

    public function showplaylist(){
       $playlist= $this->Model->showplaylistdb();
        require "views/home.view.php";

    }
    public function addplaylistview($albums){
        $oneplaylist = $this->Model->showoneplaylistdb($albums['projectId']);

        $songs =$this->Model->showsongsforplaylist($albums['projectId']);

        require "views/showingplaylist.view.php";
    }

    public function addplaylist($data){
        $oneplaylist = $this->Model->showoneplaylistdb($data['playlist_id']);
        $album=$this->Model->showMusic();

        require "views/addsongplaylist.php";
    }
    public function addsongplaylist($data){
    $this->Model->addsongplaylistdb($data);
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
               $checking_id=$check->id;
               $checkpremium =$this->Model->checkpremium($checking_id);
               $ispremium =$this->Model->is_premium($checking_id);
               $_SESSION['id']=$checkpremium->id;

               $_SESSION['premiumid']=$ispremium->id;
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
        unset($_SESSION['songerror']);
        if ($data and $musicImage){
            $validate_song =$this->Model->validation($data['musicName']);
            if ($validate_song){
                $_SESSION['songerror']='Song name already existed';
                $artistname =$this->Model->showArtist();
                require "views/addmusic.view.php";
            }
            else{
                $this->Model->addMusic($data,$musicImage);
                $this->home();
            }
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