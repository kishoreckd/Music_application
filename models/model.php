<?php

class database
{
    public $db;
    public function __construct(){
        try {
            $this->db= new PDO
            ("mysql:host=localhost;dbname=music",
                "admin",
                "welcome");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

class Model extends database{


    /**it checks whether the user is admin or loginned**/
    public function registration($data){
        try {
            $email=$data['email'];
            $password=$data['password'];
            $check=$this->db->query("select * from registration where email_id ='$email' and password ='$password'")->fetch(PDO::FETCH_OBJ);
                return $check;
        }
        catch (PDOException $e){
            die($e->getMessage());
        }

    }
    public function checkadmin($data){
        try {
            $email=$data['email'];
            $password=$data['password'];
            $checkadmin=$this->db->query("select * from registration where email_id ='$email' and password ='$password' AND is_admin =1 ")->fetch(PDO::FETCH_OBJ);
            return $checkadmin;
        }
        catch (PDOException $e){
            die($e->getMessage());
        }

    }




    /**It inserts the artist name and image in db and in the local**/

    public function addArtist($artist,$image){
        try {
            $artistname =$artist['artistName'];
            $this->db->query("Insert into artist (artist_name,created_at) values ('$artistname',now())");
            $getting_data=$this->db->query("select * from artist order by id desc limit 1");
            $getting_data=  $getting_data->fetch(PDO::FETCH_OBJ);
            var_dump($getting_data->id);

            $tasksTotal = count($image['artist']['name']);
            for( $i=0 ; $i < $tasksTotal ; $i++ ) {
                $newFilePath = "images/artist/".$image['artist']['name'][$i];
                $tmpFilePath = $image['artist']['tmp_name'][$i];
                move_uploaded_file($tmpFilePath, $newFilePath);
                $this->db->query("Insert into images (image_path,artist_id,created_at) values ('$newFilePath','$getting_data->id',now())");

            }
        }
        catch (PDOException $e){
            die($e->getMessage());
        }
    }





    /**It inserts the artist name and image in db and in the local**/
    public  function  addMusic($music,$musicImage){
        try {
            $musicname =$music['musicName'];
            $artistname =$music['artist'];

            $this->db->query("Insert into album (album_name,album_artist,created_at) values ('$musicname','$artistname',now())");
            $getting_data_album=$this->db->query("select * from album order by id desc limit 1");
            $getting_data_album=  $getting_data_album->fetch(PDO::FETCH_OBJ);

            $tasksTotal = count($musicImage['music']['name']);
            for( $i=0 ; $i < $tasksTotal ; $i++ ) {
                $newFilePath = "images/music/".$musicImage['music']['name'][$i];
                $tmpFilePath = $musicImage['music']['tmp_name'][$i];
                move_uploaded_file($tmpFilePath, $newFilePath);
                $this->db->query("Insert into images (image_path,album_id) values ('$newFilePath','$getting_data_album->id')");
            }
        }
        catch (PDOException $e){
            die($e->getMessage());
        }
    }

    /**It fetches all the music in db and uses it on home page**/
    function showMusic(){
        $album=$this->db->query("select * from album" )->fetchAll(PDO::FETCH_OBJ);
        return$album;
    }
    /**It fetches all the artist in db and uses it for adding the music and also on home page**/
    function showArtist(){
        $artistnames=$this->db->query("select * from artist" )->fetchAll(PDO::FETCH_OBJ);
        return$artistnames;
    }
    public function addplaylistalbums($data){
        foreach ($data['album'] as $datas){
            $this->db->query("Insert into playlist (album_id,created_at) values ('$datas',now())");
        }
    }
    public function addplaylistartist($data){
        foreach ($data['album'] as $datas){
            $this->db->query("Insert into playlist (artist_id,created_at) values ('$datas',now())");
        }
    }
}
