<?php

//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL Report - Complete</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap_bill.css" rel="stylesheet">

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
                <div class="report-panel panel panel-primary">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>Thanks For Reporting In!</strong>      </h3>
                        <h5>Double check your entry below.</h5>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="login_error.php">
                            <fieldset>
                            <?php
                            session_start();
                                $myc_id = $_SESSION['vanid'];
                                $key = $_SESSION['key'];
                                $key_check = $myc_id . time(); 
                                $key_valid = $key + 1200;
                            session_write_close();

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

                                //Set Database Connection
                                $db = mysqli_connect("domain", "user", "pw", "database")
                                                or die("Can't connect to database".mysql_error());

                                $table_name = 'master_db.master_metrics_table';

                                date_default_timezone_set('America/Chicago');
                                $time = localtime(time(),true);

                                $timestamp = sprintf("%02s",$time['tm_hour']) . ":" . sprintf("%02s",$time['tm_min']) . ":" . sprintf("%02s",$time['tm_sec']);
                                $date = "2014-" . sprintf("%02s",$time['tm_mon']+1) . "-" . sprintf("%02s",$time['tm_mday']);
                                $wday = $time['tm_wday'];

                                session_start();
                                $staging_location = $_SESSION["staging_location"];
                                $shift = $_SESSION["shift"];
                                $vols_phoning_snapshot = $_SESSION["vols_phoning_snapshot"];
                                $vols_knocking_snapshot = $_SESSION["vols_knocking_snapshot"];
                                $vols_returned_snapshot = $_SESSION["vols_returned_snapshot"];
                                $walk_pckts_out = $_SESSION["walk_pckts_out"];
                                $canv_shifts_completed = $_SESSION["canv_shifts_completed"];
                                $phone_shifts_completed = $_SESSION["phone_shifts_completed"];
                                $canv_att_completed = $_SESSION["canv_att_completed"];
                                $phone_att_completed = $_SESSION["phone_att_completed"];
                                $ctv_collected = $_SESSION["ctv_collected"];
                                $walk_pckts_unatt = $_SESSION["walk_pckts_unatt"] ;
                                session_write_close();

                                //Grab shift sched entries from the opening shift (or via the most recent report in which this same query was used)
                                    $result = mysqli_query($db, 
                                        "select canv_shifts_sched_today_1
                                                , canv_shifts_sched_today_2
                                                , canv_shifts_sched_today_3
                                                , phone_shifts_sched_today

                                        from master_db.master_metrics_table        
                                        where staging_location = '" . $staging_location . "'
                                        and date = '" . $date . "'
                                        order by time desc
                                        limit 1"
                                        );

                                        if (!$result) {
                                            echo "An error occurred.\n";
                                        exit;
                                        }
                                    $result_fetch = mysqli_fetch_array($result,MYSQL_ASSOC);
                                    $canv_shifts_sched_today_1 = $result_fetch["canv_shifts_sched_today_1"];
                                    $canv_shifts_sched_today_2 = $result_fetch["canv_shifts_sched_today_2"];
                                    $canv_shifts_sched_today_3 = $result_fetch["canv_shifts_sched_today_3"];
                                    $phone_shifts_sched_today = $result_fetch["phone_shifts_sched_today"];

                                //display what was entered
                                echo "<hr>";
                                echo "<pre><strong>SL:</strong> " . $staging_location . "</pre>";
                                echo "<pre><strong>Walk Packets Out:</strong> " . $walk_pckts_out . "</pre>";
                                echo "<pre><strong>Canvassers Out:</strong> " . $vols_knocking_snapshot . "</pre>";
                                echo "<pre><strong>Canvassers Returned:</strong> " . $vols_returned_snapshot . "</pre>";
                                echo "<pre><strong>Volunteers Making Calls:</strong> " . $vols_phoning_snapshot . "</pre>";
                                echo "<pre><strong>Canvass Shifts Completed:</strong> " . $canv_shifts_completed . "</pre>";
                                echo "<pre><strong>Canvass Attempts Completed:</strong> " . $canv_att_completed . "</pre>";
                                echo "<pre><strong>Phone Shifts Completed:</strong> " . $phone_shifts_completed . "</pre>";
                                echo "<pre><strong>Phone Attempts Completed:</strong> " . $phone_att_completed . "</pre>";
                                echo "<pre><strong>CTV Cards Collected:</strong> " . $ctv_collected . "</pre>";
                                echo "<pre><strong>Unattempted Walk Packets:</strong> " . $walk_pckts_unatt . "</pre>";

                                //put new data into an array
                                $new_line = array('staging_location' => $staging_location, 
                                                    'open_status' => 'Open',
                                                    'canv_shifts_sched_today_1' => $canv_shifts_sched_today_1,
                                                    'canv_shifts_sched_today_2' => $canv_shifts_sched_today_2,
                                                    'canv_shifts_sched_today_3' => $canv_shifts_sched_today_3, 
                                                    'phone_shifts_sched_today' => $phone_shifts_sched_today,
                                                    'walk_pckts_unatt' => $walk_pckts_unatt, 
                                                    'myc_id' => $myc_id, 
                                                    'date' => $date, 
                                                    'time' => $timestamp, 
                                                    'day_of_week' => $wday,
                                                    'vols_knocking_snapshot' => $vols_knocking_snapshot,
                                                    'vols_returned_snapshot' => $vols_returned_snapshot,
                                                    'vols_phoning_snapshot' => $vols_phoning_snapshot,
                                                    'walk_pckts_out' => $walk_pckts_out,
                                                    'canv_shifts_completed' => $canv_shifts_completed,
                                                    'phone_shifts_completed' => $phone_shifts_completed,
                                                    'canv_att_completed' => $canv_att_completed,
                                                    'phone_att_completed' => $phone_att_completed,
                                                    'canv_shifts_recruit_today' => 0,
                                                    'phone_shifts_recruit_today' => 0,
                                                    'canv_shifts_sched_tomorrow_1' => 0,
                                                    'canv_shifts_sched_tomorrow_2' => 0,
                                                    'canv_shifts_sched_tomorrow_3' => 0,
                                                    'phone_shifts_sched_tomorrow' => 0,
                                                    'ctv_collected' => $ctv_collected, 
                                                    'report' => $shift   
                                                    );



                                //create 'insert into' query for mysql
                                $insert_q = "insert into " . $table_name . 
                                                    "(staging_location, 
                                                        open_status, 
                                                        canv_shifts_sched_today_1, 
                                                        canv_shifts_sched_today_2, 
                                                        canv_shifts_sched_today_3, 
                                                        phone_shifts_sched_today,
                                                        walk_pckts_unatt,
                                                        myc_id,
                                                        date,
                                                        time,
                                                        day_of_week,
                                                        vols_knocking_snapshot,
                                                        vols_returned_snapshot,
                                                        vols_phoning_snapshot,
                                                        walk_pckts_out,
                                                        canv_shifts_completed,
                                                        phone_shifts_completed,
                                                        canv_att_completed,
                                                        phone_att_completed,
                                                        canv_shifts_recruit_today,
                                                        phone_shifts_recruit_today,
                                                        canv_shifts_sched_tomorrow_1,
                                                        canv_shifts_sched_tomorrow_2,
                                                        canv_shifts_sched_tomorrow_3,
                                                        phone_shifts_sched_tomorrow,
                                                        ctv_collected,
                                                        report)
                                                values ('"
                /*staging_location*/                    . $new_line['staging_location'] . "', '"
                /*open_status*/                         . $new_line['open_status'] . "', '"
                /*canv_shifts_sched_today_1*/           . $new_line['canv_shifts_sched_today_1'] . "', '"
                /*canv_shifts_sched_today_2*/           . $new_line['canv_shifts_sched_today_2'] . "', '"
                /*canv_shifts_sched_today_3*/           . $new_line['canv_shifts_sched_today_3'] . "', '"
                /*phone_shifts_sched_today*/            . $new_line['phone_shifts_sched_today'] . "', '"
                /*walk_packets_unatt*/                  . $new_line['walk_pckts_unatt'] . "', '"
                /*myc_id*/                              . $new_line['myc_id'] . "', '"
                /*date*/                                . $new_line['date'] . "', '"
                /*time*/                                . $new_line['time'] . "', '"
                /*day_of_week*/                         . $new_line['day_of_week'] . "', '"
                /*vols_knocking_snapshot*/              . $new_line['vols_knocking_snapshot'] . "', '"
                /*vols_returned_snapshot*/              . $new_line['vols_returned_snapshot'] . "', '"
                /*vols_phoning_snapshot*/               . $new_line['vols_phoning_snapshot'] . "', '"
                /*walk_pckts_out*/                      . $new_line['walk_pckts_out'] . "', '"
                /*canv_shifts_completed*/               . $new_line['canv_shifts_completed'] . "', '"
                /*phone_shifts_completed*/              . $new_line['phone_shifts_completed'] . "', '"
                /*canv_att_completed*/                  . $new_line['canv_att_completed'] . "', '"
                /*phone_att_completed*/                 . $new_line['phone_att_completed'] . "', '"
                /*canv_shifts_recruit_today*/           . $new_line['canv_shifts_recruit_today'] . "', '"
                /*phone_shifts_recruit_today*/          . $new_line['phone_shifts_recruit_today'] . "', '"
                /*canv_shifts_sched_tomorrow_1*/        . $new_line['canv_shifts_sched_tomorrow_1'] . "', '"
                /*canv_shifts_sched_tomorrow_2*/        . $new_line['canv_shifts_sched_tomorrow_2'] . "', '"
                /*canv_shifts_sched_tomorrow_3*/        . $new_line['canv_shifts_sched_tomorrow_3'] . "', '"
                /*phone_shifts_sched_tomorrow*/         . $new_line['phone_shifts_sched_tomorrow'] . "', '"
                /*ctv_collected*/                       . $new_line['ctv_collected'] . "', '"
                /*report*/                              . $new_line['report']
                                                        . "')";



                //execute 'insert into' query
                mysqli_query($db, $insert_q)
                            or die ("Looks like we're experiencing technical difficulties. <a href='javascript:history.go(-1)'>Go back to try again</a>. If that doesn't work, contact your organizer.".mysql_error());




                                ?>
                                <div style="text-align: center;">
                                    <hr>
                                <p>Not what you meant to enter? No sweat!</p> 
                                <p>We'll only use the info from your most recent report, so if you need to go back and make an update, go for it!</p>
                                <p><a href="javascript:history.go(-1)" style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-warning btn-primary"><strong>Edit Report</strong></button></a></p>
                                <hr>
                                <p><a href = pass_to_home.php style="color: #FFFFFF"><button type="button" class="btn btn-default btn-primary"><strong>Home</strong></button></a></p>


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