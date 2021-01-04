<?php
require 'components/_database.php'
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Programming Wiz</title>
</head>

<body>
    <?php
    require 'components/_header.php';
    require 'components/_loginModal.php';
    require 'components/_signupModal.php';
    ?>

    <div class="container my-4">

        <?php

        $id = $_GET['catid'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $threadUsername = $_POST['username'];
            $threadTitle = $_POST['thread_title'];
            $threadDescription = $_POST['thread_description'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_username`, `timestamp`) VALUES ('$threadTitle', '$threadDescription', '$id', '$threadUsername', current_timestamp())";
            $result = mysqli_query($connect, $sql);
        }

        $fetchThread = "SELECT * FROM `categories` WHERE category_id=$id";
        $threadResult = mysqli_query($connect, $fetchThread);
        $thread = mysqli_fetch_assoc($threadResult);
        echo '<div class="jumbotron">
            <h1 class="display-4">' . $thread['category_name'] . '</h1>
            <p class="lead">' . $thread['category_description'] . '</p>
            <!-- <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p> -->
        </div>';
        ?>

        
            <h2>Post a Question</h2>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="mb-3">
                <label for="thread_title" class="form-label">Question</label>
                <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp"><input type="hidden" name="username" value="' . $_SESSION['username'] . '">
                <div id="emailHelp" class="form-text">Keep it as concise as possible.</div>
            </div>
            <div class="form-group">
                <label for="thread_description">Description</label>
                <textarea class="form-control" id="thread_description" name="thread_description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>';
            } else {
                echo 'You must be logged in to Post a question.';
            }

            ?>
            <h2>Discussions</h2>
        

        <?php
        $fetchQuestions = "SELECT * FROM `threads` WHERE thread_category_id=$id";
        $questionResult = mysqli_query($connect, $fetchQuestions);
        while ($questions = mysqli_fetch_assoc($questionResult)) {
            echo '<div class="media">
            <img src="images/defaultuser.png" width="50px" class="mr-3" alt="...">
            <div class="media-body">
            <a href="thread.php?threadid=' . $questions['thread_id'] . '"><h5 class="mt-0">' . $questions['thread_title'] . '</h5></a>
                <p>' . $questions['thread_description'] . '</p></div>' . $questions['thread_username'] . ' at ' . $questions['timestamp'] .'
            
        </div>';
        }
        ?>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <?php include 'components/_footer.php' ?>
</body>

</html>