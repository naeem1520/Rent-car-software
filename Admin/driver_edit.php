<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
@session_start();

global $sms;
global $fetch;

if (isset($_GET['edit'])) {

    $id=$_GET['edit'];

    $get_driver_info="SELECT * FROM driver_information where id='$id'";
    $driver_data=$db->select($get_driver_info);

   

        $fetch=$driver_data->fetch_array();
    

}


if(isset($_POST["update"]))
{

  @$id=$_POST["id"];
  @$name=$_POST["name"];
  @$phone_number=$_POST["phone_number"];
  @$nid=$_POST["nid"];
  @$license_number=$_POST["license_number"];
  @$blood_group=$_POST["blood_group"];
  @$address=$_POST["address"];
  @$permanent_address =$_POST["permanent_address"];
  
  // @$file=$_POST["file"];

// File upload path
  $upload_dir = "uploads/";
  $target_file = $upload_dir . basename($_FILES["file"]["name"]);
  // unlink('$target_file');
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

  if(!empty($name)&& !empty($phone_number) && !empty($nid )&& !empty($license_number)
&& !empty($blood_group)&& !empty($address)&& !empty($permanent_address ))
  {
    
    $update="UPDATE `rent_management`.`driver_information`
    SET `id` = '$id',
    `name` = '$name',
    `phone_number` = '$phone_number',
    `nid` = '$nid',
    `license_number` = '$license_number',
    `blood_group` = '$blood_group',
    `address` = '$address',
    `permanent_address` = '$permanent_address',
    `image_link` = '$target_file'
    WHERE `id` = '$id';";

      $r_update=$db->update($update);

      if($r_update)
      { 
         
         header('location: driver_view.php');

         $_SESSION['message'] = "Driver info updated!";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Sorry Driver Info update UnSuccessfully!!</span>";
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
  <h2>Update Driver Information</h2>
  <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
        
    <table>

      <tr>
        <td> Driver Name</td>
        <td>: </td>
        <td><input type="text"  name="name" value="<?php echo $fetch['name'] ?>" required>
        <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
        </td>
      </tr><tr>
        <td>Driver Phone Number</td>
        <td>: </td>
        <td><input type="text" name="phone_number" value="<?php echo $fetch['phone_number'] ?>" required></td>
      </tr><tr>
        <td>Driver NID</td>
        <td>: </td>
        <td><input type="text" name="nid"   value="<?php echo $fetch['nid'] ?>" required></td>
      </tr><tr>
        <td>Driver License Number</td>
        <td>: </td>
        <td><input type="text" name="license_number"  value="<?php echo $fetch['license_number'] ?>" required></td>
      </tr><tr>
        <td>Driver Blood Group</td>
        <td>: </td>
        <td><input type="text" name="blood_group"  value="<?php echo $fetch['blood_group'] ?>" required></td>
      </tr><tr>
        <td>Driver Address</td>
        <td>: </td>
        <td><input type="text" name="address"  value="<?php echo $fetch['address'] ?>" required></td>
      </tr><tr>
        <td>Driver permanent Address </td>
        <td>: </td>
        <td><input type="text" name="permanent_address"  value="<?php echo $fetch['permanent_address'] ?>" required></td>
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
        <input type="submit" name="update" value="Update">
  </form>
</div>


