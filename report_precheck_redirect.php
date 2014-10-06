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

                                $required = array("sl", "vols_phoning_snapshot", "walk_pckts_out", "canv_shifts_completed", "phone_shifts_completed",
                                                    "canv_att_completed", "phone_att_completed", "walk_pckts_completed", "walk_pckts_unatt", "ctv_collected", "lit_count");

                                function isset_or(&$check, $alternate = NULL) 
                                { 
                                    return (isset($check)) ? $check : $alternate; 
                                } 
                                
                                $staging_location = $_SESSION['sl'];

                                $canv_shifts_sched_tomorrow_1 = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_sched_tomorrow_1'], NULL));
                                $canv_shifts_sched_tomorrow_2 = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_sched_tomorrow_2'], NULL));
                                $canv_shifts_sched_tomorrow_3 = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_sched_tomorrow_3'], NULL));
                                $phone_shifts_sched_tomorrow = mysqli_real_escape_string($db, isset_or($_POST['phone_shifts_sched_tomorrow'], NULL));
                                $walk_pckts_unatt = mysqli_real_escape_string($db, isset_or($_POST['walk_pckts_unatt'], NULL));

                            
                                if( $canv_shifts_sched_tomorrow_1 == '0') {
                                    $canv_shifts_sched_tomorrow_1 = $canv_shifts_sched_tomorrow_1;
                                }
                                else if($canv_shifts_sched_tomorrow_1 !== NULL) {
                                    $canv_shifts_sched_tomorrow_1 = (int) $canv_shifts_sched_tomorrow_1;
                                }

                                if( $canv_shifts_sched_tomorrow_2 == '0') {
                                    $canv_shifts_sched_tomorrow_2 = $canv_shifts_sched_tomorrow_2;
                                }
                                else if($canv_shifts_sched_tomorrow_2 !== NULL) {
                                    $canv_shifts_sched_tomorrow_2 = (int) $canv_shifts_sched_tomorrow_2;
                                }

                                if( $canv_shifts_sched_tomorrow_3 == '0') {
                                    $canv_shifts_sched_tomorrow_3 = $canv_shifts_sched_tomorrow_3;
                                }
                                else if($canv_shifts_sched_tomorrow_3 !== NULL) {
                                    $canv_shifts_sched_tomorrow_3 = (int) $canv_shifts_sched_tomorrow_3;
                                }

                                if( $phone_shifts_sched_tomorrow == '0') {
                                    $phone_shifts_sched_tomorrow = $phone_shifts_sched_tomorrow;
                                }
                                else if($phone_shifts_sched_tomorrow !== NULL) {
                                    $phone_shifts_sched_tomorrow = (int) $phone_shifts_sched_tomorrow;
                                }

                                if( $walk_pckts_unatt == '0') {
                                    $walk_pckts_unatt = $walk_pckts_unatt;
                                }
                                else if($walk_pckts_unatt !== NULL) {
                                    $walk_pckts_unatt = (int) $walk_pckts_unatt;
                                }

                              
                                $error = "";
                                $error_sl = "";
                                $error_csr = "";
                                $error_psr = "";
                                $error_cst1 = "";
                                $error_cst2 = "";
                                $error_cst3 = "";
                                $error_pst = "";
                                $error_wpu = "";


                                if($staging_location == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_sl = "<p><strong>Staging Location: </strong><em>Any chance you forgot to select your Staging Location?</em></p>";
                                }

                               
                                if($walk_pckts_unatt == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wpu = "<p><strong>Walk Packets Available: </strong><em>Double check you entered a whole number (zero works)!</em></p>";
                                }
                                elseif($walk_pckts_unatt == 0) {
                                }
                                elseif(!is_int($walk_pckts_unatt)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wpu = "<p><strong>Walk Packets Available: </strong><em>Double check you entered a whole number (zero works)!</em></p>";
                                }
                                elseif($walk_pckts_unatt < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wpu = "<p><strong>Walk Packets Available: </strong><em>Double check you entered a whole number (zero works)!</em></p>";
                                }


                                
                                if($canv_shifts_sched_tomorrow_1 == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst1 = "<p><strong>Canvass Shifts Tomorrow - 9:00a: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($canv_shifts_sched_tomorrow_1 == 0) {  
                                }
                                elseif(!is_int($canv_shifts_sched_tomorrow_1)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst1 = "<p><strong>Canvass Shifts Tomorrow - 9:00a: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }
                                elseif($canv_shifts_sched_tomorrow_1 < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst1 = "<p><strong>Canvass Shifts Tomorrow - 9:00a: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }


                                if($canv_shifts_sched_tomorrow_2 == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst2 = "<p><strong>Canvass Shifts Tomorrow - 12:30p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($canv_shifts_sched_tomorrow_2 == 0) {  
                                }
                                elseif(!is_int($canv_shifts_sched_tomorrow_2)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst2 = "<p><strong>Canvass Shifts Tomorrow - 12:30p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }
                                elseif($canv_shifts_sched_tomorrow_2 < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst2 = "<p><strong>Canvass Shifts Tomorrow - 12:30p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }



                                if($canv_shifts_sched_tomorrow_3 == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst3 = "<p><strong>Canvass Shifts Tomorrow - 4:00p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($canv_shifts_sched_tomorrow_3 == 0) {  
                                }
                                elseif(!is_int($canv_shifts_sched_tomorrow_3)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst3 = "<p><strong>Canvass Shifts Tomorrow - 4:00p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }
                                elseif($canv_shifts_sched_tomorrow_3 < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cst3 = "<p><strong>Canvass Shifts Tomorrow - 4:00p: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";   
                                }

                                
                                if($phone_shifts_sched_tomorrow == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_pst = "<p><strong>Phone Shifts Tomorrow: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($phone_shifts_sched_tomorrow == 0) {
                                }
                                elseif(!is_int($phone_shifts_sched_tomorrow)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_pst = "<p><strong>Phone Shifts Tomorrow: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }
                                elseif($phone_shifts_sched_tomorrow < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_pst = "<p><strong>Phone Shifts Tomorrow: </strong><em> Make sure you entered a whole number (or zero)!</em></p>";
                                }

                                if($error == "") {


                                $_SESSION["staging_location"] = $staging_location;
                                $_SESSION["canv_shifts_sched_tomorrow_1"] = $canv_shifts_sched_tomorrow_1;
                                $_SESSION["canv_shifts_sched_tomorrow_2"] = $canv_shifts_sched_tomorrow_2;
                                $_SESSION["canv_shifts_sched_tomorrow_3"] = $canv_shifts_sched_tomorrow_3;
                                $_SESSION["phone_shifts_sched_tomorrow"] = $phone_shifts_sched_tomorrow;
                                $_SESSION["walk_pckts_unatt"] = $walk_pckts_unatt;

                                    echo '<meta http-equiv="refresh" content="0.5;url=result_precheck.php">';
                                    
                                }
                                else {


                                            $_SESSION['error_sl'] = $error_sl;
                                            $_SESSION['error_cst1'] = $error_cst1;
                                            $_SESSION['error_cst2'] = $error_cst2;
                                            $_SESSION['error_cst3'] = $error_cst3;
                                            $_SESSION['error_pst'] = $error_pst;
                                            $_SESSION['error_wpu'] = $error_wpu;



                                            echo '<meta http-equiv="refresh" content="0.5;url=report_precheck_error.php">';
                                            
                                    session_write_close();
                                }
                            }
                    
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