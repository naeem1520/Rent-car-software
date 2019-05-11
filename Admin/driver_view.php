<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
@session_start();
global $sms;

if (isset($_GET['delete'])) {

    $id=$_GET['delete'];

    $get_driver_info="DELETE FROM driver_information where id='$id'";
    $driver_data=$db->delete($get_driver_info);

    if ($driver_data) {

       	header('location: driver_view.php');

                    $_SESSION['deletemessage'] = "Driver info delete!";
    }else
		{
					$_SESSION['deletemessage'] = "Driver info Not delete!";
		}

}


?>


<!DOCTYPE html>
<html>
<head>
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}
tr:nth-child(even) i {
    color: #fff;
}
button {
    margin-top: 20px;
    background: #028182;
    color: #fff;
    padding: 9px 31px;
    font-size: 20px;
}
	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 5px;
		 font-family: cambria;
	}
tr:nth-child(even) i {
    color: #fff;
}
	tr:nth-child(even) {
		    background-color: #028182;
    color: #fff;
	}
	.btn {
		border: none; /* Remove borders */
		color: white; /* Add a text color */
		padding: 14px 28px; /* Add some padding */
		cursor: pointer; /* Add a pointer cursor on mouse-over */
	}

	.success {background-color: #4CAF50;} /* Green */
	.success:hover {background-color: #46a049;}

	.info {background-color: #2196F3;} /* Blue */
	.info:hover {background: #0b7dda;}

	.warning {background-color: #ff9800;} /* Orange */
	.warning:hover {background: #e68a00;}

	.danger {background-color: #f44336;} /* Red */ 
	.danger:hover {background: #da190b;}

	.default {background-color: #e7e7e7; color: black;} /* Gray */ 
	.default:hover {background: #ddd;
	
	}
	.msg{
		color: green;
		background: white;
		font-size: 16px;
	}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
	
	function confirm_delete()
	{
	
		confirm_delete=confirm('Are You Confirm to Delete the Data?');
		if(confirm_delete==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
</head>
<body>

	<h2 style="text-align: center;">All Driver Information</h2>
			<?php if (isset($_SESSION['message'])): ?>
				<div class="msg">
					<?php 
					echo $_SESSION['message']; 
					unset($_SESSION['message']);
					?>
				</div>
			<?php endif ?>

			<?php if (isset($_SESSION['deletemessage'])): ?>
				<div class="msg">
					<?php 
					echo $_SESSION['deletemessage']; 
					unset($_SESSION['deletemessage']);
					
					?>
				</div>
			<?php endif ?>
	<table>
		<tr>
			<th>S.I</th>
			<th>Name</th>
			<th>Phone</th>
			<th>Nid</th>
			<th>L.Num</th>
			<th>Blood Group</th>
			<th>Driver Address</th>
			<th>Permanent Address</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
		<?php
		$driver_data="select * from driver_information";
		$driver_data_row=$db->select($driver_data);
		if($driver_data_row)
		{
			$sl=0;
			while($fetch=$driver_data_row->fetch_array())
			{
				$sl++;
				?>
				<tr>
					<td><?php echo $sl; ?></td>
					<td><?php echo $fetch['name']; ?></td>
					<td><?php echo $fetch[2]; ?></td>
					<td><?php echo $fetch[3]; ?></td>
					<td><?php echo $fetch[4]; ?></td>
					<td><?php echo $fetch[5]; ?></td>
					<td><?php echo $fetch[6]; ?></td>
					<td><?php echo $fetch[7]; ?></td>
					
					<td>
						
						<img src="<?php echo $fetch['image_link']; ?>" alt="" style="    WIDTH: 100PX;HEIGHT: 100PX; border-radius: 50%">
					</td>
					<td>
					<a href="driver_edit.php?edit=<?php echo $fetch[0]; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
					<a href="driver_edit.php?edit=<?php echo $fetch[0]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a href="<?php print $_SERVER['PHP_SELF'];?>?delete=<?php echo $fetch[0]; ?>" onclick='return confirm_delete()'><i class="fa fa-trash" aria-hidden="true"></i></a></td>
				</tr>
				<?php
			}
		}
		?>
		

	</table>
<center>
<button onclick="myFunction()">Print</button>

<script>
function myFunction() {
  window.print();
}
</script>
</center>
</body>
</html>