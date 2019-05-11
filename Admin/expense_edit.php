<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
@session_start();

global $sms;
global $fetch;

if (isset($_GET['edit'])) {

    $id=$_GET['edit'];

    $get_expense_info="SELECT * FROM expense where id='$id'";
    $expense_data=$db->select($get_expense_info);

    while ($fetch = $expense_data->fetch_assoc()) {
      $s_n = $fetch['s_n'];
      $booking_number = $fetch['booking_number'];
      $name = $fetch['name'];
      $c_name = $fetch['c_name'];
      $oil_number = $fetch['oil_number'];
      $oil_amount = $fetch['oil_amount'];
      $cng_number = $fetch['cng_number'];
      $cng_amount = $fetch['cng_amount'];
      $toll_number = $fetch['toll_number'];
      $toll_amount = $fetch['toll_amount'];
      $lunch = $fetch['lunch'];
      $dinner = $fetch['dinner'];
      $salary = $fetch['salary'];
      $Total = $fetch['Total'];
        $id  = $fetch['id'];
    }
    
}


if(isset($_POST["update"]))
{
@$id=$_POST["id"];
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
@$Total =$_POST["total"];


  if(!empty($s_n)&& !empty($date) && !empty($booking_number )&& !empty($name)
&& !empty($c_name)&& !empty($oil_number )&& !empty($oil_amount )&& !empty($cng_number )&& !empty($cng_amount )&& !empty($toll_number )&& !empty($toll_amount )&& !empty($lunch )&& !empty($dinner )&& !empty($salary ))
  {
    
    
    $update="UPDATE `rent_management`.`expense`
SET 
  `s_n` = '$s_n',
  `date` = '$date',
  `booking_number` = '$booking_number',
  `name` = '$name',
  `c_name` = '$c_name',
  `oil_number` = '$oil_number',
  `oil_amount` = '$oil_amount',
  `cng_number` = '$cng_number',
  `cng_amount` = '$cng_amount',
  `toll_number` = '$toll_number',
  `toll_amount` = '$toll_amount',
  `lunch` = '$lunch',
  `dinner` = '$dinner',
  `salary` = '$salary',
  `Total` = '$Total'
WHERE `id` = '$id'";

      $r_update=$db->update($update);

      if($r_update)
      { 
         
         echo "<script>alert('Expense Information Updated Successfully');location.href='expense_view.php';</script>";
      }
      else
      {
         $sms="<span class='text-center text-warning'> Sorry Expense Info update UnSuccessfully!!</span>";
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
</head>
<body>


<div class="main">
<div class="information cus">
  <h2>Update Expense</h2>
   <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="createAdminUser">
  <table>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <tr>
          <td> S.N</td>
          <td>: </td>
          <td><input type="text" p name="s_n" required readonly value="<?php echo $s_n  ;?>"></td>
        </tr>
        <tr>
          <td> Date</td>
          <td>: </td>
           <td><input type="date"  name="date" value="<?php date('Y-m-d', strtotime('dd/mm/yyyy')) ?>" required></td>
        </tr>
        <tr>
          <td> Booking Number</td>
          <td>: </td>
<td><input type="text"  name="booking_number"  required readonly value="<?php echo $booking_number;?>"></td>
        </tr>
        <tr>
          <td>Driver Name</td>
          <td>: </td>
          <td><input type="text" value="<?=$name;?>" name="name" required></td>
        </tr><tr>
          <td>Car Name</td>
          <td>: </td>
          <td><input type="text" value="<?=$c_name;?>" name="c_name" required></td>
        </tr><tr>
          <td>Oil Cost </td>
         </tr> <tr>
          <td>Oil Cost receipt number</td>
          <td>: </td>
          <td><input type="text" value="<?=$oil_number;?>" name="oil_number" required></td>
        </tr>
<tr>
          <td>Oil Cost Amount</td>
          <td>: </td>
          <td><input type="text" id="oil_cost" value="<?=$oil_amount;?>" name="oil_amount" required></td>
        </tr>
        
      <tr>
          <td>CNG Cost </td>

         </tr> <tr>
          <td>CNG Cost receipt number</td>
          <td>: </td>
          <td><input type="text" value="<?=$cng_number;?>" name="cng_number" required></td>
        </tr>
      <tr>
          <td>CNG Cost Amount</td>
          <td>: </td>
          <td><input type="text" id="cng_cost" value="<?=$cng_amount;?>" name="cng_amount" required></td>
        </tr>


      <tr>
          <td>Toll Cost </td>
         </tr> <tr>
          <td>Toll Cost receipt number</td>
          <td>: </td>
          <td><input type="text" value="<?=$toll_number;?>" name="toll_number" required></td>
        </tr>
      <tr>
          <td>Toll Cost Amount</td>
          <td>: </td>
          <td><input type="text" id="toll_cost" value="<?=$toll_amount;?>" name="toll_amount" required></td>
        </tr>

        <tr>
          <td>Allowance Cost </td>
         </tr> <tr>
          <td>Lunch</td>
          <td>: </td>
          <td><input type="text" id="lunch_cost" value="<?=$lunch ;?>" name="lunch" required></td>
        </tr>
<tr>
          <td>Dinner</td>
          <td>: </td>
          <td><input type="text" id="dinner_cost" value="<?=$dinner ;?>" name="dinner" required></td>
        </tr>

         <tr>
          <td> Salary</td>
          <td>: </td>
          <td><input type="text" id="salary_cost" value="<?=$salary;?>" name="salary" required></td>
        </tr>
        <tr>
          <td> Total</td>
          <td>: </td>
          <td><input type="text" id="t_amount" value="<?=$Total;?>" name="total" required></td>
        </tr>


          </tr>
          <td class="danger" colspan="3" align="center"><span><?php print $sms; ?></span></td>
     </tr>
      

    </table>
        <input type="submit" name="update" value="Update">
  </form>
</div>


     
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
