<?php
if(isset($_POST['save'])){
session_start();
date_default_timezone_set("Asia/Bangkok"); 
$date=date('l jS \of F Y h:i:s A');
include("connect.php");
$date = $_POST['date'];
$name = $_POST['aname'];
$start = $_POST['timestart'];
$end = $_POST['timeend'];
$price = $_POST['price'];
$place = $_POST['place'];
$capacity = $_POST['capacity'];
$detail = $_POST['detail'];
/*----------upload image---------*/
        $product_image = $_FILES['image']['name'];
        $target_dir = "../../img/confirmation-images/";
        $target_file = $target_dir . basename($product_image);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check file size
        if ($_FILES["image"]["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
         //if everything is ok, try to upload file
        }
/*--------------------------------*/
if ($name=="") {
    header("location:../academy_management_detail.php?academy=$id & academy=$id & errors=Academy Name Must Be Filled");
  }
else if (!preg_match("/^[a-zA-Z\s]*$/",$name)) {
      header("location:../academy_management_detail.php?academy=$id & errors=Academy Name Can be only contain letters");
    }
else if (strlen($name) > 30) {
    header("location:../academy_management_detail.php?academy=$id & errors=Academy name cannot exceed than 30 characters.");
  }
else if ($place=="") {
      header("location:../academy_management_detail.php?academy=$id & errors=Place Must be Filled");
    }
else if (!preg_match("/^[a-zA-Z\s]*$/",$place)) {
      header("location:../academy_management_detail.php?academy=$id & errors=Place Can be only contain letters");
    }
else if (strlen($detail) > 150) {
    header("location:../academy_management_detail.php?academy=$id & errors=Detail cannot exceed than 150 characters.");
  }
else if (!preg_match("/^[0-9]*$/",$price)) {
      header("location:../academy_management_detail.php?academy=$id & errors=Price can only contain numbers.");
    }
else if (!preg_match("/^[0-9]*$/",$capacity)) {
      header("location:../academy_management_detail.php?academy=$id & errors=Capacity can only contain numbers.");
    }
else
{
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $get_update = "insert into academy values('','academy','$name','$capacity','$product_image','$detail','$price','$capacity','$date','$start','$end')";
    $query = mysqli_query($connection,$get_update);
    
    header("location:../academy_management_addnew.php?success= '$name' academy has been successfully created.");
}
}
?>