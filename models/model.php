<?php

class database
{
    public $db;
    public function __construct(){
        try {
            $this->db= new PDO
            ("mysql:host=localhost;dbname=music",
                "dckap",
                "Dckap2023Ecommerce");
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
//            var_dump($music,$musicImage['music']);
            $musicname =$music['musicName'];
            $artistname =$music['artist'];

            $this->db->query("Insert into album (album_name,album_artist,created_at) values ('$musicname','$artistname',now())");
            $getting_data_album=$this->db->query("select * from album order by id desc limit 1");
            $getting_data_album=  $getting_data_album->fetch(PDO::FETCH_OBJ);

                $newFilePath = "images/music/".$musicImage['music']['name'];
                $tmpFilePath = $musicImage['music']['tmp_name'];
                move_uploaded_file($tmpFilePath, $newFilePath);
                $this->db->query("Insert into images (image_path,album_id) values ('$newFilePath','$getting_data_album->id')");
        }
        catch (PDOException $e){
            die($e->getMessage());
        }
    }
    public function validation($song){
        return $this->db->query("select * from album where album_name='$song'" )->fetchAll(PDO::FETCH_OBJ);

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
    public function addplaylistname($data){
        $Playlistname =$data['playlist_name'];
        $this->db->query("Insert into playlist_name (playlistname,created_at) values ('$Playlistname',now())");

    }
    public function showplaylistdb(){
       return $this->db->query("select * from playlist_name")->fetchAll(PDO::FETCH_OBJ);

    }
    public function addsongplaylistdb($data){
        $playlist_id =$data['playlist_id'];
        $albumidcount =count($data['album']);
        $album_id =$data['album'];

        for ($i=0;$i<$albumidcount;$i++){
            $this->db->query("Insert into playlist(playlist_id,album_id,created_at) values ('$playlist_id','$album_id[$i]',now())");

        }
    }
    public function showoneplaylistdb($id){
        return $this->db->query("select * from playlist_name where id =$id")->fetchAll(PDO::FETCH_OBJ);

    }
    public  function showsongsforplaylist($id){
        return $this->db->query("select album.album_name from playlist join album on playlist.album_id = album.id where playlist.playlist_id = '$id';")->fetchAll(PDO::FETCH_OBJ);
    }
    public  function fetchsong($id){
        return $this->db->query("select * from album where playlist_id =$id")->fetchAll(PDO::FETCH_OBJ);
    }
//    public function addplaylistartist($data){
//        foreach ($data['album'] as $datas){
//            $this->db->query("Insert into playlist (artist_id,created_at) values ('$datas',now())");
//        }
//    }



    public function sendrequest($id){
        $this->db->query("Insert into request (user_id,is_approved) values ('$id',0)");
    }

    public function checkpremium($id){
        $checkuser=$this->db->query("select * from registration where id ='$id' AND is_premium=0")->fetch(PDO::FETCH_OBJ);
        return $checkuser;
    }
    public function is_premium($id){
        $checkuser=$this->db->query("select * from registration where id ='$id' AND is_premium=1")->fetch(PDO::FETCH_OBJ);
        return $checkuser;
    }
    public function checkrequest(){
        $checkrequest=$this->db->query("select * from request ")->fetchAll(PDO::FETCH_OBJ);
        return$checkrequest;
    }
    public function checkingrequest(){
        $checkrequest =$this->checkrequest();
        foreach ($checkrequest as $request){
//            var_dump(/);
            $user=$this->db->query("select * from registration where id ='$request->user_id'")->fetch(PDO::FETCH_OBJ);
            return $user;
        }
    }

    public function approveondb($id){
        $this->db->query("UPDATE registration SET is_premium = 1
WHERE id ='$id'");
        $this->db->query("UPDATE request  SET is_approved = 1
WHERE user_id ='$id'");
    }
}
