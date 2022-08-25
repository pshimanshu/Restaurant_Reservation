<?php
    $itemModalSql = "SELECT * FROM `bookings`";
    $itemModalResult = mysqli_query($conn, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $bookingId = $itemModalRow['bookingId'];
        $userId = $itemModalRow['userId'];
        $bookingStatus = $itemModalRow['bookingStatus'];

?>

<!-- Modal -->
<div class="modal fade" id="bookingStatus<?php echo $bookingId; ?>" tabindex="-1" role="dialog" aria-labelledby="bookingStatus<?php echo $bookingId; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="bookingStatus<?php echo $bookingId; ?>">Booking Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_bookingManage.php" method="post" style="border-bottom: 2px solid #dee2e6;">
            <div class="text-left my-2">
                <b><label for="name">Booking Status</label></b>
                <div class="row mx-2">
                <input class="form-control col-md-3" id="status" name="status" value="<?php echo $bookingStatus; ?>" type="number" min="0" max="4" required>
                <button type="button" class="btn btn-secondary ml-1" data-container="body" data-toggle="popover" title="User Types" data-placement="bottom" data-html="true" data-content="0=Booking Placed.<br> 1=Booking Confirmed.<br> 2=Event Completed.<br> 3=Booking Denied.<br> 4=Booking Cancelled.">
                    <i class="fas fa-info"></i>
                </button>
                </div>
            </div>
            <input type="hidden" id="bookingId" name="bookingId" value="<?php echo $bookingId; ?>">
            <button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
        </form>

      </div>
    </div>
  </div>
</div>

<?php
    }
?>

<style>
    .popover {
        top: -77px !important;
    }
</style>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
