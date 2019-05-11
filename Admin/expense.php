<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
@session_start();
global $sms;

if (isset($_GET['delete'])) {

    $id=$_GET['delete'];

    $get_booking_info="DELETE FROM booking_information where id='$id'";
    $booking_data=$db->delete($get_booking_info);

    if ($booking_data) {

        header('location: booking_view.php');

                    $_SESSION['deletemessage'] = "booking info delete!";
    }else
    {
          $_SESSION['deletemessage'] = "booking info Not delete!";
    }

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
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
button {
    margin-top: 20px;
    background: #028182;
    color: #fff;
    padding: 9px 31px;
    font-size: 20px;
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
  .default:hover {background: #ddd;}

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
<h2 style="text-align: center;"> All Booking Information </h2>
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
      <form action="" method="get">
<table class="tbl_srch">
                
                    <tr>
                        
                        <td>
                            <input type="text" name="srch_id" placeholder="Search By ID">
                        </td>
                        <td>
                            <input type="text" name="srch_name" placeholder="Search By Name">
                        </td>

                        <td>
                            <input type="submit" name="search">
                        </td>
                    </tr>
                </table>
                </form>


            </center>

  <table>
    <tr>
      <th>S.I</th>
      <th>Booking Num</th>
      <th>Assign car</th>
      <th>Car model</th>
      <th>Driver name</th>
      <th>Day's</th> 
     
      <th>Amount</th>
      <th>Action</th>
    </tr>
    <?php
    if(isset($_GET['search'])){
                        $id=$_GET["srch_id"];
                        $name=$_GET["srch_name"];
                        $sql="SELECT * FROM booking_information WHERE id = '$sl' OR Name = '$c_name'";
                    } else{
                        $sql="SELECT * FROM booking_information";
                    }
    // $booking_data="select * from booking_information";
    $booking_data="SELECT * FROM booking_information WHERE s_l NOT IN (SELECT booking_number FROM expense)";
    $booking_data_row=$db->select($booking_data);
    if($booking_data_row)
    {
      $sl=0;
      while($fetch=$booking_data_row->fetch_array())
      {
        $sl++;
        ?>
        <tr>
          <td><?php echo $sl; ?></td>
          <td><?php echo $fetch['s_l']; ?></td>
          <td><?php echo $fetch['assign_car']; ?></td>
          <td><?php echo $fetch['car_model']; ?></td>
          <td><?php echo $fetch['driver_name']; ?></td>
          <td><?php echo $fetch['day']; ?></td>
          <td><?php echo $fetch['amount']; ?></td>
          <td> <a style="color: #fff;" href="expense_add.php?add=<?php echo $fetch[0]; ?>">Add Expense</a></td>
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