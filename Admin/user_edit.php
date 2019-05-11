<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
@session_start();
global $sms;
global $fetch;

if (isset($_GET['edit'])) {

    $id=$_GET['edit'];

    $get_user="SELECT * FROM regestration where id='$id'";
    $user_data=$db->select($get_user);

    if (count($user_data)>0) {

        $fetch=$user_data->fetch_array();
    }

}


if(isset($_POST["update"]))

{


@$id=$_POST["id"];
@$name=$_POST["name"];
@$email=$_POST["email"];
@$password=$_POST["password"];
@$type=$_POST["type"];



  if(!empty($name)&& !empty($email) && !empty($password )&& !empty($type))
  {
  $update="UPDATE `rent_management`.`regestration`
SET 
  `name` = '$name',
  `email` = '$email',
  `password` = '$password',
  `type` = '$type'
WHERE `id` = '$id';";


      $r_update=$db->update($update);

      if($r_update)
      { 
         
         header('location: user_view.php');

         $_SESSION['message'] = "User  updated!";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Sorry User update UnSuccessfully!!</span>";
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
  <link rel="stylesheet" type="text/css" href="../public/css/user.css">
  
</head>
<body>
  <div class="Registration">
    <h1>Registration</h1>
    <div class="formpage">
      <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
      
        
   
          <label class="frmlabl">Name: </label>
          
            <input type="text"  name="name" value="<?php echo $fetch['name'] ?>"require>
        <input  class="frmledi" type="hidden" name="id" value="<?php echo $fetch['id']; ?>"><br>
        <label class="frmlabl">Email: </label>
         <input  class="frmledi" type="text" name="email" value="<?php echo $fetch['email'] ?>" required><br>
       <label class="frmlabl">Password:</label>
          <input  class="frmledi" type="text" name="password" value="<?php echo $fetch['password'] ?>" required><br>
        
          <label class="frmlabl">Type:</label>
        
		  
		  <select class="selecttype" name="type">
						<option>select one</option>
						<option value="general_manager">General Manager</option>
						<option value="manager">Manager</option>
					</select>
		  
		  
		  
		  <br>
       
    
  
      

  
       <input type="submit" name="update" value="Update">
	         <h3 class="danger" colspan="3" align="center"><span><?php print $sms; ?></span></h3>
  </form>
</div>