<?php
 include 'database.php';
class Login{

    function userLogin($db,$data){
        $query = "SELECT name, email FROM user_master WHERE email = '".$data['email']."' AND password = '".$data['password']."'";
        $result = $db->getLogin($query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST) && $_POST['type'] == 'Login'){
        $db = new Database();
        $email = isset($_POST['email'])?$_POST['email']:"";
        $password = isset($_POST['password'])?$_POST['password']:"";
        if(empty($email)){
            echo json_encode(array('success'=>false,'message'=>"Email is required"));
            die;
        }
        if(empty($password)){
            echo json_encode(array('success'=>false,'message'=>"Password is required"));
            die;
        }
        $login = new Login();
        $result = $login->userLogin($db,array('email'=>$email,'password'=>$password));
        if($result['success'] == true){
            session_start();
            // print_r($result);die;
            $_SESSION["username"] = $result['data']['name'];
            $_SESSION["email"] = $result['data']['email'];
            echo json_encode(array('success'=>true,'message'=>"Login successfully"));
        }else{
            echo json_encode(array('success'=>false,'message'=>"Invalid email or password"));
        }
    
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    session_start();
    session_unset(); 
    session_destroy(); 
    header("Location: login.php");
}else{
    session_start();
    session_unset(); 
    session_destroy(); 
    header("Location: login.php");
}


?>