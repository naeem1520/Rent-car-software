<?php
require_once("db_connect/config.php");
require_once("db_connect/connection.php");
$db=new database();

@session_start();
unset($_SESSION["condition"]);
unset($_SESSION["adminname"]);
unset($_SESSION["role"]);
// $select_admin_information="select * from create_user where email='".@$_POST["email"]."' and password='".@$_POST["password"]."'";

$select_admin_information="select * from regestration where email='".@$_POST["email"]."' and password='".@$_POST["password"]."'";
$r=$db->select($select_admin_information);
if($r)
{
@$fetch_adminInfo=$r->fetch_array();
}



if(isset($_POST["Login"]))
{
        if(@$fetch_adminInfo[2]==$_POST["email"] && @$fetch_adminInfo[3]==$_POST["password"])
		{
		$_SESSION["condition"]=true;
		$_SESSION["adminname"]=$fetch_adminInfo[1];
		$_SESSION["adminid"]=$fetch_adminInfo[0];
		$_SESSION["role"]=$fetch_adminInfo[4];
		
		    print "<script>location='Admin/dashboard.php'</script>";
		}
		else
		{
		  $sms="Invalid User";
		}
}




?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="holediv">

	<div class="login">
		
			<h1>Rent-A-Car Management Syatem<br>
			For<br>
			P.S ENTERPRISE<br>
		</h1>
<div class="formpage">
		<form  action="<?php print $_SERVER['PHP_SELF'];  ?>" autocomplete="on" method="post">
			<strong>
			 Username:
			 <input type="text" name="email" placeholder="Your Name" class="from-control" required></br></br>
			Password: 
			<input type="Password" required name="password" placeholder="Your Password" class="from-control"></br></br> 
			</strong>
			<input name="Login" type="submit" class="login-button" id="Login" value="Login"><br><br>
		
			</div>
		</form>
		
		</div>

	</div>


</div>

</body>
</html>