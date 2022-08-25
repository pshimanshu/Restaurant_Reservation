<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['updateStatus'])) {
        $bookingId = $_POST['bookingId'];
        $status = $_POST['status'];

        $sql = "UPDATE `bookings` SET `bookingStatus`='$status' WHERE `bookingId`='$bookingId'";
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('update successfully');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }

}

?>
