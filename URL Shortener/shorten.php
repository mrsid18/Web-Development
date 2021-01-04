<?php
session_start();
require_once 'classes/Shortener.php';

$s = new Shortener();

if (isset($_POST['url'])) {
    $url = $_POST['url'];
    
    if($code = $s->makeCode($url)){
        //successfully generated code
        session_start();
        $_SESSION['feedback'] = "<a href=\"http:\//localhost/urlshortener/{$code}\">http://localhost/urlshortener/{$code}</a>";
        header('Location: index.php');
    }
    else{
        $_SESSION['feedback'] = 'There was a problem. Invalid URL perhaps?';
    }
}
?>