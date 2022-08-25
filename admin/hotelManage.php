<div class="container-fluid" style="margin-top:98px">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <!-- <div class="col-md-4">
                <form action="partials/_hotelManage.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(111 202 203);">
                            Create New Hotel
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Hotel Name: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hotel Desc: </label>
                                <input type="text" class="form-control" name="desc" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hotel Price: </label>
                                <input type="text" class="form-control" name="price" required>
                            </div>
                            <div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							</div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="createHotel" class="btn btn-sm btn-primary col-sm-3 offset-md-4"> Create </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> -->
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-bordered table-hover mb-0">
                        <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th class="text-center" style="width:7%;">Id</th>
                            <th class="text-center">Img</th>
                            <th class="text-center" style="width:58%;">Hotel Detail</th>
                            <th class="text-center" style="width:18%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT * FROM `hotels`";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $hotelId = $row['hotelId'];
                                $hotelName = $row['hotelName'];
                                $hotelDesc = $row['hotelDesc'];
                                $hotelPrice = $row['hotelPrice'];

                                echo '<tr>
                                        <td class="text-center"><b>' .$hotelId. '</b></td>
                                        <td><img src="/project_rbs/img/hotel-'.$hotelId. '.jpg" alt="image for this Hotel" width="150px" height="150px"></td>
                                        <td>
                                            <p>Name : <b>' .$hotelName. '</b></p>
                                            <p>Description : <b class="truncate">' .$hotelDesc. '</b></p>
                                            <p>Price : <b>Rs. ' .$hotelPrice. '</b></p>
                                        </td>
                                        <td class="text-center">  
                                            <button class="btn btn-sm btn-primary edit_cat" type="button" data-toggle="modal" data-target="#updateHotel' .$hotelId. '">Edit</button>

                                        </td>
                                    </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>


<?php
    $hotelsql = "SELECT * FROM `hotels`";
    $hotelResult = mysqli_query($conn, $hotelsql);
    while($hotelRow = mysqli_fetch_assoc($hotelResult)){
        $hotelId = $hotelRow['hotelId'];
        $hotelName = $hotelRow['hotelName'];
        $hotelDesc = $hotelRow['hotelDesc'];
?>

<!-- Modal -->
<div class="modal fade" id="updateHotel<?php echo $hotelId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateHotel<?php echo $hotelId; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="updateHotel<?php echo $hotelId; ?>">Hotel Id: <b><?php echo $hotelId; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_hotelManage.php" method="post" enctype="multipart/form-data">
		    <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
		   		<div class="form-group col-md-8">
					<b><label for="image">Image</label></b>
					<input type="file" name="hotelimage" id="hotelimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
					<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
					<input type="hidden" id="hotelId" name="hotelId" value="<?php echo $hotelId; ?>">
					<button type="submit" class="btn btn-success my-1" name="updateHotelPhoto">Update Img</button>
				</div>
				<div class="form-group col-md-4">
					<img src="/project_rbs/img/card-<?php echo $hotelId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="Hotel image" width="100" height="100">
				</div>
			</div>
		</form>
        <form action="partials/_hotelManage.php" method="post">
            <div class="text-left my-2">
                <b><label for="name">Name</label></b>
                <input class="form-control" id="name" name="name" value="<?php echo $hotelName; ?>" type="text" required>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Description</label></b>
                <textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php echo $hotelDesc; ?></textarea>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Price</label></b>
                <textarea class="form-control" id="price" name="price"><?php echo $hotelPrice; ?></textarea>
            </div>
            <input type="hidden" id="hotelId" name="hotelId" value="<?php echo $hotelId; ?>">
            <button type="submit" class="btn btn-success" name="updateHotel">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>
