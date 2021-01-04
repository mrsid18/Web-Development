
<script src="https://kit.fontawesome.com/1d308a9b87.js" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum/"><i class="fas fa-lg fa-laptop-code"></i> Programming Wiz</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Forums
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            $categories = mysqli_query($connect, 'SELECT * FROM `categories`');
            while ($element = mysqli_fetch_assoc($categories)) {
              echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $element['category_id'] . '">' . $element['category_name'] . '</a></li>';
            } ?>
            <!-- // <li><a class="dropdown-item" href="#">Python</a></li>
            // <li><a class="dropdown-item" href="#">Java</a></li>
            // <li><a class="dropdown-item" href="#">Web Development</a></li> -->
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-nowrap" href="contact.php">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" name="search_query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary mx-1" type="submit">Search</button>

        <?php
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
          echo '<div class="text-nowrap mt-1 mx-2">Hello <strong>' . $_SESSION['username'] . '</strong></div>
          <a href="/forum/components/_logout.php"><button class="btn btn-outline-primary mx-2" type="button" >Logout</button></a>';
        }
        else{
          echo '<button class="btn btn-outline-primary mx-2" type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Register</button>
          <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
        }
        ?>
      </form>
    </div>
  </div>
</nav>
<?php include '_alert.php'; ?>