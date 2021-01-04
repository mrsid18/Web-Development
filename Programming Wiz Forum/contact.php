<?php
require 'components/_database.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        #contactus{
            padding: 5% 20%;
            
        }
    </style>
    <title>Contact us</title>
</head>

<body>
    <?php
    include 'components/_header.php';
    require 'components/_loginModal.php';
    require 'components/_signupModal.php';
    // if($_SESSION['feedback']){
    //     echo '<div class="alert alert-success" role="alert">
    //     <h4 class="alert-heading">Well done!</h4>
    //     <p>Succesfully Sent the message.</p>
    //     <hr>
    //     <p class="mb-0">Thanks!! We will reply to your message soon.</p>
    //   </div>';
    // }
    // else{
    //     echo 'false';
    // }
   
    
   echo '<div class="container my-4" id="contactus">';

    if(!$_SESSION['feedback']){   
    echo '<h1>Contact us</h1>
        <form action="redirectcontact.php" method="POST">
        <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" id="subject" required>
            </div>

            <div class="form-group">
                <label for="message">message</label>
                <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
        </div>';
    }
    else{
        echo '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Message Received!</h4>
        <p>Succesfully Sent the message.</p>
        <hr>
        <p class="mb-0">Thanks!! We will reply to your message soon.</p>
      </div>';
      unset($_SESSION['feedback']);
    }
        ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>