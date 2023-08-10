<?php
require "../connection/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Admin Login</title>
    <style>
/*admin login*/
*{
    padding:0;
    margin:0;
    box-sizing: border-box;
    font-family: poppins;
    text-decoration: none;
}
.user{
    background-color: red;
    border-radius: 50%;
    width: 3em;
    height: 3em;
    margin-left: 83em;
    margin-top: 1em;
}
.user i{
    align-items:center;
    margin-top: 1em;
    margin-left: 1em;

}
.head a{
    text-decoration: none;
}
.head img{
    height: 7em;
    width: 7em;
}

body{
    background:url("https://www.bmw-motorrad.in/content/dam/bmwmotorradnsc/marketIN/bmw-motorrad_in/multiimages/S-1000-RR-Homepage-1.jpg.asset.1669984362604.jpg");
}

.login-form {
  width: 400px;
  border-radius: 8px;
  padding: 30px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(9px);
  /* -webkit-backdrop-filter: blur(9px); */
  margin-left: 30em;
  margin-top: 10em;
  /* background-color: #544D4f; */
}
form {
  display: flex;
  flex-direction: column;
}
h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #fff;
}
.input-field {
  position: relative;
  border-bottom: 2px solid #ccc;
  margin: 15px 0;
}
.input-field label {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  color: #fff;
  font-size: 16px;
  pointer-events: none;
  transition: 0.15s ease;
}
.input-field input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #fff;
}
.input-field input:focus~label,
.input-field input:valid~label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
}
.forget {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 25px 0 35px 0;
  color: #fff;
}
#remember {
  accent-color: #fff;
}
.forget label {
  display: flex;
  align-items: center;
}
.forget label p {
  margin-left: 8px;
}
.login-form a {
  color: #efefef;
  text-decoration: none;
}
.login-form a:hover {
  text-decoration: underline;
}
button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}
button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}
.register {
  text-align: center;
  margin-top: 30px;
  color: #fff;
}

</style>

</head>
<body>

    <div class="head">
        <a href="../admin/index.php"><div class="user">
        <i class="fa-solid fa-backward"></i>
        <h4 style="margin-top:13px;">Website</h4>
        </div></a>
        
    </div>
    <div class="login-form">
    <form method="POST" action="">
      <h2>Login</h2>
        <div class="input-field">
            Username
        <input type="text" name="adminname" required>
        <!-- <label>Username</label> -->
      </div>
      <div class="input-field">
        Password
        <input type="password"name="adminpassword" required>
        <!-- <label>Password</label> -->
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
      </div>
      <button type="submit" name="login">Log In</button>
    </form>
  </div>

    <?php

    if(isset($_POST['login']))
    {
        $query="SELECT * from `admin_login` WHERE `admin_name`='$_POST[adminname]' AND `admin_password`='$_POST[adminpassword]'";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==1)
        {
            session_start();
            $_SESSION['adminloginid']=$_POST['adminname'];
            header("location:../admin/admindashboard.php");

        }
        else
        {
            echo "<script>alert('Invalid Username or Password');</script>";
        }
    }

    ?>
</body>
</html>