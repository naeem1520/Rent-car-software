<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
global $sms;


//$fetch_data[0]=auto('booking_information','s_l','BN-',8);


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


if(isset($_POST["add"]))
{
  if(!empty($s_l)&& !empty($c_name) && !empty($c_address )&& !empty($c_number)
&& !empty($car_model)&& !empty($day)&& !empty($pick_address )&& !empty($end_address )&& !empty($date )&& !empty($driver_name )&& !empty($assign_car )&& !empty($amount ))
  {
  
    $q="SELECT * FROM booking_information where s_l='$s_l'";
    $r_q=$db->select($q);
    if(!$r_q)
    {
      $insert="INSERT INTO `rent_management`.`booking_information`
            (
             `s_l`,
             `c_name`,
             `c_address`,
             `c_number`,
             `car_model`,
             `day`,
             `pick_address`,
             `end_address`,
             `date`,
             `driver_name`,
             `assign_car`,
             `amount`)
VALUES (
        '$s_l',
        '$c_name',
        '$c_address',
        '$c_number',
        '$car_model',
        '$day',
        '$pick_address',
        '$end_address',
        '$date',
        '$driver_name',
        '$assign_car',
        '$amount')";

      $r_insert=$db->insert($insert);

      if($r_insert)
      { 
         $sms="<span class='text-center text-success'> Booking Informatin Add Successfully!! </p></span>";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Sorry Booking Informatin Add UnSuccessfully!!</span>";
      }
    }
    else
    {
       echo"<script>alert('Please Check Your s_i This s_i Already Exist')</script>";
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
  <h2>Add Car Booking</h2>
   <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
  <table>
        
        <tr>
          <td> Booking Number</td>
          <td>: </td>
          <td><input type="text"  name="s_l"  required readonly value="<?php echo getLastID($db);?>"></td>
        </tr><tr>
          <td>Customer Name</td>
          <td>: </td>
          <td><input type="text" name="c_name" required></td>
        </tr><tr>
          <td>Customer Address</td>
          <td>: </td>
          <td><input type="text" name="c_address" required></td>
        </tr><tr>
          <td>Customer Number</td>
          <td>: </td>
          <td><input type="text" name="c_number" required></td>
        </tr><tr>
          <td>Car Model</td>
          <td>: </td>
          <td><input type="text" name="car_model" required></td>
        </tr><tr>
          <td>Day's</td>
          <td>: </td>
          <td><input type="text" name="day" required></td>
        </tr><tr>
          <td>Pick-up address</td>
          <td>: </td>
          <td><input type="text" name="pick_address" required></td>
        </tr>
<tr>
          <td>Pick-end address</td>
          <td>: </td>
          <td><input type="text" name="end_address" required></td>
        </tr><tr>
          <td> Date</td>
          <td>: </td>
          <td><input type="date"  name="date" value="<?php date('Y-m-d', strtotime('dd/mm/yyyy')) ?>" required></td>
        </tr><tr>
          <tr>
          <td> Assign driver Name</td>
          <td>: </td>
          <td><input type="text"  name="driver_name" required></td>
        </tr><tr>
          <tr>
          <td> Assign car</td>
          <td>: </td>
          <td><input type="text"  name="assign_car" required></td>
        </tr><tr>
          <tr>
          <td> Amount</td>
          <td>: </td>
          <td><input type="text" name="amount" required></td>
        </tr>
      <tr>
          <td class="danger" colspan="3" align="center"><span><?php print $sms; ?></span></td>
     </tr>
      

    </table>
        <input type="submit" name="add" value="ADD">
  </form>
</div>

<?php
// code for getting the last inserted row id from database 
function getLastID($conn)
{
  $sql = "SELECT MAX(id) FROM booking_information";
  $result = $conn->select($sql);

  while($row=$result->fetch_array()) 
  {
    if ($row[0] >= 1) 
    {
      $sqlx = "SELECT * FROM booking_information WHERE id='".$row[0]."'";
      $resultx = $conn->select($sqlx);

      while($rowx=$resultx->fetch_array()) 
      {
        return $rowx[1] + 1;
      }
    } elseif ($row[0] <= 0) {
      return "101";
    }
  }
}

?>


