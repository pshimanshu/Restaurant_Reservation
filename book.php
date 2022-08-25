<?php
include 'partials/_dbconnect.php';?>
<?php require 'partials/_nav.php' ?>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'rbs');
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * from slots where date = ?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['timeslot'];
            }
            $stmt->close();
        }
    }
}



//
// if(isset($_POST['submit'])){
//     $timeslot = $_POST['timeslot'];
//     $stmt = $mysqli->prepare("select * from slots where date = ? AND timeslot=?");
//     $stmt->bind_param('ss', $date, $timeslot);
//     if($stmt->execute()){
//         $result = $stmt->get_result();
//         if($result->num_rows>0){
//             header("location: /project_rbs/viewItemList.php?slotsuccess=false");
//         }else{
//             $stmt = $mysqli->prepare("insert into slots (userId, timeslot, date) values (?,?,?)");
//             $stmt->bind_param('ssss', $userid, $timeslot, $date);
//             $stmt->execute();
//             header("location: /project_rbs/viewItemList.php?slotsuccess=true");
//             $bookings[] = $timeslot;
//             $stmt->close();
//             $mysqli->close();
//         }
//     }
// }

$duration = 60;
$cleanup = 30;
$start = "08:00";
$end = "20:00";

function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }

        $slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");

    }

    return $slots;
}

?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Slot Booking</title>
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>

  <body>
    <div style="margin-top: 1.5rem;" class="container">
        <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
        <div class="row">
          <div class="col-md-12">
            <?php echo(isset($msg))?$msg:""; ?>
          </div>
          <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
            foreach($timeslots as $ts){
          ?>
          <div class="col-md-2">
            <div class="form-group">
              <?php if(in_array($ts, $bookings)){ ?>
               <button type="button" class="btn btn-secondary text-nowrap"><?php echo $ts; ?></button>
               <?php }else{ ?>
               <button type="button" class="btn btn-success book text-nowrap" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
               <?php }
              ?>
            </div>
          </div>
          <?php } ?>
        </div>
    </div>


            <!-- Modal content-->
            <div class="modal" id="myModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Booking Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="partials/_manageSlot.php" method="post">
                              <input type="hidden" name="date" id="date" value="<?php echo $date; ?>">
                               <div class="form-group">
                                    <label for="">Time Slot</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot">
                                </div>
                                <p>Please Confirm your Slot and proceed to next step for Food Selection. <b>Once submitted cannot change the slot.</b></p>

                                <div class="form-group pull-right">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

    <script>
    $(".book").click(function(){
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    });
  </script>
  </body>

</html>
