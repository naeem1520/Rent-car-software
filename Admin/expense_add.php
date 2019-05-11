
<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
global $sms;


@$s_n=$_POST["s_n"];
@$date=$_POST["date"];
@$booking_number=$_POST["booking_number"];
@$name=$_POST["name"];
@$c_name=$_POST["c_name"];
@$oil_number =$_POST["oil_number"];
@$oil_amount =$_POST["oil_amount"];
@$cng_number =$_POST["cng_number"];
@$cng_amount =$_POST["cng_amount"];
@$toll_number =$_POST["toll_number"];
@$toll_amount =$_POST["toll_amount"];
@$lunch =$_POST["lunch"];
@$dinner =$_POST["dinner"];
@$salary =$_POST["salary"];
@$Total =$_POST["t_amount"];


if(isset($_POST["add"]))
{
  if(!empty($s_n)&& !empty($date) && !empty($booking_number )&& !empty($name)
&& !empty($c_name)&& !empty($oil_number )&& !empty($oil_amount )&& !empty($cng_number )&& !empty($cng_amount )&& !empty($toll_number )&& !empty($toll_amount )&& !empty($lunch )&& !empty($dinner )&& !empty($salary ))
  {
  
    $q="SELECT * FROM expense where s_n='$s_n'";
    $r_q=$db->select($q);
    if(!$r_q)
    {
      @$insert="INSERT INTO `rent_management`.`expense`
            (
             `s_n`,
             `date`,
             `booking_number`,
             `name`,
             `c_name`,
             `oil_number`,
             `oil_amount`,
             `cng_number`,
             `cng_amount`,
             `toll_number`,
             `toll_amount`,
             `lunch`,
             `dinner`,
             `salary`,
             `Total`)
VALUES (
        '$s_n',
        '$date',
        '$booking_number',
        '$name',
        '$c_name',
        '$oil_number',
        '$oil_amount',
        '$cng_number',
        '$cng_amount',
        '$toll_number',
        '$toll_amount',
        '$lunch',
        '$dinner',
        '$salary',
        '$Total' )";
      $r_insert=$db->insert($insert);

      if($r_insert)
      { 
          echo "<script>alert('Expense added Successfully');location.href='expense.php';</script>";
      }
      else
      {
         $sms="<span class='text-center text-warning'> expense Add UnSuccessfully!!</span>";
      }
    }
    else
    {
       echo"<script>alert('Please Check Your s_i This s_i Already Exist');location.href='expense.php';</script>";
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
  <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   
   
  
</head>
<body>


<div class="main">
<div class="information cus">
  <h2>Add Expense</h2>

 <?php
   if (isset($_GET['add'])) {
     $book_id = $_GET['add'];
    // echo $car_id;
    $select_book = "SELECT * FROM `booking_information` WHERE id = '$book_id'";
    $exe_book = $db->select($select_book);
    while ($row = $exe_book->fetch_assoc()) {
      $driver_name = $row['driver_name'];
      $Car_name = $row['assign_car'];
      $Booking_no = $row['s_l'];
      $Date = $row['date'];
      
}}?>


   <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
  <table>
        
        <tr>
          <td> S.N</td>
          <td>: </td>
          <td><input type="text" p name="s_n" required readonly value="<?php echo getLastID($db);?>"></td>
        </tr><tr>
          <td> Date</td>
          <td>: </td>
           <td><input id="txtdate" type="text" readonly  name="date" value="<?=$Date; ?>" required></td>
        </tr><tr>
          <td> Booking Number</td>
          <td>: </td>
          <td><input type="text"  name="booking_number"  required readonly value="<?php echo $Booking_no;?>"></td>
        </tr><tr>
          <td>Driver Name</td>
          <td>: </td>
          <td><input type="text" value="<?php echo $driver_name;?>" name="name" readonly></td>
        </tr><tr>
          <td>Car Name</td>
          <td>: </td>
          <td><input type="text" value="<?php echo $Car_name;?>" name="c_name" readonly></td>
        </tr>



        <tr>
          <td> <h4 class="oil-cost">Oil Cost</h4> </td>
         </tr> <tr>
          <td>Oil Cost receipt number</td>
          <td>: </td>
          <td><input type="text" name="oil_number" required></td>
        </tr>
       <tr>
          <td>Oil Cost Amount</td>
          <td>: </td>
          <td><input type="text" id="oil_cost" name="oil_amount" required></td>
        </tr>
        



        <tr>
          <td> <h4 class="oil-cost">CNG Cost </h4></td>

         </tr> <tr>
          <td>CNG Cost receipt number</td>
          <td>: </td>
          <td><input type="text" name="cng_number" required></td>
        </tr>
      <tr>
          <td>CNG Cost Amount</td>
          <td>: </td>
          <td><input type="text" id="cng_cost" name="cng_amount" required></td>
        </tr>


        <tr>
          <td> <h4 class="oil-cost">Toll Cost</h4> </td>
         </tr> <tr>
          <td>Toll Cost receipt number</td>
          <td>: </td>
          <td><input type="text" name="toll_number" required></td>
        </tr>
        <tr>
          <td>Toll Cost Amount</td>
          <td>: </td>
          <td><input type="text" id="toll_cost" name="toll_amount" required></td>
        </tr>
 <tr>
          <td> <h4 class="oil-cost">Allowance Cost</h4> </td>
         </tr>
 <tr>
          <td>Lunch</td>
          <td>: </td>
          <td><input type="text" id="lunch_cost" name="lunch" required></td>
        </tr>
         <tr>
          <td>Dinner</td>
          <td>: </td>
          <td><input type="text" id="dinner_cost" name="dinner" required></td>
        </tr>

         <tr>
          <td> Salary</td>
          <td>: </td>
          <td><input type="text" id="salary_cost" name="salary" required></td>
        </tr>
         <tr>
          <td>Total Ammount</td>
          <td>: </td>
          <td><input type="text"  id="t_amount" readonly name="t_amount" required></td>
        </tr>


          </tr>
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
  $sql = "SELECT MAX(id) FROM expense";
  $result = $conn->select($sql);

  while($row=$result->fetch_array()) 
  {
    if ($row[0] >= 1) 
    {
      $sqlx = "SELECT * FROM expense WHERE id='".$row[0]."'";
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
  $("#oil_cost,#cng_cost,#toll_cost,#lunch_cost,#dinner_cost,#salary_cost").on('change keyup',function(e)
    {
        let  oil_cost= $("#oil_cost").val();
        let  cng_cost= $("#cng_cost").val();
        let  toll_cost= $("#toll_cost").val();
        let  lunch_cost= $("#lunch_cost").val();
        let  dinner_cost= $("#dinner_cost").val();
        let salary_cost = $("#salary_cost").val();
        
        
            $("#t_amount").val(parseInt(oil_cost) + parseInt(cng_cost) + parseInt(toll_cost) + parseInt(lunch_cost) + parseInt(dinner_cost) + parseInt(salary_cost));
        

    });
</script>
