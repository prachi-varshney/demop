<?php

class Database{

    private $username = "root";
    private $password = "";
    private $hostname = "localhost";
    private $dbname = "main";
    private $connection = NULL;

    function __construct(){
       $this->connection = $this->db_connect();
    }

    function db_connect(){
        $conn = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
        if ($conn-> connect_errno) {
            return (object) array('message'=> "Connection failed: " . $conn -> connect_error);
        }else{
            return $conn;
        }
    }

    function getData($query=""){
        try{
            if($this->connection){
                $result = $this->connection->query($query);
                // print_r($result);die;
                $count = mysqli_num_rows($result);
                if($count > 0){
                    return array("success"=> true,"message">"Data found","data"=>$result->fetch_all(MYSQLI_ASSOC));
                }  else{
                    return array("success"=> false,"message">"No data found","data"=>array());
                } 
            }else{
                return array("success"=> false,"message">"Database connection error","data"=>array());
            }

        }catch(Exception $e ){
            return array("success"=> false,"message">$e->getMessage(),"data"=>array());
        }
    }


    function runQuery($query)
    {
        if (!empty($this->connection)) {
            $dbres = $this->connection->query($query);
            $res = $this->connection->affected_rows;
            if ($res > 0) {
                return $res;
            } else {
                return false;
            }
        }
    }

    
    function getLogin($query)
    {
        if($this->connection){
            $result = $this->connection->query($query);
            // print_r($result);die;
            $count = mysqli_num_rows($result);
            if($count > 0){
                $data = $result->fetch_assoc();
                return array("success"=> true,"message">"Data found","data"=>$data);
            }  else{
                return array("success"=> false,"message">"No data found","data"=>array());
            } 
        }else{
            return array("success"=> false,"message">"Database connection error","data"=>array());
        }
    }


    function getEditRecord($query)
    {
        if($this->connection){
            $result = $this->connection->query($query);
            // print_r($result);die;
            $count = mysqli_num_rows($result);
            if($count > 0){
                $data = $result->fetch_assoc();
                return array("success"=> true,"message">"Data found","data"=>$data);
            }  else{
                return array("success"=> false,"message">"No data found","data"=>array());
            } 
        }else{
            return array("success"=> false,"message">"Database connection error","data"=>array());
        }
    }
}
?>