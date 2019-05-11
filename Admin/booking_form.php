    <?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
global $sms;
// $car_id = $_GET['book'];
// echo $car_id;

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
@$amount =$_POST["total"];
@$carTrac =$_POST["carTrack"];


if(isset($_POST["add"]))
{
  if(!empty($s_l)&& !empty($c_name) && !empty($c_address )&& !empty($c_number)
&& !empty($car_model)&& !empty($day)&& !empty($pick_address )&& !empty($end_address )&& !empty($date )&& !empty($driver_name )&& !empty($assign_car )&& !empty($amount )&& !empty($carTrac ))
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
             `amount`,
             `car_track_no`)
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
        '$amount',
        '$carTrac')";
        

      $r_insert=$db->insert($insert);

      if($r_insert)
      { 
         echo "<script>alert('Booking Information added Successfully');location.href='booking.php';</script>";

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

 <?php
  if (isset($_GET['book'])) {
    $car_id = $_GET['book'];
    // echo $car_id;
    $select_car = "SELECT * FROM `car_information` WHERE id = '$car_id'";
    $exe_car = $db->select($select_car);
    while ($row = $exe_car->fetch_assoc()) {
      $name = $row['name'];
      $amount = $row['price'];
      $Track = $row['car_track_no'];
      $Model = $row['model_number'];
    }}


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
<style type="text/css">
   .sl_crs{
                padding: 10px;
                margin-bottom: 5px;
                margin-top: 5px;
                padding-left: 50px;
                padding-right: 5px;
            }
</style>
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
          <td><input type="text" readonly value="<?=$Model;?>" name="car_model" required></td>
        </tr><tr>
          <td>Day's</td>
          <td>: </td>
          <td><input id="Days" type="text" name="day" required></td>
        </tr><tr>
          <td>Pick-up address</td>
          <td>: </td>
          <td><input class="addre-filed" type="text" name="pick_address" required></td>
        </tr>
        <tr>
          <td>Pick-end address</td>
          <td>: </td>
          <td><input class="addre-filed" type="text" name="end_address" required></td>
        </tr><tr>
          <td> Date</td>
          <td>: </td>
          <td><input id="txtdate" type="text"  name="date" value="<?php date('Y-m-d', strtotime('dd/mm/yyyy')) ?>" required></td>
        </tr><tr>
          <tr>
          <td> Assign driver Name</td>
          <td>: </td>
           <td>
                     <select class="sl_crs" name = "driver_name" >
                            <?php 
                               $qry = "SELECT * FROM `driver_information`";
                               $result=  $db->select($qry);
                             if(mysqli_num_rows($result)>0){
                             while ($row = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $row["name"];?>"><?php echo $row["name"];?></option> 
                            <?php }?>
                            <?php }
                            ?>
                    </td>
        </tr><tr>
          <tr>
          <td> Assign car</td>
          <td>: </td>
          <td><input type="text"  name="assign_car" value="<?php echo $name;?>" required></td>
        </tr><tr>
         <tr>
          <td>Per Day Price </td> 
          <td>: </td>
          <td><input type="text" value="<?php echo $amount;?>" id="Amount" name="amount" required></td>
         </tr>
         <tr>
          <td>Total Amount</td> 
          <td>: </td>
          <td><input type="text" readonly id="total" name="total" required></td>
         </tr>
         <tr>
          <td> Tracking Number</td>
          <td>: </td>
          <td><input type="text"  name="carTrack"  required readonly value="<?php echo $Track; ?>"></td>
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

<!-- code for auto calculation -->
<script type="text/javascript">
  $("#Days,#Amount").on('change keyup',function(e)
    {
        let  Days= $("#Days").val();
        let Amount = $("#Amount").val();
        
        if (Days == "")
        {
            $("#total").val(null);
        } else {
            $("#total").val(Days*Amount);
        }

    });
</script>

