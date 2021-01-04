<?php
require '_database.php';
$error=false;
$user=false;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    $sql1="SELECT * FROM `users` WHERE username='$loginUsername'";
    $result1=mysqli_query($connect,$sql1);
    $num = mysqli_num_rows($result1);
    $credentials =  mysqli_fetch_assoc($result1);
    $url = $_SERVER['HTTP_REFERER'];
    if($num>0){
        $user=true;
        if(password_verify($loginPassword,$credentials['password'])){
            
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $loginUsername;
            $_SESSION['userid'] = $credentials['user_id'];
            
            header('Location:'.$url);
            // header('Location:/forum/index.php?user=' . $user . '&loginError=' . $error);
        }
        else{
            $error=true;
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['loginError']=$error;
            header('Location:'. $url);
        }
    }

    else{
        $error=true;
        session_start();
            $_SESSION['user'] = $user;
            $_SESSION['loginError']=$error;
        header('Location:'. $url);
        // header('Location:/forum/index.php?user=' . $user . '&loginError=' . $error);
    }
}
?>