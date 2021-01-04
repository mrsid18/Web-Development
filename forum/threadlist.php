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

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css">

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
        $rand = rand();

        if(!isset($_SESSION['rand'])){
            $_SESSION['rand']=$rand;
          }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['randcheck']==$_SESSION['rand']) {
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
        </div>';
        ?>


        <h2>Ask Question</h2>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="mb-3">
                <label for="thread_title" class="form-label">Question</label>
                <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp" required><input type="hidden" name="username" value="' . $_SESSION['username'] . '">
                <div id="emailHelp" class="form-text">Keep it as concise as possible.</div>
            </div>
            <div class="form-group">
                <label for="thread_description">Description</label>
                <textarea class="form-control" id="thread_description" name="thread_description" rows="3"></textarea>
            </div>
            <input type="hidden" value="' . $_SESSION['rand'] . '" name="randcheck" />
            <button type="submit" class="btn btn-primary">Post</button>
        </form>';
        } else {
            echo '<div class="alert alert-info" role="alert">
            <h4 class="alert-heading">You must be logged in to add a thread</h4>
          </div>';
        }

        ?>
        <h2>Discussions</h2>

        <table id="myTable" class="table table-hover table-light table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Topic</th>
                    <th>Topic Starter</th>
                    <th>Replies</th>
                    <th>Views</th>
                    <th>Last Post</th>

                </tr>
            </thead>
            <tbody>
        
        <?php
    //    error_reporting(E_ERROR | E_PARSE);
        $fetchQuestions = "SELECT * FROM `threads` WHERE thread_category_id=$id";
        $questionResult = mysqli_query($connect, $fetchQuestions);
       
        // while ($questions = mysqli_fetch_assoc($questionResult)) {
        //     echo '<div class="media">
        //     <img src="images/defaultuser.png" width="50px" class="mr-3" alt="...">
        //     <div class="media-body">
        //     <a href="thread.php?threadid=' . $questions['thread_id'] . '"><h5 class="mt-0">' . $questions['thread_title'] . '</h5></a>
        //         <p>' . $questions['thread_description'] . '</p></div>' . $questions['thread_username'] . ' at ' . $questions['timestamp'] . '
            
        // </div>';
        // }
        $i = 0;
        while ($questions = mysqli_fetch_assoc($questionResult)){
            $threadid = $questions['thread_id'];
            $views= (mysqli_query($connect, "SELECT views FROM threads WHERE thread_id=$threadid")->fetch_object()->views);
            $fetchReplies = "SELECT * FROM `comments` WHERE thread_id=$threadid";
            $fetchLastViewed ="SELECT * FROM comments WHERE thread_id=$threadid ORDER BY comment_time DESC LIMIT 1";
            $lastViewed = mysqli_fetch_assoc(mysqli_query($connect, $fetchLastViewed));
            $formatedtime = (mysqli_query($connect, $fetchLastViewed)->fetch_object()->comment_time);
            $format = mysqli_query($connect, "SELECT DATE_FORMAT('$formatedtime', '%h:%i %p %d %b %Y')")->fetch_row();
            $replies = mysqli_num_rows((mysqli_query($connect, $fetchReplies)));
            echo '
            <tr class="text-dark">
                <td>'.++$i.'</td>
                <td><a  class="text-dark" href="thread.php?threadid=' . $questions['thread_id'] . '">' . $questions['thread_title'] . '</a></td>
                <td>' . $questions['thread_username'] . '</td>
                <td>' .$replies . '</td>
                <td>' .$views. '</td>
                <td>' .$format[0]. '</td>
            </tr>
        ';
        }

        ?>
        </tbody>
    </table>

    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    
    
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                searching: false,
                info: false,
                "bLengthChange": false,
                "pageLength": 25,
            })
            
        });
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <?php include 'components/_footer.php' ?>
</body>

</html>