<?php
require 'components/_database.php'
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .container1 {
            min-height: 500px;
        }
    </style>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Programming Wiz</title>
</head>

<body>

    <?php
    require 'components/_header.php';
    require 'components/_loginModal.php';
    require 'components/_signupModal.php';
    ?>

    <div class="container1 container my-4">

        <?php

        $id = $_GET['threadid'];
        //for views
        $views= (mysqli_query($connect, "SELECT views FROM threads WHERE thread_id=$id")->fetch_object()->views);
        $views++;
        mysqli_query($connect, "UPDATE `threads` SET `views` = $views WHERE `threads`.`thread_id` = $id;");
        //
        $rand = rand();

        if (!isset($_SESSION['rand'])) {
            $_SESSION['rand'] = $rand;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['randcheck'] == $_SESSION['rand']) {
            $commentDescription = $_POST['commentDescription'];
            $commentUsername = $_POST['username'];
            $sql = "INSERT INTO `comments` (`username`, `comment_description`, `thread_id`, `comment_time`) VALUES ('$commentUsername', '$commentDescription', '$id', current_timestamp())";
            $result = mysqli_query($connect, $sql);
            // header('redirectthread.php');
        }

        $fetchQuestions = "SELECT * FROM `threads` WHERE thread_id=$id";
        $questionResult = mysqli_query($connect, $fetchQuestions);
        $questions = mysqli_fetch_assoc($questionResult);
        echo '<div class="jumbotron">
            <h1 class="display-4">' . $questions['thread_title'] . '</h1>
            <p class="lead" style="white-space: pre-wrap;">' . $questions['thread_description'] . '</p>
              <h5>By: ' . $questions['thread_username'] . '</h5>
        </div>';
        echo '       
            <h2>Post comment</h2>';

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<form class="was-validation" action="' . $_SERVER['REQUEST_URI'] . '" method="post" >
            <div class="form-group"><textarea class="form-control" id="comment" name="commentDescription"  rows="8" style="width: 100%;" required></textarea>
             </div>
             <div class="invalid-feedback">
               Comment cannot be empty
             </div>
             <input type="hidden" value="' . $_SESSION['rand'] . '" name="randcheck" />
             <input type="hidden" name="username" value="' . $_SESSION['username'] . '">
                <button type="submit" class="btn btn-primary">Post</button>
             </form>';
        } else {
            echo '<div class="alert alert-info" role="alert">
            <h4 class="alert-heading">You must be logged in to comment</h4>
          </div>';
        }

        echo '<br><h2>Comments</h2>';



        $commentsql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $commentResult = mysqli_query($connect, $commentsql);
        if($num = mysqli_num_rows($commentResult)){
            echo '    <table id="myTable" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="width:8%">Posted by</th>
                    
                    <th style="width:75%">Replies</th>
                    <th style="width:17%">At</th>
                    
                </tr>
            </thead>
            <tbody>
            ';
        while ($comments = mysqli_fetch_assoc($commentResult)) {
            $time=$comments['comment_time'];
            $format = mysqli_query($connect, "SELECT DATE_FORMAT('$time', '%h:%i %p %d %b %Y')")->fetch_row();
            echo '<tr class="text-dark">
            <td>' . $comments['username'] . '</td>
            
            <td style="white-space: pre-wrap;">' . $comments['comment_description'] . '</td>
            <td>' . $format[0] . '</td>
        </tr>';
        }}
        else{
            echo '<div class="alert alert-info" role="alert">
            <h4 class="alert-heading">No Replies Yet</h4>
            <hr>
            <p class="mb-0">Be the first one to reply</p>
          </div>';
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
                "order": [
                    [2, "desc"]
                ]
            })

        });
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
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