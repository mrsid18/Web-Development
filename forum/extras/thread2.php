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
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .container {
            min-height: 500px;
        }</style>
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
        $id = $_GET['threadid'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $commentDescription = $_POST['commentDescription'];
            $commentUsername = $_POST['username'];
            $sql = "INSERT INTO `comments` (`username`, `comment_description`, `thread_id`, `comment_time`) VALUES ('$commentUsername', '$commentDescription', '$id', current_timestamp())";
            $result = mysqli_query($connect, $sql);
        }

        $fetchQuestions = "SELECT * FROM `threads` WHERE thread_id=$id";
        $questionResult = mysqli_query($connect, $fetchQuestions);
        $questions = mysqli_fetch_assoc($questionResult);
        echo '<div class="jumbotron">
            <h1 class="display-4">' . $questions['thread_title'] . '</h1>
            <p class="lead">' . $questions['thread_description'] . '</p>
            <!-- <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p> -->
        </div>';
        echo '       
            <h2>Add a comment</h2>';

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="form-group"><textarea class="form-control" id="comment" name="commentDescription" rows="3"></textarea>
             </div>
             <input type="hidden" name="username" value="' . $_SESSION['username'] . '">
                <button type="submit" class="btn btn-primary">Comment</button>
             </form>';
        }
        else{
          echo '<p>You must be logged in to post a comment</p>';
        }

        echo '<br><h2>Comments</h2>';


        $commentsql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $commentResult = mysqli_query($connect, $commentsql);
        while ($comments = mysqli_fetch_assoc($commentResult)) {
            echo '<div class="media">
                <img src="images/defaultuser.png" width="50px" class="mr-3" alt="...">
                <div class="media-body">
                <h5 class="mt-0">' .$comments['username'] .' at ' . $comments['comment_time'] . '</h5>
                    <p>' . $comments['comment_description'] . '</p>
                </div>
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