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
      <h1 style="text-align: center;">Expense Report</h1>

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
      <th>S.N</th>
      <th>Date</th>
      <th>Booking No</th>
      <th>Total Expense</th>
        </tr>
        
    <?php
        
        if(isset($_POST["submit"]))
        {

          @$from_date=$_POST["from_date"];
          @$to_date=$_POST["to_date"];

          $total_price="SELECT SUM(Total) as total_ammount FROM expense where date >= '$from_date' AND date <= '$to_date'";

          $total_price_fetch=$db->select($total_price);
          $total_ammount=$total_price_fetch->fetch_assoc();


          $get_expense="SELECT * FROM expense where date >= '$from_date' AND date <= '$to_date'";
          $expense_data=$db->select($get_expense);

          $sl=0;
          while($fetch=$expense_data->fetch_assoc())
          {
            $sl++;
            ?>
            <tr>
              <tr>
          <td><?php echo $sl; ?></td>
          <td><?php echo $fetch['s_n']; ?></td>
          <td><?php echo $fetch['date']; ?></td>
          <td><?php echo $fetch['booking_number']; ?></td>
          <td><?php echo $fetch['Total']; ?></td>
            </tr>

            <?php

          }
?>        
        <tr>
          <td colspan="4" style="text-align: right;font-weight: 900;color: #f00;font-size: 20px;">Total Amount:</td>
           <td  style="font-weight: 900;font-size: 20px;"><?php echo $total_ammount['total_ammount']; ?></td>
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
