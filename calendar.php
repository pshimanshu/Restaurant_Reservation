
<?php include 'partials/_dbconnect.php';?>
<?php require 'partials/_nav.php' ?>
<?php
function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'rbs');
    $stmt = $mysqli->prepare("select * from slots where MONTH(date) = ? AND YEAR(date)=?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
            }
            $stmt->close();
        }
    }
    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers

    $datetoday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-sm btn-primary' href='calendar.php?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";

    $calendar.= " <a href='calendar.php' class='btn btn-sm btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Current Month</a> ";

    $calendar.= "<a href='calendar.php?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."' class='btn btn-sm btn-primary'>Next Month</a></center><br>";

    $calendar .= "<tr>";

    // Create the calendar headers
    foreach($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }

    // Create the rest of the calendar
    // Initiate the day counter, starting with the 1st.
    $currentDay = 1;
    $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

    if($dayOfWeek > 0) {
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar .= "<td  class='empty'></td>";
        }
    }


    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {
         //Seventh column (Saturday) reached. Start a new row.
         if ($dayOfWeek == 7) {
             $dayOfWeek = 0;
             $calendar .= "</tr><tr>";
         }

         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         $date = "$year-$month-$currentDayRel";
         $dayname = strtolower(date('l', strtotime($date)));
         $eventNum = 0;
         $today = $date==date('Y-m-d')? "today" : "";
         if($date<date('Y-m-d')){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-sm'>N/A</button>";
         }else{
             $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-sm'>Book</a>";
         }
         $calendar .="</td>";
         //Increment counters
         $currentDay++;
         $dayOfWeek++;
     }

     //Complete the row of the last week in month, if necessary
     if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for($l=0;$l<$remainingDays;$l++){
            $calendar .= "<td class='empty'></td>";
        }
     }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Date Booking</title>
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">
    <style>
      @media only screen and (max-width: 760px),
      (min-device-width: 802px) and (max-device-width: 1020px) {

      /* Force table to not be like tables anymore */
      table, thead, tbody, th, td, tr {
        display: block;

      }

      .empty {
        display: none;
      }

      /* Hide table headers (but not display: none;, for accessibility) */
      th {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        border: 1px solid #ccc;
      }

      td {
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
      }



      /*
      Label the data
      */
      td:nth-of-type(1):before {
        content: "Sunday";
      }
      td:nth-of-type(2):before {
        content: "Monday";
      }
      td:nth-of-type(3):before {
        content: "Tuesday";
      }
      td:nth-of-type(4):before {
        content: "Wednesday";
      }
      td:nth-of-type(5):before {
        content: "Thursday";
      }
      td:nth-of-type(6):before {
        content: "Friday";
      }
      td:nth-of-type(7):before {
        content: "Saturday";
      }


      }

      /* Smartphones (portrait and landscape) ----------- */

      @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
      body {
        padding: 0;
        margin: 0;
      }
      }

      /* iPads (portrait and landscape) ----------- */

      @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
      body {
        width: 495px;
      }
      }

      @media (min-width:641px) {
      table {
        table-layout: fixed;
      }
      td {
        width: 33%;
      }
      }

      .row{
      margin-top: 20px;
      }

      .today{
      background:yellow;
    }
  </style>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  </head>
  <body>
    <?php
    if($loggedin){
    ?>
   <div class="container">
    <div class="row">
     <div class="col-md-12">
      <div id="calendar">
       <?php
        $dateComponents = getdate();
        if(isset($_GET['month']) && isset($_GET['year'])){
          $month = $_GET['month'];
          $year = $_GET['year'];
        }
        else{
          $month = $dateComponents['mon'];
          $year = $dateComponents['year'];

        }
        echo build_Calendar($month,$year);
       ?>
      </div>
     </div>
    </div>
   </div>
   <?php
   }
   else {
       echo '<div class="container" style="min-height : 610px;">
       <div class="alert alert-info my-3">
           <font style="font-size:22px"><center>Check Available Slots. You need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
       </div></div>';
   }
   ?>

       <?php require 'partials/_footer.php' ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>
