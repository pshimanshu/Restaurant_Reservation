<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
      $showError = "Username Already Exists";
      header("Location: /project_rbs/index.php?signupsuccess=false&error=$showError");
    }
    else{
      $sql = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `phone`, `password`) VALUES ('$firstName', '$lastName', '$email', '$phone', '$password')";
      $result = mysqli_query($conn, $sql);
      if ($result){
          $showAlert = true;
          header("Location: /project_rbs/index.php?signupsuccess=true");
      }
    }
  }

?>
