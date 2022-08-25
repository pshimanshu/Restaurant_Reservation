<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST["loginemail"];
    $password = $_POST["loginpassword"];

    $sql = "Select * from users where email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $userId = $row['id'];
        $firstname = $row['firstName'];
        if ($password === $row['password']){
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['email'] = $email;
          $_SESSION['userId'] = $userId;
          $_SESSION['firstname'] = $firstname;
          header("location: /project_rbs/index.php?loginsuccess=true");
          exit();
        }
        else{
          header("location: /project_rbs/index.php?loginsuccess=false");
        }
    }
    else{
        header("location: /project_rbs/index.php?loginsuccess=false");
    }
}
?>
