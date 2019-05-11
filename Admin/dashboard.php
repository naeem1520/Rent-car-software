<?php
@session_start();
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();

if ($_SESSION["condition"]=true) {
  # code...

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="dashboard.css">

</head>
<body>
<div class="sidenav">
<h1>Rent-A-Car</h1> <h3> Management Syatem </h3>
<hr>


<nav class="navigation">
  <ul class="mainmenu">
    <li>  <a href="dashboard.php">Dashboard</a></li>
    <li> <a class="dropdown-btn">Driver Information <i class="fa fa-caret-down"></i> </a>
	<ul class="submenu">
        <li><a href="driverinfo.php" target="adminifarme">Add New Driver</a></li>
        <li><a href="driver_view.php" target="adminifarme">View All Driver Information</a></li>
      </ul>
	</li>
	
	
	    <li> <a class="dropdown-btn">Car Information <i class="fa fa-caret-down"></i> </a>
	<ul class="submenu">
        <li> <a href="carinfo.php" target="adminifarme">Add New Car</a></li>
        <li><a href="car_view.php" target="adminifarme">View All Car Information</a></li>
      </ul>
	</li>
	
	
		    <li> <a class="dropdown-btn">Fair Management<i class="fa fa-caret-down"></i> </a>
	<ul class="submenu">
        <li> <a href="booking.php" target="adminifarme">Add Booking</a></li>
        <li> <a href="booking_view.php" target="adminifarme">View Booking Information</a></li>
      </ul>
	</li>
	
	
			    <li> <a class="dropdown-btn">Expense Management<i class="fa fa-caret-down"></i> </a>
	<ul class="submenu">
        <li> <a href="expense.php" target="adminifarme"> Add Expense</a></li>
        <li>  <a href="expense_view.php" target="adminifarme">View Expense</a></li>
      </ul>
	</li>
	
	
	 <li> <a class="dropdown-btn">User Management<i class="fa fa-caret-down"></i> </a>
	<ul class="submenu">
        <li> <a href="usermanagement.php" target="adminifarme">Add New User</a></li>
        <li>  <a href="user_view.php" target="adminifarme">View All User</a></li>
      </ul>
	</li>
	
		  <?php 
  if ($_SESSION["role"]=="general_manager") {
  ?>
	 <li> <a class="dropdown-btn">Report<i class="fa fa-caret-down"></i> </a>
	<ul class="submenu">
        <li> <a href="income_report.php" target="adminifarme">Income Report</a></li>
        <li> <a href="expense_report.php" target="adminifarme">Expense Report</a></li>
		 <li> <a href="final_report.php" target="adminifarme">Profit and Loss </a></li>
      </ul>
	</li>
	
  <?php 
  }
?>
	
  </ul>
</nav>


</div>

<div class="main">
<div class="profile">
	<ul class="profile-wrapper">
			
				<!-- user profile -->
				<div class="profile1">
					<img src="http://gravatar.com/avatar/0e1e4e5e5c11835d34c0888921e78fd4?s=80" />
					
					<!-- more menu -->
					<ul class="menu">
						<li> <a href="user_edit.php" target="adminifarme">Edit</a></li>
						<li><a href="../index.php" onclick='return confirm_click()'><span style="color: red; font-weight: bold;font-size: 18px;">Log out</span></a></li>
					</ul>
				</div>
			
		</ul>
	
	
</div>

  
<iframe name="adminifarme" height="790px;" width="100%" style="margin-top: 126px;">


      <img src="http://localhost/rent/Admin/uploads/banner1.png" alt="Lights" />                      
    

   
</iframe>
</div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>

</body>
</html> 
<script type="text/javascript">
  
  function confirm_click()
  {
  
    confirm_click=confirm('Are You Confirm to Log out?');
    if(confirm_click==true)
    {
      
      return true;
    }
    else
    {
      return false;
    }
  }
</script>
<?php } 
else 
  { 
    print "<h1 style='color:#FF0000;'>Sorry!! You Can Not Authorized To See This Page.</h1><br>"; 
    print "<a href='../user'style='color:#5481FC; font-size:30px;'>Back</a>"; 
} 
?>
