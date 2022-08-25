<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Your Booking</title>
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">
<style>
h4{
  margin-bottom: 3.5rem;
  margin-top:2rem;
}
.btn-padd{
  margin-top:5rem;
}
  #no-booking {
    background-image: url("img/no-booking.jpg");
    padding: 5rem;
    position: relative;
     display: flex;
     align-items: center;
     justify-content: center;
  }
  #no-booking::before{
    content: "";
   position: absolute;
   top: 0px;
   right: 0px;
   bottom: 0px;
   left: 0px;
   background-color: rgba(255,255,255,0.4);
  }
  .opacity-dec::before{
    opacity:0;
  }

    .footer {
      position: fixed;
      bottom: 0;
    }
    .table-wrapper {
    background: #fff;
    padding: 20px 25px;
    margin: 30px auto;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-wrapper .btn {
        float: right;
        color: #333;
        background-color: #fff;
        border-radius: 3px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }
    .table-wrapper .btn:hover {
        color: #333;
        background: #f2f2f2;
    }
    .table-wrapper .btn.btn-primary {
        color: #fff;
        background: #03A9F4;
    }
    .table-wrapper .btn.btn-primary:hover {
        background: #03a3e7;
    }
    .table-title .btn {
        font-size: 13px;
        border: none;
    }
    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }
    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }
    .table-title {
        color: #fff;
        background: #4b5366;
        padding: 16px 25px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }
    table.table tr th:first-child {
        width: 60px;
    }
    table.table tr th:last-child {
        width: 80px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }
    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }
    table.table td a:hover {
        color: #2196F3;
    }
    table.table td a.view {
        width: 30px;
        height: 30px;
        color: #2196F3;
        border: 2px solid;
        border-radius: 30px;
        text-align: center;
    }
    table.table td a.view i {
        font-size: 22px;
        margin: 2px 0 0 1px;
    }
    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }
    table {
        counter-reset: section;
    }

    .count:before {
        counter-increment: section;
        content: counter(section);
    }


</style>

</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_nav.php';?>
    <?php
    if($loggedin){
    ?>

    <div class="container">
        <div class="table-wrapper" id="empty">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Booking <b>Details</b></h2>
                    </div>
                    <div class="col-sm-8">
                        <a href="" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Booking Id</th>
                        <th>Address</th>
                        <th>Phone No</th>
                        <th>Amount</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM `bookings` WHERE `userId`= $userId";
                        $result = mysqli_query($conn, $sql);
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $bookingId = $row['bookingId'];
                            $address = $row['address'];
                            $phoneNo = $row['phoneNo'];
                            $amount = $row['amount'];
                            $bookingDate = $row['bookingDate'];
                            $bookingStatus = $row['bookingStatus'];

                            $counter++;

                            echo '<tr>
                                    <td>' . $bookingId . '</td>
                                    <td>' . substr($address, 0, 20) . '...</td>
                                    <td>' . $phoneNo . '</td>
                                    <td>' . $amount . '</td>
                                    <td>' . $bookingDate . '</td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingStatus' . $bookingId . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingItem' . $bookingId . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>

                                </tr>';
                        }

                        if($counter==0) {
                            ?><script> document.getElementById("empty").innerHTML = '<div class="col-md-12 my-5"><div class="card"><div id="no-booking" class="card-body cart"><div  class="opacity-dec col-sm-12 empty-cart-cls text-center"><h3><strong>You have not booked any items.</strong></h3><h4>Please make a booking to make us happy :)</h4> <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Explore New Restaurants!</a> </div></div></div></div>';</script> <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    }
    else {
        echo '<div class="container" style="min-height : 610px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Check your Booking. You need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
        </div></div>';
    }
    ?>

    <?php
    include 'partials/_bookingItemModal.php';
    include 'partials/_bookingStatusModal.php';
    require 'partials/_footer.php';?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
  </body>
</html>
