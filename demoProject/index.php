<?php 
session_start();
if(isset($_SESSION['name']) && isset($_SESSION['email'])){
header("Location: dashboard.php");
exit;
}else{
header("Location: login.php");
exit;

}
?>