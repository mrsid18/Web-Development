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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Programming Wiz</title>
    <style>
        * {
           
            margin: 0;
            padding: 0;
        }
        .container1{
            min-height: 87vh;
        }
        

    </style>
</head>

<body>
    <?php
    // error_reporting(E_ALL ^ E_WARNING); 
    require 'components/_header.php';
    require 'components/_loginModal.php';
    require 'components/_signupModal.php';

    
    //     if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == '1') {
    //         if (!isset($_GET['error'])) {
    //             echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    //     <strong>Successfully Created Account</strong> Please log in to continue.
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    //         } else {
    //             echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    //     <strong>Error!!</strong> Passwords do not match
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    //         }
    //     }
    //     elseif (isset($_GET['error']) && $_GET['error'] == '1') {
    //         echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    //     <strong>Error!!</strong> Username already exists
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    //     }
    

    // if (isset($_GET['loginError']) && isset($_GET['user'])) {
    //     if ($_GET['loginError'] == '1' && $_GET['user'] == '1') {
    //         echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    //     <strong>Error!!</strong> Username or Password is incorrect
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    //     } elseif ($_GET['loginError'] == '1' && $_GET['user'] == '') {
    //         echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    //     <strong>Error!!</strong> User does not exist
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    //     }
    // }


    ?>


    <!-- Picture slide -->
    <!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images\greg-rakozy-vw3Ahg4x1tY-unsplash (1).jpg" height="500px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/claudio-schwarz-purzlbaum-i25aqE_YUZs-unsplash.jpg" height="500px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\thought-catalog-505eectW54k-unsplash.jpg" height="500px" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div> -->

    <div class="container1 container my-4">
        
            <table class="table">
            <?php
            $mastersql="SELECT * FROM `master`";
            $master = mysqli_query($connect, $mastersql);
            while($element1 = mysqli_fetch_assoc($master)){
                $id=$element1['master_id'];
         echo' <thead>
            <tr>
                <th class="table-dark">'. $element1['master_heading'].'</th>
            </tr>
        </thead>
        <tbody>
            <td><table id="myTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width: 60%">Forum</th>
                <th style="width: 20%">Topics</th>
                <th style="width: 20%">Posts</th>
            </tr>
        </thead>
        <tbody>';
            
             $categories = mysqli_query($connect, "SELECT * FROM `categories` WHERE master_id=$id");
             while ($element = mysqli_fetch_assoc($categories)) {

                $replies=0;
                $catid=$element['category_id'];
                $result11=mysqli_query($connect, "SELECT * FROM `threads` WHERE `thread_category_id`=$catid");
                 while($element2=mysqli_fetch_assoc($result11)){
                     $threadid=$element2['thread_id'];
                $fetchReplies = "SELECT * FROM `comments` WHERE thread_id=$threadid";
                $replies += mysqli_num_rows((mysqli_query($connect, $fetchReplies)));}
                
                
                $posts = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `threads` WHERE thread_category_id=$catid"));
                echo '<tr>
                <td><a class="text-dark" href="threadlist.php?catid=' . $element["category_id"] . '">' . $element["category_name"] . '</a></td>
                <td>' . $posts . '</td>
                <td>' . $replies . '</td>
                
            </tr>';
                
            } echo '</tbody></table></td>';
        }  
       
        ?>
        </tbody>
        </table>
            <?php
            $categories = mysqli_query($connect, 'SELECT * FROM `categories`');
            while ($element = mysqli_fetch_assoc($categories)) {
        //         echo '<div class="col-md-4"><div class="card my-4" style="width: 18rem;">
        // <!--  <img src="..." class="card-img-top" alt="..."> -->
        // <div class="card-body">
        // <a href="threadlist.php?catid=' . $element['category_id'] . '"><h5 class="card-title">' . $element['category_name'] . '</h5></a>
        // <p class="card-text">' . $element['category_description'] . '</p>
        // <a href="threadlist.php?catid=' . $element['category_id'] . '" class="btn btn-primary">View Threads</a>
        // </div>
        // </div></div>';
                
            }
            ?>
             
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
                "paging":   false,
        "ordering": false,
            })
            
        });
        
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <?php include 'components/_footer.php' ?>
</body>

</html>