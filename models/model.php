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

    public function addArtist($artist,$image){
        try {
            $artistname =$artist['artistName'];
            $images=$image['artist'];
            var_dump($image);

            $this->db->query("Insert into artist (artist_name) values ('$artistname')");
            $getting_data=$this->db->query("select * from artist order by id desc limit 1");
            $getting_data=  $getting_data->fetch(PDO::FETCH_OBJ);
            var_dump($getting_data->id);

            $tasksTotal = count($image['artist']['name']);
            for( $i=0 ; $i < $tasksTotal ; $i++ ) {
                $newFilePath = "images/artist/".$image['artist']['name'][$i];
                $tmpFilePath = $image['artist']['tmp_name'][$i];
                move_uploaded_file($tmpFilePath, $newFilePath);
                $this->db->query("Insert into images (image_path,artist_id) values ('$newFilePath','$getting_data->id')");
            }
        }
        catch (PDOException $e){
            die($e->getMessage());
        }
    }

}
