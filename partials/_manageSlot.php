<?php
include '_dbconnect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $userId = $_SESSION['userId'];
  if(isset($_POST['submit'])) {
    $timeslot = $_POST['timeslot'];
    $date = $_POST['date'];
          $sql = "INSERT INTO `slots` (`userId`, `date`, `timeslot`) VALUES ('$userId', '$date', '$timeslot')";
          $result = mysqli_query($conn, $sql);
          $slotId = $conn->insert_id;
          if ($result){
            if (!isset($_SESSION['slotid'])){
              $_SESSION['slotid'] = $slotId;
            }
            header("location: /project_rbs/viewItemList.php?");

          }
          else{
            echo '<script>alert("There was an error. Please try again!");
                    window.history.back(1);
                    </script>';
                    exit();
          }
  }
}
 ?>
