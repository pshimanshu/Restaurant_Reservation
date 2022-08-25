<?php
    $itemModalSql = "SELECT * FROM `bookings` WHERE `userId`= $userId";
    $itemModalResult = mysqli_query($conn, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $bookingid = $itemModalRow['bookingId'];

?>

<!-- Modal -->
<div class="modal fade" id="bookingItem<?php echo $bookingid; ?>" tabindex="-1" role="dialog" aria-labelledby="bookingItem<?php echo $bookingid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingItem<?php echo $bookingid; ?>">Booking Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">
                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table text">
                            <thead>
                                <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="px-3">Item</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="text-center">Quantity</div>
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $mysql = "SELECT * FROM `bookingitems` WHERE bookingId = $bookingid";
                                    $myresult = mysqli_query($conn, $mysql);
                                    while($myrow = mysqli_fetch_assoc($myresult)){
                                        $itemId = $myrow['itemId'];
                                        $itemQuantity = $myrow['itemQuantity'];

                                        $itemsql = "SELECT * FROM `items` WHERE `itemId` = $itemId";
                                        $itemresult = mysqli_query($conn, $itemsql);
                                        $itemrow = mysqli_fetch_assoc($itemresult);
                                        $itemName = $itemrow['itemName'];
                                        $itemPrice = $itemrow['itemPrice'];
                                        $itemDesc = $itemrow['itemDesc'];

                                        echo '<tr>
                                                <th scope="row">
                                                    <div class="p-2">
                                                    <img src="img/item-'.$itemId. '.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">'.$itemName. '</a></h5><span class="text-muted font-weight-normal font-italic d-block">Rs. ' .$itemPrice. '/-</span>
                                                    </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle text-center"><strong>' .$itemQuantity. '</strong></td>
                                            </tr>';
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    }
?>
