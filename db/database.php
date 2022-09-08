<?php

include_once 'config.php';

$todoHost="localhost";

class Database{    

    private $host="";
    private $db="";   
    private $user="";
    private $pass="";

    public $conn;

    public function setConfig($host, $bd, $user,$pass){
        $this->host = $host;
        $this->db =  $bd;
        $this->user =$user;
        $this->pass = $pass;
    }

    public function GetConn(){

        $this->conn=null;

        try{
            $this->conn =  new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
        }catch(PDOException $exception){
            echo "Error en conexion!!!: ".$exception->getMessage();
        }

        return $this->conn;
    }


}
?>