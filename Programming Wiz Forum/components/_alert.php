<?php
        if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == '1') {
            if (!isset($_GET['error'])) {
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Successfully Created Account</strong> Please log in to continue.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!!</strong> Passwords do not match
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            }
        }
        elseif (isset($_GET['error']) && $_GET['error'] == '1') {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!!</strong> Username already exists
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    if (isset($_SESSION['loginError']) && isset($_SESSION['user'])) {
        if ($_SESSION['loginError'] == '1' && $_SESSION['user'] == '1') {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!!</strong> Username or Password is incorrect
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        } elseif ($_SESSION['loginError'] == '1' && $_SESSION['user'] == '') {
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!!</strong> User does not exist
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
        unset($_SESSION['loginError']);
        unset($_SESSION['user']);
    }
    ?>