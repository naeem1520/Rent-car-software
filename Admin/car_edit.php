<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
@session_start();

global $sms;
global $fetch;

if (isset($_GET['edit'])) {

    $id=$_GET['edit'];

    $get_car_info="SELECT * FROM car_information where id='$id'";
    $car_data=$db->select($get_car_info);

    $fetch=$car_data->fetch_array();


}


if(isset($_POST["update"]))
{

@$id=$_POST["id"];
@$name=$_POST["name"];
@$owner_name=$_POST["owner_name"];
@$phone=$_POST["phone"];
@$model_number=$_POST["model_number"];
@$registration_number=$_POST["registration_number"];
@$owner_address=$_POST["owner_address"];
@$car_color =$_POST["car_color"];
@$price =$_POST["price"];
@$track =$_POST["track"];
/*@$file=$_POST["file"];*/
 // File upload path
  $upload_dir = "uploads/";
  $target_file = $upload_dir . basename($_FILES["file"]["name"]);
  // unlink('$target_file');
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);


  if(!empty($name)&& !empty($owner_name) && !empty($phone )&& !empty($model_number)
&& !empty($registration_number)&& !empty($owner_address)&& !empty($car_color )&& !empty($price ))
  {
                
          $update="UPDATE `rent_management`.`car_information`
          SET `id` = '$id',
            `name` = '$name',
            `owner_name` = '$owner_name',
            `phone` = '$phone',
            `model_number` = '$model_number',
            `registration_number` = '$registration_number',
            `owner_address` = '$owner_address',
            `car_color` = '$car_color',
            `price` = '$price',
            `image_link` = '$target_file',
            `car_track_no` = '$track'
          WHERE `id` = '$id';";


      $r_update=$db->update($update);

      if($r_update)
       { 
         
         header('location: car_view.php');

         $_SESSION['message'] = "Car info updated!";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Sorry Car Info update UnSuccessfully!!</span>";
      }
    }
    else
    {
       echo"<script>alert('Please Fill Your All Data fillup')</script>";
    }
  
}




?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../public/css/custom.css">
  
</head>
<body>



<div class="information">
  <h2>Update Car Information</h2>
  <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
        
  <table>
        
        <tr>
          <td> Car Name</td>
          <td>: </td>
           <td><input type="text"  name="name" value="<?php echo $fetch['name'] ?>"require>
        <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
        </td>
        </tr><tr>
          <td>Car Owner Name</td>
          <td>: </td>
          <td><input type="text" name="owner_name" value="<?php echo $fetch['owner_name'] ?>" required></td>
        </tr><tr>
          <td>Car Owner phone</td>
          <td>: </td>
         <td><input type="text" name="phone" value="<?php echo $fetch['phone'] ?>" required></td>
        </tr><tr>
          <td>Car Modle Number</td>
          <td>: </td>
          <td><input type="text" name="model_number" value="<?php echo $fetch['model_number'] ?>" required></td>
        </tr><tr>
          <td>Car Registration Number</td>
          <td>: </td>
          <td><input type="text" name="registration_number" value="<?php echo $fetch['registration_number'] ?>" required></td>
        </tr><tr>
          <td>Car Owner Address</td>
          <td>: </td>
          <td><input type="text" name="owner_address" value="<?php echo $fetch['owner_address'] ?>" required></td>
        </tr><tr>
          <td>Car Color </td>
          <td>: </td>
         <td><input type="text" name="car_color" value="<?php echo $fetch['car_color'] ?>" required></td>
        </tr>
         <tr>
        <td>Rent price</td>
        <td>: </td>
       <td><input type="text" name="price" value="<?php echo $fetch['price'] ?>" required></td> 
       <td><input type="hidden" name="track" value="<?php echo $fetch['car_track_no'] ?>" ></td>
        </tr>
        <tr>
        <td>Car Picture </td>
        <td>: </td>
        <td> <img width="100" height="100" src="<?php echo $fetch['image_link'] ?>"> <input type="file" name="file"></td>
        </tr>
      <tr>
          <td class="danger" colspan="3" align="center"><span><?php print $sms; ?></span></td>
     </tr>
      

    </table>
       <input type="submit" name="update" value="Update">
  </form>
</div>

