<?php
$insert = false;
$update = false;
$delet = false;
//connecting to the database //
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";
//create connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("connection is not sucessully" . mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sn = $_GET['delete'];
  $delet = true;
  $sql = "DELETE FROM `notes` WHERE `sn`='$sn'";
  $result = mysqli_query($conn, $sql);
  
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snedit'])) {
    $sn = $_POST['snedit'];
    $tittle = $_POST['tittle'];
    $desc = $_POST['Desc'];

    $sql = "UPDATE `notes` SET `Tittle`='$tittle',`description`='$desc' WHERE `sn`='$sn';";
    $result = mysqli_query($conn, $sql);
    if ($result) {

      $update = true;
    } else {
      echo "The record was not Updated successfully Because of this error".mysqli_error(($conn));

    }
  } else {
    $tittle = $_POST['tittle'];
    $desc = $_POST['Desc'];

    $sql = "INSERT INTO `notes`(`Tittle`,`description`)VALUES('$tittle','$desc')";
    $result = mysqli_query($conn, $sql);
    if ($result) {

      $insert = true;
    } else {
      echo "The record was not inserted successfully Because of this error" . mysqli_error(($conn));

    }
  }


}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script>

    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <title>CRUD_PROJECT</title>
</head>

<body>


  <!-- Edit modal -->
  <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
    Edit
  </button>-->

  <!--Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Notes</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./index.php" method="post">
        <div class="modal-body">
        
            <input type="hidden" name="snedit" id="snedit">
            <h2>Add a note</h2>
            <div class="mb-3">
              <label for="tittle" class="form-label">Note Tittle</label>
              <input type="text" class="form-control" id="tittledit" name="tittle" aria-describedby="emailHelp">

            </div>

            <div class="form-group mb-3">
              <label for="Desc ">Note Description</label>
              <textarea class="form-control" id="Descedit" name="Desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP_CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact US</a>
          </li>


        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Sucess!</strong> Your Notes has been inserted sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Sucess!</strong> Your Notes has been updated sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  if ($delet) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Sucess!</strong> Your Notes has been deleted sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  ?>
  <div class="container my-4 mx-30">
    <form action="./index.php" method="post">
      <h2>Add a note</h2>
      <div class="mb-3">
        <label for="tittle" class="form-label">Note Tittle</label>
        <input type="text" class="form-control" id="tittle" name="tittle" aria-describedby="emailHelp">

      </div>

      <div class="form-group mb-3">
        <label for="Desc ">Note Description</label>
        <textarea class="form-control" id="Desc" name="Desc" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>
  <div class="container">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Tittle</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `Notes`";
        $result = mysqli_query($conn, $sql);
        $sn = 0;
        while ($rows = mysqli_fetch_assoc($result)) {
          $sn = $sn + 1;
          echo "<tr>
          <th scope='row'>" . $sn . "</th>
          <td>" . $rows['Tittle'] . "</td>
          <td>" . $rows['description'] . "</td>
          <td><button class='edit btn btn-sm btn-primary' id=" . $rows['sn'] . ">Edit</button> <button class='delet btn btn-sm btn-primary' id=" . $rows['sn'] . ">Delete</button> 
        </tr>";

        }
        ?>



      </tbody>
    </table>

  </div>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", element);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        tittledit.value = title;
        Descedit.value = description;
        snedit.value = e.target.id
        console.log(title, description,);
        console.log(snedit)
        $('#editModal').modal('toggle');



      })
    })

    delet = document.getElementsByClassName('delet');
    Array.from(delet).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", element);
        tr = e.target.parentNode.parentNode;
        sn= e.target.id;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        
        if(confirm("Are you sure you want to delet")){
          console.log("yes")
          window.location=`/Crud/index.php?delete=${sn}`
          //create a form and use post request to submit a form//
        }
        else{
          console.log("no")
        }



      })
    })
    
    
  </script>

</body>

</html>