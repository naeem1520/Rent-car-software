<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
include 'Core.php';
$key = generateCode();
global $sms;
global $fetch;
global $table;


@$name=$_POST["name"];
@$owner_name=$_POST["owner_name"];
@$phone=$_POST["phone"];
@$model_number=$_POST["model_number"];
@$registration_number=$_POST["registration_number"];
@$owner_address=$_POST["owner_address"];
@$car_color =$_POST["car_color"];
@$price =$_POST["price"];


if(isset($_POST["add"]))
{

$upload_dir = "uploads/";
$target_file = $upload_dir . basename($_FILES["file"]["name"]);
 move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);


  if(!empty($name)&& !empty($owner_name) && !empty($phone )&& !empty($model_number)
&& !empty($registration_number)&& !empty($owner_address)&& !empty($car_color )&& !empty($price ))
  {
  
    $q="SELECT * FROM car_information where registration_number='$registration_number'";
    $r_q=$db->select($q);
    if(!$r_q)
    {
      $insert="INSERT INTO `car_information`( `name`, `owner_name`, `phone`, `model_number`, `registration_number`, `owner_address`, `car_color`,`price`, `image_link`,`car_track_no`) VALUES ('$name','$owner_name','$phone','$model_number','$registration_number','$owner_address','$car_color','$price','$target_file','$key')";

      $r_insert=$db->insert($insert);

      if($r_insert)
      { 
         $sms="<span class='text-center text-success'> Car Information Add Successfully!! </p></span>";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Car Information  Add UnSuccessfully!!</span>";
      }
    }
    else
    {
       echo"<script>alert('Please Check Your registration_number This registration_number Already Exist')</script>";
    }
  }
  else
  {
    $sms="<span class='text-center text-danger glyphicon glyphicon-exclamation-sign'> Fill Out all fields</span>";
  
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
  <h2>Add Car Information</h2>
  <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
        
  <table>
        
        <tr>
          <td> Car Name</td>
          <td>: </td>
          <td><input type="text"  name="name" required></td>
        </tr><tr>
          <td>Car Owner Name</td>
          <td>: </td>
          <td><input type="text"  name="owner_name" required></td>
        </tr><tr>
          <td>Car Owner phone</td>
          <td>: </td>
          <td><input type="text" name="phone" required></td>
        </tr><tr>
          <td>Car Modle Number</td>
          <td>: </td>
          <td><input type="text" name="model_number" required></td>
        </tr><tr>
          <td>Car Registration Number</td>
          <td>: </td>
          <td><input type="text" name="registration_number" required></td>
        </tr><tr>
          <td>Car Owner Address</td>
          <td>: </td>
          <td><input class="addre-filed" type="text" name="owner_address" required></td>
        </tr><tr>
          <td>Car Color </td>
          <td>: </td>
          <td><input type="text" name="car_color" required></td>
        </tr>

        <tr>
        <td>Rent price</td>
        <td>: </td>
        <td> <input type="text" name="price" required></td>
        </tr>
      
        <tr>
        <td>Car Picture </td>
        <td>: </td>
        <td> <input type="file" name="file"></td>
        </tr>
      <tr>
          <td class="danger" colspan="3" align="center"><span><?php print $sms; ?></span></td>
     </tr>
      

    </table>
        <input type="submit" name="add" value="ADD">
  </form>
</div>

