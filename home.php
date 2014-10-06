<?php
//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();

$php_self = $_SERVER['PHP_SELF'];
$myc_id = $_SESSION['vanid'];
$key = $_SESSION['key'];

session_write_close();

$db = mysqli_connect("domain", "user", "pw", "database")
or die("Can't connect to database".mysql_error());

$name_result = mysqli_query($db, "select * from master_db.user_table where vanid = " . $myc_id );

$nresult_fetch = mysqli_fetch_array($name_result,MYSQL_ASSOC);
$first_name = $nresult_fetch["firstname"]; 


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap_bill.css"rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
    a:hover {
        text-decoration: none;
    }
    </style>
</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="home-panel panel panel-default">
                    <div class="panel-heading" style="text-align: center;">
                        <h3 ><strong>Staging Location Soft Reporting Tool</strong>      </h3>
                        <h5 >Hey <?php echo $first_name ?>! Select your staging location and choose a report below.</h5>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action=><?php $php_self ?>
                            <fieldset>
                                            <?php

                                                $db = mysqli_connect("domain", "user", "pw", "database")
                                                or die("Can't connect to database".mysql_error());

                                            //session_start();
                                                //$myc_id = $_SESSION['vanid'];
                                                //$key = $_SESSION['key'];
                                                $key_check = $myc_id . time(); 
                                                $key_valid = $key + 1200;
                                            //session_write_close();


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

                                                ob_start();
                                                session_start();
                                                if (isset($_POST["sl"])) {
                                                $sls = mysqli_real_escape_string($db, $_POST["sl"]);
                                                $_SESSION['sl'] = $sls;
                                                $sl = $_SESSION['sl'];
                                                session_write_close();
                                                ob_flush();

                                                }
                                                else {
                                                    $sl = "";
                                                }
                                                    
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


                                            
                                            echo "<hr>";
                                            echo "<div style=\"text-align:center;\">";
                                            echo "<h4><strong>Select Your SL</strong> </h4>";
                                            echo "</div>";
                                            echo "<div class=\"form-group\" style=\"text-align: center;\">";
                                            echo "<select class=\"form-control\" id=\"sl\" name=\"sl\" onchange=\"this.form.submit()\">";
                                                

                                                    
                                                    echo "<option value=" . $sl . "selected=\"selected\">". $sl . "</option>";

                                                    //for each row that was returned, grab the array for that row
                                                    //for the SLs that are in the region of the user, assign the staging location name to the variable
                                                        //and then echo the variable as the option value for the dropdown
                                                         while ($row = mysqli_fetch_array($result)) {
                                                            if ($row['region'] = $region) {
                                                                if ($row['sl'] != $sl) {
                                                                echo "<option value= '" . $row['sl'] . "'>" . $row['sl'] . "</option>";
                                                                }
                                                                else {pass;}
                                                            }
                                                            else {pass;}
                                                         }                               

                                                    

                                        echo "</select>";

                                       echo "</div>";




 
                                echo '<div style="text-align:center;">';
                                if ($sl == '') {

                               }

                                else {
                                echo "<hr>";
                                echo '<div style="text-align:center;">';

                                    date_default_timezone_set('America/Chicago');
                                    $time = localtime(time(),true);

                                    $timestamp = sprintf("%02s",$time['tm_hour']) . ":" . sprintf("%02s",$time['tm_min']) . ":" . sprintf("%02s",$time['tm_sec']);
                                    $date = "2014-" . sprintf("%02s",$time['tm_mon']+1) . "-" . sprintf("%02s",$time['tm_mday']);
                                    $wday = $time['tm_wday'];
                                    

                                    $sl_q = mysqli_query($db, "select distinct staging_location from master_db.master_metrics_table where date='" . $date . "'");

                                    $sl_check = array('Placeholder');


                                                    //for each row that was returned, grab the array for that row, assign the staging location name to the variable
                                                        //and then echo the variable as the option value for the dropdown
                                                    while ($row = mysqli_fetch_array($sl_q)) {
                                                            $variable = $row['staging_location'];
                                                            $sl_check[] = $variable;
                                                            
                                                            }


                                    if (in_array($sl, $sl_check) == false) {
                                        $report = "First";
                                    }
                                    else{

                                                $result = mysqli_query($db, 
                                                                "select *
                                                                from master_db.master_metrics_table
                                                                where staging_location = '" . $sl . "'
                                                                and date = '" . $date . "'
                                                                order by time desc
                                                                limit 1");

                                        if (!$result) {
                                            echo "An error occurred.\n";
                                        exit;
                                        }


                                    $result_fetch = mysqli_fetch_array($result);
                                    $report = $result_fetch["report"]; 

                                        }
                                
                                
                                if ($report == "First") {

                                    date_default_timezone_set('America/Chicago');
                                    $time = localtime(time(),true);

                                    $timestamp = sprintf("%02s",$time['tm_hour']) . ":" . sprintf("%02s",$time['tm_min']) . ":" . sprintf("%02s",$time['tm_sec']);
                                    $hour = (int)$time['tm_hour'];

                                    if(substr($sl, 0, 2) == '18') {                                    

                                            if((int)$hour < 18) {

                                                    $_SESSION["report"] = $report;
                                                    echo '<a href="report_open.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-success btn-block">Open Your SL</button></a>';
                                            
                                            }
                                            else {

                                                    $_SESSION["report"] = $report;
                                                    echo '<a href="report_precheck.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-info btn-block">Evening Pre-Check</button></a>';

                                            }
                                    }

                                    else{

                                            if((int)$hour < 17) {

                                                    $_SESSION["report"] = $report;
                                                    echo '<a href="report_open.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-success btn-block">Open Your SL</button></a>';
                                            
                                            }
                                            else {

                                                    $_SESSION["report"] = $report;
                                                    echo '<a href="report_precheck.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-info btn-block">Evening Pre-Check</button></a>';

                                            }
                                    }

                                }

                                elseif ($report == "Precheck") {

                                echo '<a href="report_precheck.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-info btn-block">Edit Pre-Check</button></a>';

                                session_start();
                                $_SESSION["canv_shifts_sched_tomorrow_1"] = $result_fetch["canv_shifts_sched_tomorrow_1"];
                                $_SESSION["canv_shifts_sched_tomorrow_2"] = $result_fetch["canv_shifts_sched_tomorrow_2"];
                                $_SESSION["canv_shifts_sched_tomorrow_3"] = $result_fetch["canv_shifts_sched_tomorrow_3"];
                                $_SESSION["phone_shifts_sched_tomorrow"] = $result_fetch["phone_shifts_sched_tomorrow"];
                                $_SESSION["walk_pckts_unatt"] = $result_fetch["walk_pckts_unatt"];
                                $_SESSION["report"] = $report;
                                session_write_close();

                                }

                                elseif ($report == "Open") {

                                echo '<a href="report_open.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-success btn-block">Edit Open Report</button></a>';
                                echo '<a href = "report_intraday.php" style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-primary btn-block">Shift Report</button></a>';
                                session_start();
                                $_SESSION["canv_shifts_sched_today_1"] = $result_fetch["canv_shifts_sched_today_1"];
                                $_SESSION["canv_shifts_sched_today_2"] = $result_fetch["canv_shifts_sched_today_2"];
                                $_SESSION["canv_shifts_sched_today_3"] = $result_fetch["canv_shifts_sched_today_3"];
                                $_SESSION["phone_shifts_sched_today"] = $result_fetch["phone_shifts_sched_today"];
                                $_SESSION["walk_pckts_unatt"] = $result_fetch["walk_pckts_unatt"];
                                $_SESSION["report"] = $report;
                                session_write_close();

                                }

                                elseif ($report == "Shift 1") {
                                    

                                echo '<a href = "report_intraday.php" style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-primary btn-block">Shift Report</button></a>';
                                echo '<a href="report_close.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-danger btn-block">Close Your SL</button></a>';

                                }

                                elseif ($report == "Shift 2") {
                                    

                                echo '<a href = "report_intraday.php" style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-primary btn-block">Shift Report</button></a>';
                                echo '<a href="report_close.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-danger btn-block">Close Your SL</button></a>';

                                }

                                elseif ($report == "Shift 3") {
                                    

                                echo '<a href = "report_intraday.php" style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-primary btn-block">Shift Report</button></a>';
                                echo '<a href="report_close.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-danger btn-block">Close Your SL</button></a>';

                                }

                                elseif ($report == "Close") {
                                    
                                echo '<a href="report_close.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-danger btn-block">Edit Closing Report</button></a>'; 
                                session_start();
                                    $_SESSION["canv_shifts_completed"] = $result_fetch["canv_shifts_completed"];
                                    $_SESSION["phone_shifts_completed"] = $result_fetch["phone_shifts_completed"];
                                    $_SESSION["canv_att_completed"] = $result_fetch["canv_att_completed"];
                                    $_SESSION["phone_att_completed"] = $result_fetch["phone_att_completed"];
                                    $_SESSION["ctv_collected"] = $result_fetch["ctv_collected"];
                                    $_SESSION["canv_shifts_recruit_today"] = $result_fetch["canv_shifts_recruit_today"];
                                    $_SESSION["phone_shifts_recruit_today"] = $result_fetch["phone_shifts_recruit_today"];
                                    $_SESSION["canv_shifts_sched_tomorrow_1"] = $result_fetch["canv_shifts_sched_tomorrow_1"];
                                    $_SESSION["canv_shifts_sched_tomorrow_2"] = $result_fetch["canv_shifts_sched_tomorrow_2"];
                                    $_SESSION["canv_shifts_sched_tomorrow_3"] = $result_fetch["canv_shifts_sched_tomorrow_3"];
                                    $_SESSION["phone_shifts_sched_tomorrow"] = $result_fetch["phone_shifts_sched_tomorrow"];
                                    $_SESSION["walk_pckts_unatt"] = $result_fetch["walk_pckts_unatt"];
                                    $_SESSION["report"] = $report;
                                session_write_close();

                                }

                                }
                                ?>

                                <hr>

                                <?php

                                $role_result = mysqli_query($db, "select * from master_db.user_table where vanid = " . $myc_id);
                                                $role_row =mysqli_fetch_array($role_result, MYSQL_ASSOC);
                                                 
                                                if($role_row['role'] == 'FO') {                     
                                                }
                                                else {

                                                   echo '<a href="activity_report.php" style="color: #FFFFFF" ><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-line-chart"></i></button></a>';
                                                   echo '<p><strong>Take me to Reports</strong></p>'; 
                                                }


                                ?>
                                <a href="login.php" style="color: #FFFFFF" ><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-sign-out"></i></button></a>
                                <p><strong>Log Out</strong></p>                                
                                <hr>
								</div>	
                            </fieldset>
                        </form>
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


