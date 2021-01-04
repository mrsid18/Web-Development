<?php
require '_database.php';
echo 'here';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $error=false;
    $success=false;
    $signupUsername = $_POST['signupUsername'];
    $signupPassword = $_POST['signupPassword'];
    $confirmPassword = $_POST['signupConfirmPassword'];
    $hash = password_hash($signupPassword, PASSWORD_DEFAULT);

    $sql1="SELECT * FROM `users` WHERE username='$signupUsername'";
    $result1=mysqli_query($connect,$sql1);
    $num = mysqli_num_rows($result1);
    if($num>0){
        $error=true;
        header('Location:/forum/index.php?signupSuccess=' . $success . '&error=' . $error);   
    }
    else{
    if($signupPassword==$confirmPassword){
        $success=true;
        $sql="INSERT INTO `users` (`username`, `password`, `timestamp`) VALUES ('$signupUsername', '$hash', current_timestamp())";
        $result=mysqli_query($connect,$sql);
        header('Location:/forum/index.php?signupSuccess=' . $success);
        }
        else{
            $success=true;
            $error=true;
            header('Location:/forum/index.php?signupSuccess=' . $success . '&error=' . $error);   
        }
    }
}
?>