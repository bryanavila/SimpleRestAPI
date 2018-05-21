<?php


class config{

    private $host = "localhost";
    private $db = "dbtest";
    private $user = "root";
    private $pass = "";

    public function connection(){

        try{
            $dns = "mysql:host=$this->host;dbname=$this->db";
            $con = new PDO($dns, $this->user, $this->pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $con;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


?>