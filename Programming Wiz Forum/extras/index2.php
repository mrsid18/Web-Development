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
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/">
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

    if (isset($_GET['error'])) {
        if ($_GET['signupSuccess'] == '1') {
            if (!isset($_GET['error'])) {
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success</strong> Created a user account
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error</strong> Passwords do not match
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            }
        } elseif ($_GET['error'] == '1') {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error</strong> Username already exists
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }

    if (isset($_GET['loginError']) && isset($_GET['user'])) {
        if ($_GET['loginError'] == '1' && $_GET['user'] == '1') {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error</strong> Username or Password is incorrect
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        } elseif ($_GET['loginError'] == '1' && $_GET['user'] == '') {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error</strong> User does not exist
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }


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
        <div class="row">
            <h2>Categories</h2>
            <?php
            $categories = mysqli_query($connect, 'SELECT * FROM `categories`');
            while ($element = mysqli_fetch_assoc($categories)) {
                echo '<div class="col-md-4"><div class="card my-4" style="width: 18rem;">
        <!--  <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
        <a href="threadlist.php?catid=' . $element['category_id'] . '"><h5 class="card-title">' . $element['category_name'] . '</h5></a>
        <p class="card-text">' . $element['category_description'] . '</p>
        <a href="threadlist.php?catid=' . $element['category_id'] . '" class="btn btn-primary">View Threads</a>
        </div>
        </div></div>';
            }
            ?>
        </div>
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