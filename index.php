<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Home</title>
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">
    <style media="screen">
    .carousel-control-next, .carousel-control-prev /*, .carousel-indicators */ {
      filter: invert(100%);
    }
    </style>
  </head>
<body>
  <?php include 'partials/_dbconnect.php';?>
  <?php require 'partials/_nav.php' ?>

  <!-- Hotel container starts here -->
  <div class="container my-3 mb-5">
    <div class="col-lg-6 text-center bg-light my-3" style="margin:auto;border-top: 2px groove black;border-bottom: 2px groove black;">
      <h2 class="text-center">Welcome to Transylvania! </h2>
    </div>
    <div class="row" style="margin-top: 3rem;">
      <!-- Fetch all the hotels and use a loop to iterate through hotels -->
      <?php
        $hotelId = 1;
        $sql = "select * FROM `hotels` where `hotelId` = $hotelId";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row['hotelId'];
        $hotel = $row['hotelName'];
        $desc = $row['hotelDesc'];
        echo '<div class="col-xs-3 col-sm-3 col-md-6" style="margin:0 18rem;">
                <div class="card" style="width: 32rem; height:35rem;margin:auto ;">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="img/carousel-1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="img/carousel-2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="img/carousel-3.jpg" class="d-block w-100" alt="...">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>                  <div class="card-body">
                    <h5 class="card-title" style="margin:1rem auto;">' . $hotel . '</h5>
                    <p class="card-text">' . $desc. ' </p>
                    <div class="row justify-content-center">
                      <a href="calendar.php" class="btn btn-primary">Available Slots</a>
                    </div>
                  </div>
                </div>
              </div>';

      ?>
    </div>
  </div>


    <?php require 'partials/_footer.php' ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>
