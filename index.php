<?php  
	
	//header("location:template.php");
	require 'functions.php';
	  if(isset($_POST["login"])){
	    $username = $_POST["username"];
	    $password = $_POST["password"];
	    if(masukkanData(" SELECT * FROM akun_admin 
	                      WHERE username_admin='$username' AND 
	                      password_admin='$password'")){
	      session_start();
	      $_SESSION["username"]=$username;
	      $_SESSION["password"]=$password;
	      echo '  <script> 
	                alert("Login Berhasil!"); 
	                document.location.href= "template.php";
	              </script>';
	    } else {
	      echo '  <script> 
	                alert("Login Gagal!"); 
	                document.location.href= "login.php";
	              </script>';
	    }
	  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body class="text-center" style="background-color: rgb(39, 93, 59);">
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col" style="background-color: white; padding: 10px;">
        <form action="" method="post">
          <img src="foto/Corel.png" width="75" height="75" class="d-inline-block align-top" alt="" loading="lazy" style="margin: 10px;">
          <h3>FORM <b>LOGIN</b></h3>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
          </div>
          <button class="btn btn-success" type="login" name="login" style="width: 100%;">Login</button>
        </form>
      </div>
      <div class="col"></div>
    </div>
  </div> 
</body>
</html>