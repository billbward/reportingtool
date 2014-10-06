<?php

//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL Report - Precheck</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap_bill.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="report-panel panel panel-ltblue">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>Staging Location - Evening Precheck</strong>      </h3>
                        <h5>Let us know what's happening at your location tomorrow.</h5>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="report_precheck_redirect.php">
                            <fieldset>

                                            <?php
                                            
                                                $myc_id = $_SESSION['vanid'];
                                                $key = $_SESSION['key'];
                                                $key_check = $myc_id . time(); 
                                                $key_valid = $key + 1200;
                                                $report = $_SESSION['report'];

                                                if($report == 'Precheck') {
                                                $canv_shifts_sched_tomorrow_1 = $_SESSION["canv_shifts_sched_tomorrow_1"];
                                                $canv_shifts_sched_tomorrow_2 = $_SESSION["canv_shifts_sched_tomorrow_2"];
                                                $canv_shifts_sched_tomorrow_3 = $_SESSION["canv_shifts_sched_tomorrow_3"];
				                                $phone_shifts_sched_tomorrow = $_SESSION["phone_shifts_sched_tomorrow"];
				                                $walk_pckts_unatt = $_SESSION["walk_pckts_unatt"];

                                                $canv_shifts_sched_tomorrow_1_val = $_SESSION["canv_shifts_sched_tomorrow_1"];
                                                $canv_shifts_sched_tomorrow_2_val = $_SESSION["canv_shifts_sched_tomorrow_2"];
                                                $canv_shifts_sched_tomorrow_3_val = $_SESSION["canv_shifts_sched_tomorrow_3"];
				                                $phone_shifts_sched_tomorrow_val = $_SESSION["phone_shifts_sched_tomorrow"];
				                                $walk_pckts_unatt_val = $_SESSION["walk_pckts_unatt"];

                                           		}
                                           		else{
                                           		$canv_shifts_sched_tomorrow_1 = "How many scheduled for Shift 1?";
                                                $canv_shifts_sched_tomorrow_2 = "How many scheduled for Shift 2?";
                                                $canv_shifts_sched_tomorrow_3 = "How many scheduled for Shift 3?";
				                                $phone_shifts_sched_tomorrow = "Phone shifts scheduled for tomorrow";
				                                $walk_pckts_unatt = "Packets ready to be walked";	

				                                $canv_shifts_sched_tomorrow_1_val = "";
                                                $canv_shifts_sched_tomorrow_2_val = "";
                                                $canv_shifts_sched_tomorrow_3_val = "";
				                                $phone_shifts_sched_tomorrow_val = "";
				                                $walk_pckts_unatt_val = "";
                                           		}

                                            

                                                if  ($key_check > $key_valid) {
                                                    $url = "login.php";

                                                function redirect($url)
                                                {
                                                    if (!headers_sent())
                                                    {    
                                                        header("'Location: ".$url."'");
                                                        exit;
                                                        }
                                                    else
                                                        {  
                                                        echo '<script type="text/javascript">';
                                                        echo 'window.location.href="'.$url.'";';
                                                        echo '</script>';
                                                        echo '<noscript>';
                                                        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                                                        echo '</noscript>'; exit;
                                                    }
                                                }

                                                redirect($url);
                                                } 


                                                 $db = mysqli_connect("domain", "user", "pw", "database")
                                                or die("Can't connect to database".mysql_error());

                                                    
                                                    $table_name = 'master_db.user_table';

                                                    $result = mysqli_query($db, "select * from " . $table_name . " where vanid = " . $myc_id);
                                                        if (!$result) {
                                                            echo "An error occurred.\n";
                                                        exit;
                                                        }
                                                    $result_fetch = mysqli_fetch_array($result,MYSQL_ASSOC);
                                                    $region = $result_fetch["region"];  


                                                if($region == 'Global') {
                                                    
                                                    $result = mysqli_query($db,"select sl from master_db.dynamic_dropdown");
                                                        if (!$result) {
                                                            echo "An error occurred.\n";
                                                            exit;
                                                        }
                                                }
                                                else{
                                                    $result = mysqli_query($db,"select sl from master_db.dynamic_dropdown where region = '" . $region . "'");
                                                        
                                                        if (!$result) {
                                                            echo "An error occurred.\n";
                                                            exit;
                                                        }
                                                }

                                            ?>
                                        
                                                    <?php
                                                    
                                                    $sl = $_SESSION['sl'];
                                                    echo "<div style=\"text-align:center;\">";
                                                    echo "<div style=\"text-align:left;\"><a href=\"pass_to_home.php\"><button type=\"button\" class=\"btn btn-primary btn-circle\"><i class=\"fa fa-home\"></i></button></a></div>";
                                                    echo "<h3><font face:\"Impact\"> <strong>" . $sl . "</strong></h3>";
                                                    
                                                    ?>

                                        <hr>
                                        

                                        <div style="text-align:center;">
                                        <h4><strong>Staging Location Inventory</strong>         </h4>
                                        </div>                                   
                                        <div class="form-group" style="text-align:center;">
                                            <br><label>Canvass Shifts Sched. Tmrw - 9:00a</label></br>
                                            <input class="form-control" style="text-align:center;" placeholder= <?php echo '"' . $canv_shifts_sched_tomorrow_1 . '"' ?> type="number" max="200" name="canv_shifts_sched_tomorrow_1" id="canv_shifts_sched_tomorrow_1" value=<?php echo '"' . $canv_shifts_sched_tomorrow_1_val . '"'?> >
                                        </div>                                   
                                        <div class="form-group" style="text-align:center;">
                                            <label>Canvass Shifts Sched. Tmrw - 12:30p</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $canv_shifts_sched_tomorrow_2 . '"' ?> type="number" max="200" name="canv_shifts_sched_tomorrow_2" id="canv_shifts_sched_tomorrow_2" value=<?php echo '"' . $canv_shifts_sched_tomorrow_2_val . '"'?> >
                                        </div>                                    
                                        <div class="form-group" style="text-align:center;">
                                            <label>Canvass Shifts Sched. Tmrw - 4:00p</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $canv_shifts_sched_tomorrow_3 . '"' ?> type="number" max="200" name="canv_shifts_sched_tomorrow_3" id="canv_shifts_sched_tomorrow_3" value=<?php echo '"' . $canv_shifts_sched_tomorrow_3_val . '"'?> >
                                        </div> 
                                        <div class="form-group">
                                            <label>Phone Shifts Scheduled for Tomorrow</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $phone_shifts_sched_tomorrow . '"' ?> type="number" max="200" name="phone_shifts_sched_tomorrow" id="phone_shifts_sched_tomorrow" value=<?php echo '"' . $phone_shifts_sched_tomorrow_val . '"'?> >
                                        </div> 
                                        <div class="form-group" style="text-align:center;">
                                            <label>Walk Packets Available at SL</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $walk_pckts_unatt . '"' ?> type="number" max="500" name="walk_pckts_unatt" id="walk_pckts_unatt" value=<?php echo '"' . $walk_pckts_unatt_val . '"'?> >
                                        </div>  



                                        <div style="text-align:center;"> 
                                        <hr>

                                        <button type="submit" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-check"></i></button>
                                        <p><strong>Submit Form</strong></p>

                                        <p><button type="reset" class="btn btn-warning btn-outline"><strong>Reset Form</strong></button></p>
                                        
                                        </div>


                                   </fieldset>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>