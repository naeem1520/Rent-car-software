<?php
require_once("../db_connect/config.php");
require_once("../db_connect/connection.php");
$db=new database();
global $sms;

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../public/css/custom.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <style type="text/css">
    li.half {
    width: 50%;
    text-align: center;
    font-size: 24px;
    background: #028182;
    color: #fff;
      }
      li.half a {
    color: #fff;
}
li.half a:hover {
    color: #028182;
}
li.active.half {
    background: #fff;
    border: 1px solid #028182;
    border-radius: 4px;
}
    div#avail,div#unavail {
       background: #fff;
      }
    .thumbnail {
       background: #028182!important;
    }
    .thumbnail img {
    height: 200px;
    width: 100%;
}
    .ptitle {
      font-size: 23px;
      text-align: center;
      font-weight: 700;
    }
    p.psub {
    font-size: 16px;
    text-align: center;
    }
    p.pprice {
    font-size: 21px;
    color: #fff824;
    text-align: center;
    }
    .caption {
    text-align: center!important;
   }

  </style>
</head>
<body>


<div class="container">
  <h2>Try Booking </h2>

  <ul class="nav nav-tabs">
    <li class="active half"><a data-toggle="tab" href="#avail">Available Cars</a></li>
    <li class="half"><a data-toggle="tab" href="#unavail">Unavailable Cars</a></li>
  </ul>

  <div class="tab-content">
    <div id="avail" class="tab-pane fade in active">
      <h3>Available Cars</h3>
      <p>
      <div class="row">
       <?php
            
            $car_data="SELECT * FROM car_information WHERE car_track_no NOT IN (SELECT car_track_no FROM booking_information)";
            $car_data_row=$db->select($car_data);
            if($car_data_row)
            {
              foreach( $car_data_row as $fetch)
              {
                  ?>
                      
                        <div class="col-md-4">
                          <div class="thumbnail">
                            
                            <img src="<?php echo $fetch['image_link']; ?>" alt="Lights" style="width:100%">
                              <p class="ptitle"><?php echo $fetch['name']; ?></p>
                              <p class="psub"><?php echo $fetch['car_track_no']; ?></p>
                              <p class="pprice"><i class="fa fa-bdt" aria-hidden="true"></i><?php echo $fetch['price']; ?></p>
                              <div class="caption">
                                
                                 <a class="btn btn-info btn-lg" href="booking_form.php?book=<?php echo $fetch['id']; ?>">Click to Book</a>

                              </div>
                            
                          </div>
                        </div>
                      
                <?php
                  
                }}
         ?>
       </div>

      </p>
    </div>
    <div id="unavail" class="tab-pane fade">
      <h3>Unavailable Cars</h3>
      <p><div class="row">
       <?php
            
            $car_data="SELECT * FROM car_information WHERE car_track_no IN (SELECT car_track_no FROM booking_information)";
            $car_data_row=$db->select($car_data);
            if($car_data_row)
            {
              foreach( $car_data_row as $fetch)
              {
                  ?>
                      
                        <div class="col-md-4">
                          <div class="thumbnail">
                            
                            <img src="<?php echo $fetch['image_link']; ?>" alt="Lights" style="width:100%">
                              <p class="ptitle"><?php echo $fetch['name']; ?></p>
                              <p class="psub"><?php echo $fetch['car_track_no']; ?></p>
                              <p class="pprice"><i class="fa fa-bdt" aria-hidden="true"></i><?php echo $fetch['price']; ?></p>
                              <div class="caption">
                                
                                <!--  <a class="btn btn-info btn-lg" href="booking_form.php?book=<?php //echo $fetch['id']; ?>">Click to Book</a> -->

                              </div>
                            
                          </div>
                        </div>
                      
                <?php
                  
                }}
         ?>
       </div></p>
    </div>
  </div>
</div>

</body>

