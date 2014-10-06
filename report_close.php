<?php

//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();

    $report = $_SESSION['report'];

    if($report == 'Close') {

    $canv_shifts_completed = $_SESSION["canv_shifts_completed"];
    $phone_shifts_completed = $_SESSION["phone_shifts_completed"];
    $canv_att_completed = $_SESSION["canv_att_completed"];
    $phone_att_completed = $_SESSION["phone_att_completed"];
    $ctv_collected  = $_SESSION["ctv_collected"];
    $canv_shifts_recruit_today = $_SESSION["canv_shifts_recruit_today"];
    $phone_shifts_recruit_today = $_SESSION["phone_shifts_recruit_today"];
    $canv_shifts_sched_tomorrow_1 = $_SESSION["canv_shifts_sched_tomorrow_1"];
    $canv_shifts_sched_tomorrow_2 = $_SESSION["canv_shifts_sched_tomorrow_2"];
    $canv_shifts_sched_tomorrow_3 = $_SESSION["canv_shifts_sched_tomorrow_3"];
    $phone_shifts_sched_tomorrow= $_SESSION["phone_shifts_sched_tomorrow"];
    $walk_pckts_unatt = $_SESSION["walk_pckts_unatt"] ;


    $canv_shifts_completed_val = $_SESSION["canv_shifts_completed"];
    $phone_shifts_completed_val = $_SESSION["phone_shifts_completed"];
    $canv_att_completed_val = $_SESSION["canv_att_completed"];
    $phone_att_completed_val = $_SESSION["phone_att_completed"];
    $ctv_collected_val = $_SESSION["ctv_collected"];
    $canv_shifts_recruit_today_val = $_SESSION["canv_shifts_recruit_today"];
    $phone_shifts_recruit_today_val = $_SESSION["phone_shifts_recruit_today"];
    $canv_shifts_sched_tomorrow_1_val = $_SESSION["canv_shifts_sched_tomorrow_1"];
    $canv_shifts_sched_tomorrow_2_val = $_SESSION["canv_shifts_sched_tomorrow_2"];
    $canv_shifts_sched_tomorrow_3_val = $_SESSION["canv_shifts_sched_tomorrow_3"];
    $phone_shifts_sched_tomorrow_val = $_SESSION["phone_shifts_sched_tomorrow"];
    $walk_pckts_unatt_val = $_SESSION["walk_pckts_unatt"] ;

    $_SESSION['error_cs'] = 1;

    }
    else{
    $canv_shifts_completed = "All canvass shifts completed today";
    $phone_shifts_completed = "All phone shifts completed today";
    $canv_att_completed = "All canv. attempts completed today";
    $phone_att_completed = "All phone attempts completed today";
    $ctv_collected  = "All CTV cards collected today";
    $canv_shifts_recruit_today = "Future shifts recruited today";
    $phone_shifts_recruit_today = "Future shifts recruited today";
    $canv_shifts_sched_tomorrow_1 = "How many scheduled for Shift 1?";
    $canv_shifts_sched_tomorrow_2 = "How many scheduled for Shift 2?";
    $canv_shifts_sched_tomorrow_3 = "How many scheduled for Shift 3?";
    $phone_shifts_sched_tomorrow = "Phone shifts scheduled for tomorrow";
    $walk_pckts_unatt = "Packets ready to be walked";   

    $canv_shifts_completed_val = "";
    $phone_shifts_completed_val = "";
    $canv_att_completed_val = "";
    $phone_att_completed_val = "";
    $ctv_collected_val = "";
    $canv_shifts_recruit_today_val = "";
    $phone_shifts_recruit_today_val = "";
    $canv_shifts_sched_tomorrow_1_val = "";
    $canv_shifts_sched_tomorrow_2_val = "";
    $canv_shifts_sched_tomorrow_3_val = "";
    $phone_shifts_sched_tomorrow_val = "";
    $walk_pckts_unatt_val = "";
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL Report - Close</title>

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
                <div class="report-panel panel panel-red">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>Staging Location - Closing Report</strong>      </h3>
                        <h5>Congrats on finishing the day. Close out your Staging Location below.</h5>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="report_close_redirect.php">
                            <fieldset>

                                            <?php
                                                $myc_id = $_SESSION['vanid'];
                                                $key = $_SESSION['key'];
                                                $key_check = $myc_id . time(); 
                                                $key_valid = $key + 1200;

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

                                        <!--Javascript functions to change text on button click-->
                                        <script>
                                        function changeopenlabel()
                                        {
                                         document.getElementById('open_label').innerHTML = <?php echo "'Thanks! " . $sl . " is now'";?>;
                                        }
                                        </script>
                                        <script>
                                        function changeopenstrong()
                                        {
                                         document.getElementById('open_strong').innerHTML = 'Closed';
                                        }
                                        </script>
                                        <script>
                                        function setopenvalue()
                                        {
                                         document.getElementById('open_status').value = 'Closed';
                                        }
                                        </script>
                                        <script>
                                        function solidbutton()
                                        {
                                         document.getElementById('close_btn').className = 'btn btn-lg btn-danger btn-circle';
                                        }
                                        </script>                                        


                                        <?php 
                                        if(isset($_SESSION['error_cs'])) {

                                            if($_SESSION['error_cs'] == 1) {
                                            $close_label_text = $sl . " is currently";
                                            $close_strong_text = "Closed";
                                            $btn_class = "btn btn-lg btn-danger btn-circle";
                                            }
                                            else{
                                            $close_label_text = "Click Below to Close Your SL";
                                            $close_strong_text = "";
                                            $btn_class = "btn btn-lg btn-outline btn-danger btn-circle";
                                            }
                                        }
                                        else {
                                            $close_label_text = "Click Below to Close Your SL";
                                            $close_strong_text = "";
                                            $btn_class = "btn btn-lg btn-outline btn-danger btn-circle";
                                        }
                                        session_write_close();
                                        ?>

                                            <hr>  


                                        <div style="text-align:center;">
                                        <h4><strong>Today's Cumulative Voter Contact</strong>         </h4>
                                        </div> 

                                        <div class="form-group">
                                            <br><label>Total Canvass Shifts Completed</label></br>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $canv_shifts_completed . '"' ?> type="number" max="200" name="canv_shifts_completed" id="canv_shifts_completed" value= <?php echo '"' . $canv_shifts_completed_val . '"' ?> >
                                        </div>      
                                        <div class="form-group">
                                            <label>Total Canvass Attempts Completed</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $canv_att_completed . '"' ?> type="number" max="10000" name="canv_att_completed" id="canv_shifts_completed" value= <?php echo '"' . $canv_att_completed_val . '"' ?> >
                                        </div>
                                        <div class="form-group">
                                            <label>Total Phone Shifts Completed</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $phone_shifts_completed . '"' ?> type="number" max="200" name="phone_shifts_completed" id="phone_shifts_completed" value= <?php echo '"' . $phone_shifts_completed_val . '"' ?> >
                                        </div>
                                        <div class="form-group">
                                            <label style="display:inline">Total Phone Attempts Completed</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $phone_att_completed . '"' ?> type="number" max="10000" name="phone_att_completed" id="phone_shifts_completed" value= <?php echo '"' . $phone_att_completed_val . '"' ?> >
                                        </div>      

                                        <div class="form-group">
                                            <label>Total Commit to Vote Cards Collected</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $ctv_collected . '"' ?> type="number" max="5000" name="ctv_collected" id="ctv_collected">
                                        </div>   
                                        
                                        <hr>
                                        

                                        <div style="text-align:center;">
                                        <h4><strong>Volunteer Recruitment</strong>         </h4>
                                        </div>                                   
                                        <div class="form-group" style="text-align:center;">
                                            <br><label>Canvass Shifts Recruited Today</label></br>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $canv_shifts_recruit_today . '"' ?> type="number" max="500" name="canv_shifts_recruit_today" id="canv_shifts_recruit_today" value=<?php echo '"' . $canv_shifts_recruit_today_val . '"'?> >
                                        </div>
                                        <div class="form-group" style="text-align:center;">
                                            <label>Phone Shifts Recruited Today</label>
                                            <input class="form-control" style="text-align:center;" placeholder=<?php echo '"' . $phone_shifts_recruit_today . '"' ?> type="number" max="500" name="phone_shifts_recruit_today" id="phone_shifts_recruit_today" value=<?php echo '"' . $phone_shifts_recruit_today_val . '"'?> >
                                        </div>  


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
                                        </div> 
                                        <div class="form-group" style="text-align: center;">
                                            <label><b id="open_label"><?php echo $close_label_text; ?></b></label>
                                        </div>

                                            <div class="button" style="text-align: center;">
                                                <label>
                                                    <?php echo "<button type='button' id='close_btn' class='" . $btn_class . "' value='Closed' onclick='changeopenlabel(); changeopenstrong(); setopenvalue(); solidbutton();'><i class='fa fa-minus'></i></button>" ?>
                                                    <p><h5><strong id="open_strong"><?php echo $close_strong_text; ?></strong></h5></p>
                                                    <input class="form-control" type="hidden" name="open_status" id="open_status" value="">
                                                </label>
                                            </div>  
                                        
                                        <hr>
                                       
                                        <br>
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