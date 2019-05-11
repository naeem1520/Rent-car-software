
<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
global $sms;


@$name=$_POST["name"];
@$email=$_POST['email'];
@$password=$_REQUEST["password"];
@$admin_type=$_POST["type"];

if(isset($_POST["save"]))
{
	if(!empty($name)&& !empty($email) && !empty($password )&& !empty($admin_type))
	{
	
		$q="SELECT * FROM regestration where email='$email'";
		$r_q=$db->select($q);
		if(!$r_q)
		{
			$insert="INSERT INTO `rent_management`.`regestration`
            (
             `name`,
             `email`,
             `password`,
             `type`)
VALUES (
        '$name',
        '$email',
        '$password',
        '$admin_type')";
              $r_insert=$db->insert($insert);

			if($r_insert)
			{	
				 $sms="<span class='text-center text-success'>  User Add Successfully!! </p></span>";
			}
			else
			{
				 $sms="<span class='text-center text-warning'> Sorry User Add UnSuccessfully!!</span>";
			}
		}
		else
		{
	 		 echo"<script>alert('Please Check Your Email This Email Already Exist')</script>";
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
	<title>Add new user</title>
	<link rel="stylesheet" type="text/css" href="../public/css/user.css">
</head>
<body>
	<div class="Registration">
		<h1>Registration</h1>
		<div class="formpage">
			<form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
			
				
				<label class="frmlabl">Name: </label>
					<input  class="frmledi"  type="text"  name="name" required>
				  <label class="frmlabl">Email: </label>
					<input  class="frmledi"  type="email"  name="email" required>
			  <label class="frmlabl">Password:</label>
					<input  class="frmledi"  type="password" name="password" required>
			<label class="frmlabl">Type:</label>
					<select class="selecttype" name="type">
						<option>select one</option>
						<option value="general_manager">General Manager</option>
						<option value="manager">Manager</option>
					</select>
				
					<td class="danger" colspan="3" align="center"><span><?php print $sms; ?></span>
				
				
					<input type="submit"  name="save" required>
			
		</form>
		

		
	</div>

</body>
</html>