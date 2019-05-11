<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");

$db=new database();
@session_start();

global $sms;
global $fetch;


?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="report.css">
 <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script>
  $( function() {
    $( "#txtdate" ).datepicker();
  } ); 
   $( function() {
    $( "#txtdate2" ).datepicker();
  } );
  </script>
 
 
</head>
<body>
  <div>
    <div class="header">
      <h1 style="text-align: center;">Profit and Loss</h1>

      <div class="body">

        <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
          <div class="form">
           <table>
            <tr>
              <td style="font-size: 19px;    border: none;"> From Date:

             <input id="txtdate" type="text"  name="from_date" value="<?php date('Y-m-d', strtotime('dd/mm/yyyy')) ?>" required></td>
             
              <td style="font-size: 19px;    border: none;     padding-left: 32px;">To Date:
              <input id="txtdate2" type="text"  name="to_date" value="<?php date('Y-m-d', strtotime('dd/mm/yyyy')) ?>" required></td>
       
        <td style="font-size: 19px;    border: none;     padding-left: 32px;"><input type="submit" name="submit" value="submit"></td>
            </tr>
          </table>
        </div>

      </form>


      <table>
        <tr>
          <tr>
      <th>SL</th>
      <th>Date</th>
      <th>Booking No</th>
      <th>SN</th>
      <th>Booking Amount</th>
      <th>Expense Amount</th>
      <th>Profit</th>
        </tr>
        
    <?php
        
        if(isset($_POST["submit"]))
        {

          @$from_date=$_POST["from_date"];
          @$to_date=$_POST["to_date"];

          // $total_price="SELECT SUM(Total) as total_ammount FROM expense where date >= '$from_date' AND date <= '$to_date'";

          // $total_price_fetch=$db->select($total_price);
          // $total_ammount=$total_price_fetch->fetch_assoc();


          $get_expense="SELECT expense.s_n,expense.date,expense.booking_number,expense.Total,booking_information.amount FROM `expense` INNER JOIN booking_information ON expense.booking_number = booking_information.s_l WHERE expense.date >= '$from_date' AND expense.date <= '$to_date'";
         
          $expense_data=$db->select($get_expense) or die($db->error);
          $total_profit = 0;
          

          $sl=0;
          while($fetch=$expense_data->fetch_assoc())
          {
            $sl++;
            $total_profit += $fetch['amount']-$fetch['Total'];
            ?>
            <tr>
              <tr>
          <td><?php echo $sl; ?></td>
          <td><?php echo $fetch['date']; ?></td>
          <td><?php echo $fetch['booking_number']; ?></td>
          <td><?php echo $fetch['s_n']; ?></td>
          <td><?php echo $fetch['amount']; ?></td>
          <td><?php echo $fetch['Total']; ?></td>
          <td><?php echo $fetch['amount']-$fetch['Total']; ?></td>
          
          
            </tr>

            <?php

          }
?>        
        <tr>
          <td></td><td></td>
          <td colspan="4" style="text-align: right;font-weight: 900;color: #f00;font-size: 20px;">Total Profit:</td>
           <td  style="font-weight: 900;font-size: 20px;"><?php echo $total_profit; ?></td>
        </tr>
          
            <?php
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

    </div>
  </div>
</div>
</body>
</html>
