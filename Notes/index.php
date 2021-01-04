<?php

$insert = false;
$update = false;
$delete = false;
$error = false;

$username = 'root';
$servername = 'localhost';
$password = '';
$database = 'notes';

$connection = mysqli_connect($servername, $username, $password, $database);

// DELETE FROM `test1` WHERE `test1`.`srno` = 12"
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sqlDelete = "DELETE FROM `test1` WHERE `test1`.`srno` = $sno";
  $result = mysqli_query($connection, $sqlDelete);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    $update = true;
    $snoEdit = $_POST['snoEdit'];
    $title = $_POST['titleUpdate'];
    $description = $_POST['descriptionUpdate'];

    $sql = "UPDATE `test1` SET `title` = '$title', `description` = '$description' WHERE `test1`.`srno` = $snoEdit";
    mysqli_query($connection, $sql);
  } 
  else {
    $insert = true;
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `test1` (`title`, `description`, `date`) VALUES ('$title', '$description', current_timestamp())";
    $result = mysqli_query($connection, $sql);
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <title>Notes</title>
  <style>
  body{
    font-family: 'Raleway', sans-serif;
  }
  h1{
    font-weight: 800;
    font-size: 5rem;
  }
  h2{
    font-weight: 300;
  }
  </style>
</head>

<body>


  <?php
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success</strong> Added a note succesfully.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  elseif ($update) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Successfully updated the note.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  elseif ($delete) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Successfully deleted the note.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  elseif ($error) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }

  ?>


  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
    Edit
  </button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php" method="POST">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleUpdate" name="titleUpdate" />
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="descriptionUpdate" rows="3" name="descriptionUpdate"></textarea>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container p-5 mt-3">
    <h1>Notes</h1>
    <form action="index.php" method="POST">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"><h5>Title</h5></label>
        <input type="text" class="form-control" id="title" name="title" />
      </div>
      <div class="mb-3">
        <label for="description" class="form-label"><h5>Description</h5></label>
        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
    <br>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col" style="width: 5%;">#</th>
          <th scope="col" style="width: 25%;">Title</th>
          <th scope="col" style="width: 53%;">Description</th>
          <th scope="col" style="width: 17%;">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $table = mysqli_query($connection, 'SELECT * FROM `test1`');
        $index = 1;
        while ($num = mysqli_fetch_assoc($table)) {
          echo '<tr>
            <th scope="row">' . $index++ . '</th>
            <td>' . $num['title'] . '</td>
            <td style="white-space: pre">' . $num['description'] . '</td>
            <td><button class="edit btn-primary btn-sm mx-3" id="' . $num['srno'] . '" >Edit</button><button class="delete btn-primary btn-sm" id=d"' . $num['srno'] . '">Delete</button></td>
          </tr>';
        }
        ?>

      </tbody>
    </table>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  <script>
    console.log('Welcome to Notes App');
    let myModal = new bootstrap.Modal(document.getElementById('editModal'));
    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log('edit');
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        titleUpdate.value = title;
        descriptionUpdate.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        myModal.show();
      })
    })

    let deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log('delete');
        console.log(e.target.id.substr(1));
        srno = e.target.id.substr(1);
        if(confirm('Do you want to permanently delete this note?')){
          window.location = `/notes/index.php?delete=${srno}`;
        }
        else{
          console.log('no');
        }
      })
    })
  </script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>