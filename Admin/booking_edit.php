<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
@session_start();
global $sms;
global $fetch;

if (isset($_GET['edit'])) {

    $id=$_GET['edit'];

    $get_booking="SELECT * FROM booking_information where id='$id'";
    $booking_data=$db->select($get_booking);

  
        $fetch=$booking_data->fetch_array();
    

}


if(isset($_POST["update"]))

{


@$id=$_POST["id"];
@$s_l=$_POST["s_l"];
@$c_name=$_POST["c_name"];
@$c_address=$_POST["c_address"];
@$c_number=$_POST["c_number"];
@$car_model=$_POST["car_model"];
@$day=$_POST["day"];
@$pick_address =$_POST["pick_address"];
@$end_address =$_POST["end_address"];
@$date =$_POST["date"];
@$driver_name =$_POST["driver_name"];
@$assign_car =$_POST["assign_car"];
@$amount =$_POST["amount"];



  if(!empty($s_l)&& !empty($c_name) && !empty($c_address )&& !empty($c_number)
&& !empty($car_model)&& !empty($day)&& !empty($pick_address )&& !empty($end_address )&& !empty($date )&& !empty($driver_name )&& !empty($assign_car )&& !empty($amount ))
  {
  $update="UPDATE `rent_management`.`booking_information`
SET
  `s_l` = '$s_l',
  `c_name` = '$c_name',
  `c_address` = '$c_address',
  `c_number` = '$c_number',
  `car_model` = '$car_model',
  `day` = '$day',
  `pick_address` = '$pick_address',
  `end_address` = '$end_address',
  `date` = '$date',
  `driver_name` = '$driver_name',
  `assign_car` = '$assign_car',
  `amount` = '$amount'
WHERE `id` = '$id';";


      $r_update=$db->update($update);

      if($r_update)
      { 
         
         header('location: booking_view.php');

         $_SESSION['message'] = "Booking  updated!";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Sorry Booking update UnSuccessfully!!</span>";
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
  <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script language="javascript">
        $(document).ready(function () {
            $("#txtdate").datepicker({
                minDate: 0
            });
        });
    </script>
  
</head>
<body>

<div class="information">
  <h2>Update Booking</h2>
   <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
  <table>
        
        <tr>
          <td> Booking Number</td>
          <td>: </td>
         <td><input type="text"  name="s_l" value="<?php echo $fetch['s_l'] ?>"require>
        <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
        </tr><tr>
          <td>Customer Name</td>
          <td>: </td>
          <td><input type="text" name="c_name" value="<?php echo $fetch['c_name'] ?>" required></td>
        </tr><tr>
          <td>Customer Address</td>
          <td>: </td>
          <td><input type="text" name="c_address" value="<?php echo $fetch['c_address'] ?>" required></td>
        </tr><tr>
          <td>Customer Number</td>
          <td>: </td>
          <td><input type="text" name="c_number" value="<?php echo $fetch['c_number'] ?>" required></td>
        </tr><tr>
          <td>Car Model</td>
          <td>: </td>
          <td><input type="text" name="car_model" value="<?php echo $fetch['car_model'] ?>" required></td>
          </tr><tr>
          <td>Day's</td>
          <td>: </td>
          <td><input type="text" name="day" value="<?php echo $fetch['day'] ?>" required></td>
          </tr><tr>
          <td>Pick-up address</td>
          <td>: </td>
          <td><input type="text" name="pick_address" value="<?php echo $fetch['pick_address'] ?>" required></td>
        </tr><tr>
          <td>Pick-end address</td>
          <td>: </td>
           <td><input type="text" name="end_address" value="<?php echo $fetch['end_address'] ?>" required></td>
        </tr><tr>
          <td> Date</td>
          <td>: </td>
           <td><input id="txtdate" type="text"  name="date" value="<?php date('Y-m-d', strtotime('dd/mm/yyyy')) ?>" required></td>
        </tr><tr>
          <tr>
          <td> Assign driver Name</td>
          <td>: </td>
           <td><input type="text" name="driver_name" value="<?php echo $fetch['driver_name'] ?>" required></td>
        </tr><tr>
          <tr>
          <td> Assign car</td>
          <td>: </td>
           <td><input type="text" name="assign_car" value="<?php echo $fetch['assign_car'] ?>" required></td>
        </tr><tr>
          <tr>
          <td> Amount</td>
          <td>: </td>
           <td><input type="text" name="amount" value="<?php echo $fetch['amount'] ?>" required></td>
        </tr>
      <tr>
          <td class="danger" colspan="3" align="center"><span><?php print $sms; ?></span></td>
     </tr>
      

   </table>
       <input type="submit" name="update" value="Update">
  </form>
</div>