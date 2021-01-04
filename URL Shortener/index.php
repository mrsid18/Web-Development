<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"><style>
  body{
    font-family: 'Raleway', sans-serif;
   margin-top: 13vw;
  }
  h1{
    font-weight: 800;
    font-size: 5rem;
  }
  h4{
    font-weight: 300;
  }
  </style>
  <title>Url Shortener</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1>Short links, big results</h1>
        <h4>A URL Shortener that makes saving large links easier</h4>
      </div>
    </div>

      <div class="container mb-3">
        <form action="shorten.php" method="POST">
        <?php
        session_start();
        if (isset($_SESSION['feedback'])) {
          echo '<h4>Here\'s your link :' . $_SESSION['feedback'] . '</h4>';
          
        }
        else{
          echo '<h4 id="lastUrl"></h4>';
        }
        ?>
        <!-- <label for="url" class="form-label">URL</label> -->
        <input type="text" name="url" class="form-control" id="url" aria-describedby="help">
        <!-- <div id="help" class="form-text">We'll never share your email with anyone else.</div> -->
      <button type="submit" class="btn mt-3 btn-warning btn-lg btn-block" style="width: 12vw;">Shorten link</button>
      
    </form>
      </div>
  

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script><?php  if (isset($_SESSION['feedback'])) {?>
  localStorage.setItem("lastUrl", '<?php echo $_SESSION['feedback']; unset($_SESSION['feedback']);?>');<?php } ?>
  document.getElementById('lastUrl').innerHTML ="Last Created Link: " 
  + localStorage.getItem('lastUrl');

</script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>