<?php
session_start();
require 'components/_database.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    echo 'HERE';
$name = $_POST['name'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$email = $_POST['email'];
$result=mysqli_query($connect,"INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES ('{$name}', '{$email}', '{$subject}', '{$message}');");
var_dump($result);
$_SESSION['feedback']=true;
}
else{
    $_SESSION['feedback']=false;
}
header('Location: contact.php');
?>