<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $email = $_SESSION['email'];
  $firstname = $_SESSION['firstname'];
}
else{
  $loggedin = false;
  $userId = 0;
}

$sql = "SELECT * FROM `sitedetail`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$systemName = $row['systemName'];

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">'.$systemName.'</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>';

            echo '
          <li class="nav-item">
            <a class="nav-link" href="viewBooking.php">Your Bookings</a>
          </li>

        </ul>';
          $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId";
          $countresult = mysqli_query($conn, $countsql);
          $countrow = mysqli_fetch_assoc($countresult);
          $count = $countrow['SUM(`itemQuantity`)'];
          if(!$count) {
            $count = 0;
          }
          echo '<a href="viewCart.php"><button type="button" class="btn btn-secondary mx-2" title="MyCart">
            <i class="bi bi-cart">Cart(' .$count. ')</i>
          </button></a>';

        if($loggedin){
          echo '<ul class="navbar-nav mr-2">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"> Welcome ' .$firstname. '</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="partials/_logout.php">Logout</a>
              </div>
            </li>
          </ul>
          <div class="text-center image-size-small position-relative">
            <a href="viewProfile.php"><img src="img/person-' .$userId. '.jpg" class="rounded-circle" onError="this.src = \'img/profilePic.jpg\'" style="width:40px; height:40px"></a>
          </div>';
        }
        else {
          echo '
          <button type="button" class="btn btn-success mx-2"  data-toggle="modal" data-target="#loginModal">Login</button>
          <button type="button" class="btn btn-success mx-2"  data-toggle="modal" data-target="#signupModal">SignUp</button>';
        }

  echo '</div>
    </nav>';

    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';

    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You can now login.
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['error']) && $_GET['signupsuccess']=="false") {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> ' .$_GET['error']. '
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You are logged in
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> Invalid Credentials
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
?>
