hotel<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createHotel'])) {
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $price = $_POST["price"];

        $sql = "insert into `hotels` (`hotelName`, `hotelDesc`, `hotelPrice`) VALUES ('$name', '$desc', '$price')";
        $result = mysqli_query($conn, $sql);
        $hotelId = $conn->insert_id;
        if($result) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {

                $newfilename = "hotel-".$hotelId.".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/project_rbs/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('success');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('failed to upload image');
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>alert("Please select an image file to upload.");
                    </script>';
            }
        }
    }
    if(isset($_POST['removeHotel'])) {
        $hotelId = $_POST["hotelId"];
        $filename = $_SERVER['DOCUMENT_ROOT']."/project_rbs/img/card-".$hotelId.".jpg";
        $sql = "DELETE FROM `hotels` WHERE `hotelId`='$hotelId'";
        $result = mysqli_query($conn, $sql);
        if ($result){
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>alert('Removed');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateHotel'])) {
        $hotelId = $_POST["hotelId"];
        $hotelName = $_POST["name"];
        $hotelDesc = $_POST["desc"];
        $hotelPrice = $_POST["price"];

        $sql = "UPDATE `hotels` SET `hotelName`='$hotelName', `hotelDesc`='$hotelDesc', `hotelPrice`='$hotelPrice' WHERE `hotelId`='$hotelId'";
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('update');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateHotelPhoto'])) {
        $hotelId = $_POST["hotelId"];
        $check = getimagesize($_FILES["hotelimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'card-'.$hotelId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/project_rbs/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['hotelimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('failed');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
?>
