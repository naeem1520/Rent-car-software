<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
global $sms;
global $fetch;
global $table;


@$name=$_POST["name"];
@$phone_number=$_POST["phone_number"];
@$nid=$_POST["nid"];
@$license_number=$_POST["license_number"];
@$blood_group=$_POST["blood_group"];
@$address=$_POST["address"];
@$permanent_address =$_POST["permanent_address"];



if(isset($_POST["add"]))
{

  $upload_dir = "uploads/";
  $target_file = $upload_dir . basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);


  if(!empty($name)&& !empty($phone_number) && !empty($nid )&& !empty($license_number)
&& !empty($blood_group)&& !empty($address)&& !empty($permanent_address ))
  {
  
    $q="SELECT * FROM driver_information where nid='$nid'";
    $r_q=$db->select($q);
    if(!$r_q)
    {
      $insert="INSERT INTO `driver_information`(`name`, `phone_number`, `nid`, `license_number`, `blood_group`, `address`, `permanent_address`,`image_link`) VALUES ('$name','$phone_number','$nid','$license_number','$blood_group','$address','$permanent_address','$target_file')";

      $r_insert=$db->insert($insert);

      if($r_insert)
      { 
         $sms="<span class='text-center text-success'> Driver Information Add Successfully!! </p></span>";
      }
      else
      {
         $sms="<span class='text-center text-warning'>  Driver Information Add UnSuccessfully!!</span>";
      }
    }
    else
    {
       echo"<script>alert('Please Check Your Nid This Nid Already Exist')</script>";
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
  <h2>Add Driver Information</h2>
  <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
        
    <table>

      <tr>
        <td> Driver Name</td>
        <td>: </td>
        <td><input type="text"  name="name" required></td>
      </tr><tr>
        <td>Driver Phone Number</td>
        <td>: </td>
        <td><input type="text" name="phone_number" required></td>
      </tr><tr>
        <td>Driver NID</td>
        <td>: </td>
        <td><input type="text" name="nid" required></td>
      </tr><tr>
        <td>Driver License Number</td>
        <td>: </td>
        <td><input type="text" name="license_number" required></td>
      </tr><tr>
        <td>Driver Blood Group</td>
        <td>: </td>
        <td><input type="text" name="blood_group" required></td>
      </tr><tr>
        <td>Driver Address</td>
        <td>: </td>
        <td><input class="addre-filed" type="text" name="address" required></td>
      </tr><tr>
        <td>Driver permanent Address </td>
        <td>: </td>
        <td><input class="addre-filed" type="text" name="permanent_address" required></td>
      </tr>
      <tr>
        <td>Driver Picture </td>
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


