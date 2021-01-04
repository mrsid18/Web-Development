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
        #maincontainer{
            min-height: 100vh;
        }
    </style>
    <title>Contact us</title>
</head>

<body>
    <?php
    include 'components/_header.php';
    require 'components/_loginModal.php';
    require 'components/_signupModal.php';
    ?>
  <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search_query']?>"</em></h1>

        <?php  
        $noresults = true;
        $query = $_GET["search_query"];
        $sql = "select * from threads where match (thread_title, thread_description) against ('$query')"; 
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_description']; 
            $thread_id= $row['thread_id'];
            $url = "thread.php?threadid=". $thread_id;
            $noresults = false;

            // Display the search result
            echo '<div class="result">
                        <h3><a href="'. $url. '" class="text-dark">'. $title. '</a> </h3>
                        <p>'. mb_strimwidth($desc, 0, 1000, ' ') .' <strong>Read More</strong></p>

                  </div>'; 
            }
        if ($noresults){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead"> Suggestions: <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords. </li></ul>
                        </p>
                    </div>
                 </div>';
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