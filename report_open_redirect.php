<?php

//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
    $myc_id = $_SESSION['vanid'];
    $key = $_SESSION['key'];
    $staging_location = $_SESSION['sl']; 

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL Report - Error</title>

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
                <div class="report-panel panel panel-default">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>One Moment...</strong>      </h3>
                        
                    </div>
                    <div class="panel-body">
                        <h4 style="text-align:center;">We're beaming your info to Wendy HQ in Fort Worth.</h4>
                        <h4 style="text-align:center;">Sit tight!</h4>
                        <form role="form" id="error_form" method="post" action="report_open.php">
                            <fieldset>

                            <?php


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

                                else {

                                $db = mysqli_connect("domain", "user", "pw", "database")
                                                or die("Can't connect to database".mysql_error());

                                $required = array("sl", "open_status", "canv_shifts_sched_today_1", "canv_shifts_sched_today_2", "canv_shifts_sched_today_3", "phone_shifts_sched_today", "walk_pckts_unatt");

                                function isset_or(&$check, $alternate = NULL) 
                                { 
                                    return (isset($check)) ? $check : $alternate; 
                                } 

                                $open_status = mysqli_real_escape_string($db, isset_or($_POST['open_status'], NULL));
                                $canv_shifts_sched_today_1 = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_sched_today_1'], NULL));
                                $canv_shifts_sched_today_2 = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_sched_today_2'], NULL));
                                $canv_shifts_sched_today_3 = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_sched_today_3'], NULL));
                                $phone_shifts_sched_today = mysqli_real_escape_string($db, isset_or($_POST['phone_shifts_sched_today'], NULL));
                                $walk_pckts_unatt = mysqli_real_escape_string($db, isset_or($_POST['walk_pckts_unatt'], NULL));

                                if( $canv_shifts_sched_today_1 == '0') {
                                    $canv_shifts_sched_today_1 = $canv_shifts_sched_today_1;
                                }
                                else if($canv_shifts_sched_today_1 !== NULL) {
                                    $canv_shifts_sched_today_1 = (int) $canv_shifts_sched_today_1;
                                }

                                if( $canv_shifts_sched_today_2 == '0') {
                                    $canv_shifts_sched_today_2 = $canv_shifts_sched_today_2;
                                }
                                else if($canv_shifts_sched_today_2 !== NULL) {
                                    $canv_shifts_sched_today_2 = (int) $canv_shifts_sched_today_2;
                                }

                                if( $canv_shifts_sched_today_3 == '0') {
                                    $canv_shifts_sched_today_3 = $canv_shifts_sched_today_3;
                                }
                                else if($canv_shifts_sched_today_3 !== NULL) {
                                    $canv_shifts_sched_today_3 = (int) $canv_shifts_sched_today_3;
                                }                          

                                if( $phone_shifts_sched_today == '0') {
                                    $phone_shifts_sched_today = $phone_shifts_sched_today;
                                }
                                else if($phone_shifts_sched_today !== NULL) {
                                    $phone_shifts_sched_today = (int) $phone_shifts_sched_today;
                                }

                                if( $walk_pckts_unatt == '0') {
                                    $walk_pckts_unatt = $walk_pckts_unatt;
                                }
                                else if($walk_pckts_unatt !== NULL) {
                                    $walk_pckts_unatt = (int) $walk_pckts_unatt;
                                }


                                $error = "";
                                $error_sl = "";
                                $error_os = "";
                                $error_cs1 = "";
                                $error_cs2 = "";
                                $error_cs3 = "";
                                $error_ps = "";
                                $error_wp = "";
                                $error_pp = "";
                                $error_lc = "";
                                $error_wpo = "";

                                $error_csi = "";
                                $error_psi = "";
                                $error_wpi = "";
                                $error_ppi = "";
                                $error_lci = "";


                                if($staging_location == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_sl = "<p><strong>Staging Location: </strong><em>Any chance you forgot to select your Staging Location?</em></p>";
                                }


                                if($open_status == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_os = "<p><strong>Status: </strong>Let us know you're open for business by hitting that \"Open!\" button.</p>" ;
                                }


                                if($canv_shifts_sched_today_1 == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs1 = "<p><strong>Canvass Shifts Scheduled - 9:00a: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($canv_shifts_sched_today_1 == 0) {  
                                }
                                elseif(!is_int($canv_shifts_sched_today_1)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs1 = "<p><strong>Canvass Shifts Scheduled - 9:00a: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }
                                elseif($canv_shifts_sched_today_1 < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs1 = "<p><strong>Canvass Shifts Scheduled - 9:00a: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }


                                if($canv_shifts_sched_today_2 == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs2 = "<p><strong>Canvass Shifts Scheduled - 12:30p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($canv_shifts_sched_today_2 == 0) {  
                                }
                                elseif(!is_int($canv_shifts_sched_today_2)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs2 = "<p><strong>Canvass Shifts Scheduled - 12:30p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }
                                elseif($canv_shifts_sched_today_2 < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs2 = "<p><strong>Canvass Shifts Scheduled - 12:30p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }



                                if($canv_shifts_sched_today_3 == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs3 = "<p><strong>Canvass Shifts Scheduled - 4:00p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($canv_shifts_sched_today_3 == 0) {  
                                }
                                elseif(!is_int($canv_shifts_sched_today_3)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs3 = "<p><strong>Canvass Shifts Scheduled - 4:00p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }
                                elseif($canv_shifts_sched_today_3 < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cs3 = "<p><strong>Canvass Shifts Scheduled - 4:00p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }


                                if($phone_shifts_sched_today == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_ps = "<p><strong>Phone Shifts Scheduled: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($phone_shifts_sched_today == 0) {
                                }
                                elseif (!is_int($phone_shifts_sched_today)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_ps = "<p><strong>Phone Shifts Scheduled: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif ($phone_shifts_sched_today <0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_ps = "<p><strong>Phone Shifts Scheduled: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }


                                if($walk_pckts_unatt == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wp = "<p><strong>Walk Packets Available: </strong><em>Double check you entered a whole number (zero works)!</em></p>";
                                }
                                elseif($walk_pckts_unatt == 0) {
                                }
                                elseif(!is_int($walk_pckts_unatt)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wp = "<p><strong>Walk Packets Available: </strong><em>Double check you entered a whole number (zero works)!</em></p>";
                                }
                                elseif($walk_pckts_unatt < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wp = "<p><strong>Walk Packets Available: </strong><em>Double check you entered a whole number (zero works)!</em></p>";
                                }


                                if($error == "") {


                                $_SESSION["staging_location"] = $staging_location;
                                $_SESSION["open_status"] = $open_status;
                                $_SESSION["canv_shifts_sched_today_1"] = $canv_shifts_sched_today_1;
                                $_SESSION["canv_shifts_sched_today_2"] = $canv_shifts_sched_today_2;
                                $_SESSION["canv_shifts_sched_today_3"] = $canv_shifts_sched_today_3;
                                $_SESSION["phone_shifts_sched_today"] = $phone_shifts_sched_today;
                                $_SESSION["walk_pckts_unatt"] = $walk_pckts_unatt;


                                if($error_os == '') {
                                        $_SESSION['error_os'] = 1;
                                    }
                                    else {
                                        $_SESSION['error_os'] = 0;
                                    }



                                    echo '<meta http-equiv="refresh" content="0.5;url=result_open.php">';
          
                                }
                                else {


                                    if($error_os == '') {
                                        $_SESSION['error_os'] = 1;

                                    }
                                    else {
                                        $_SESSION['error_os'] = 0;
                                    }
 

                                    $_SESSION['error_sl'] = $error_sl;
                                    $_SESSION['error_os'] = $error_os;
                                    $_SESSION['error_cs1'] = $error_cs1;
                                    $_SESSION['error_cs2'] = $error_cs2;
                                    $_SESSION['error_cs3'] = $error_cs3;
                                    $_SESSION['error_ps'] = $error_ps;
                                    $_SESSION['error_wp'] = $error_wp;

                                    echo '<meta http-equiv="refresh" content="0.5;url=report_open_error.php">';

                                }

                            }

                            session_write_close();
                                ?>

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