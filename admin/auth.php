<?php
session_start();
include('../config.php');

if(isset($_POST['login'])) {   
  
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['password']));    
    $sql = "SELECT * from admin";
    $result = mysqli_query($conn,$sql);
    while ($data = mysqli_fetch_array($result)) {
      
      if ($password != $data['password']){
            $_SESSION['password'] = "Invalid password";
              header("Location:Location:./login.php");
              
      }
      elseif ($username != $data['username']){
            $_SESSION['email'] = "Invalid email";
              header("Location:Location:./login.php");
      }
      else {
            $_SESSION['admin'] = "login success";
            header("Location:./dashboard.php");            
      }           
    }
}
else {
      header("Location:Location:./login.php");
}
