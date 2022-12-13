<?php
   $showalert=false;
   $showerror =false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    require "./partials/_dbconnect.php";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];
    $exists=false;
    //check whether the username is exits//
    $existsqli = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn, $existsqli);
    $numexitRows = mysqli_num_rows($result);
    if($numexitRows>0){
        $exists = true;
        $showerror = "username already exits";
    }
    else{
        $exists = false;
        if(($password==$conpass)){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `email`, `password`, `Date`) VALUES ('$username', '$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showalert=true;
            }
    
        }
        else{
            $showerror = "password don't match or username already exits";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel=stylesheet href="./css/signup.css">
    <script
      src="https://kit.fontawesome.com/c7de1c6b77.js"
      crossorigin="anonymous"
    ></script>
    <title>Signup!</title>
  </head>
  <body>
  <?php
    require "./partials/_nav.php";
    ?>
    <?php
    if($showalert){
      echo ' <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong>Now your account is created.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showerror){
        echo ' <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <strong>Error!</strong>'.$showerror.'.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    ?>
   
  <section>
   
      <div class="formcontainer">
        <div class="img">
          <img src="./css/img/img1.webp" />
        </div>
        <form action="/loginsystem/signup.php" method="post">
          <div class="logo">
            <div class="logo-icon"><i class="fa-solid fa-car icon"></i></div>
            
            <h1>Typico</h1>
          </div>
          <h1 class="heading">Sign into your account</h1>
          <div class="input-field">
            <i class="fa-solid fa-user"></i>
            <input type="text" class="form_in" placeholder="username"  id="user" maxlength="20" name="username"/>
            <span id="nerror" class="error"></span>
          </div>
          <div class="input-field">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" class="form_in" placeholder="Email" id="email"  name="email"/>
            <span id="eerror" class="error"></span>
          </div>
          <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input type="password" class="form_in" placeholder="password" id="password" name="password" maxlength="20" autocomplete=""/>
            <span id="perror" class="error"></span>
          </div>
          <div class="input-field re-password">
            <i class="fa-solid fa-lock" id="rp"></i>
            <input type="password" class="form_in" placeholder="Re-type password" id="repassword" name="conpass" autocomplete="" />
            <span id="rperror" class="error"></span>
          </div>
         
           <button class="log_btn" id="btn">SIGNUP</button>
           <a href=""><p>Forgot password?</p></a>
           <div class="alreadyac">
            <p>Don't have an account? <a href="">Register here</a></p>
           </div>
          
        </form>
      </div>
    </section>
    <script src="./form.js"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
