<?php
include '_dbconnect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $slotId = $_SESSION['slotid'];
    if(isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];
        // Check whether this item exists
        $existSql = "SELECT * FROM `viewcart` WHERE `itemId` = '$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Item Already Added.');
                    window.history.back(1);
                    </script>";
        }
        else{
            $sql = "INSERT INTO `viewcart` (`itemId`, `itemQuantity`, `userId`, `addedDate`) VALUES ('$itemId', '1', '$userId', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>
                    window.history.back(1);
                    </script>";
            }
        }
    }
    if(isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `viewcart` WHERE `itemId`='$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
                window.history.back(1);
            </script>";
    }
    if(isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed All');
                window.history.back(1);
            </script>";
    }
    if(isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $address1 = $_POST["address"];
        $address2 = $_POST["address1"];
        $phone = $_POST["phone"];
        $slotId = $_SESSION['slotid'];
        $password = $_POST["password"];
        $address = $address1.", ".$address2;

        $passSql = "SELECT * FROM users WHERE id='$userId'";
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        $email = $passRow['email'];
        if ($password === $passRow['password']){
            $sql = "INSERT INTO `bookings` (`slotId`, `userId`, `address`, `phoneNo`, `amount`, `bookingStatus`) VALUES ('$slotId', '$userId', '$address', '$phone', '$amount', '0')";
            $result = mysqli_query($conn, $sql);
            $bookingId = $conn->insert_id;
            if ($result){
                $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'";
                $addResult = mysqli_query($conn, $addSql);
                while($addrow = mysqli_fetch_assoc($addResult)){
                    $itemId = $addrow['itemId'];
                    $itemQuantity = $addrow['itemQuantity'];
                    $itemSql = "INSERT INTO `bookingitems` (`bookingId`, `itemId`, `itemQuantity`) VALUES ('$bookingId', '$itemId', '$itemQuantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                }
                $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
                unset($_SESSION['slotid']);
                $deleteresult = mysqli_query($conn, $deletesql);
                echo '<script>alert("Thanks for booking with us. Your booking id is ' .$bookingId. '.");
                    window.location.href="http://localhost/project_rbs/index.php";
                    </script>';
                    exit();
            }
        }
        else{
            echo '<script>alert("Incorrect Password! Please enter correct Password.");
                    window.history.back(1);
                    </script>';
                    exit();
        }
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $itemId = $_POST['itemId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `viewcart` SET `itemQuantity`='$qty' WHERE `itemId`='$itemId' AND `userId`='$userId'";
        $updateresult = mysqli_query($conn, $updatesql);
    }

}
?>
