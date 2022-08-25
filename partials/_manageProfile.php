<?php
    include '_dbconnect.php';
    session_start();
    $userId = $_SESSION['userId'];


    if(isset($_POST["updateProfileDetail"])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $phone = $_POST["phone"];
        $password =$_POST["password"];

        $passSql = "SELECT * FROM users WHERE id='$userId'";
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        if ($password === $passRow['password']){
            $sql = "UPDATE `users` SET `firstName` = '$firstName', `lastName` = '$lastName', `phone` = '$phone' WHERE `id` ='$userId'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>alert("Update successfully.");
                        window.history.back(1);
                    </script>';
            }else{
                echo '<script>alert("Update failed, please try again.");
                        window.history.back(1);
                    </script>';
            }
        }
        else {
            echo '<script>alert("Password is incorrect.");
                        window.history.back(1);
                    </script>';
        }
    }

?>
