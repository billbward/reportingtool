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
                                                    "canv_att_completed", "phone_att_completed", "walk_pckts_unatt", "ctv_collected");

                                function isset_or(&$check, $alternate = NULL) 
                                { 
                                    return (isset($check)) ? $check : $alternate; 
                                } 

                                $staging_location = $_SESSION['sl'];

                                $shift = mysqli_real_escape_string($db, isset_or($_POST['shift'], NULL));
                                $vols_phoning_snapshot = mysqli_real_escape_string($db, isset_or($_POST['vols_phoning_snapshot'], NULL));
                                $walk_pckts_out = mysqli_real_escape_string($db, isset_or($_POST['walk_pckts_out'], NULL));
                                $vols_knocking_snapshot = mysqli_real_escape_string($db, isset_or($_POST['vols_knocking_snapshot'], NULL));
                                $vols_returned_snapshot = mysqli_real_escape_string($db, isset_or($_POST['vols_returned_snapshot'], NULL));
                                $canv_shifts_completed = mysqli_real_escape_string($db, isset_or($_POST['canv_shifts_completed']));
                                $phone_shifts_completed = mysqli_real_escape_string($db, isset_or($_POST['phone_shifts_completed']));
                                $canv_att_completed = mysqli_real_escape_string($db, isset_or($_POST['canv_att_completed']));
                                $phone_att_completed = mysqli_real_escape_string($db, isset_or($_POST['phone_att_completed']));
                                $ctv_collected = mysqli_real_escape_string($db, isset_or($_POST['ctv_collected'], NULL));
                                $walk_pckts_unatt = mysqli_real_escape_string($db, isset_or($_POST['walk_pckts_unatt'], NULL));


                                if( $vols_phoning_snapshot == '0') {
                                    $vols_phoning_snapshot = $vols_phoning_snapshot;
                                }
                                else if($vols_phoning_snapshot !== NULL) {
                                    $vols_phoning_snapshot = (int) $vols_phoning_snapshot;
                                }

                                if( $vols_knocking_snapshot == '0') {
                                    $vols_knocking_snapshot = $vols_knocking_snapshot;
                                }
                                else if($vols_knocking_snapshot !== NULL) {
                                    $vols_knocking_snapshot = (int) $vols_knocking_snapshot;
                                }

                                if( $vols_returned_snapshot == '0') {
                                    $vols_returned_snapshot = $vols_returned_snapshot;
                                }
                                else if($vols_returned_snapshot !== NULL) {
                                    $vols_returned_snapshot = (int) $vols_returned_snapshot;
                                }

                                if( $walk_pckts_out == '0') {
                                    $walk_pckts_out = $walk_pckts_out;
                                }
                                else if($walk_pckts_out !== NULL) {
                                    $walk_pckts_out = (int) $walk_pckts_out;
                                }

                                if( $canv_shifts_completed == '0') {
                                    $canv_shifts_completed = $canv_shifts_completed;
                                }
                                else if($canv_shifts_completed !== NULL) {
                                    $canv_shifts_completed = (int) $canv_shifts_completed;
                                }

                                if( $phone_shifts_completed == '0') {
                                    $phone_shifts_completed = $phone_shifts_completed;
                                }
                                else if($phone_shifts_completed !== NULL) {
                                    $phone_shifts_completed = (int) $phone_shifts_completed;
                                }

                                if( $canv_att_completed == '0') {
                                    $canv_att_completed = $canv_att_completed;
                                }
                                else if($canv_att_completed !== NULL) {
                                    $canv_att_completed = (int) $canv_att_completed;
                                }

                                if( $phone_att_completed == '0') {
                                    $phone_att_completed = $phone_att_completed;
                                }
                                else if($phone_att_completed !== NULL) {
                                    $phone_att_completed = (int) $phone_att_completed;
                                }

                                if( $walk_pckts_unatt == '0') {
                                    $walk_pckts_unatt = $walk_pckts_unatt;
                                }
                                else if($walk_pckts_unatt !== NULL) {
                                    $walk_pckts_unatt = (int) $walk_pckts_unatt;
                                }

                                if( $ctv_collected == '0') {
                                    $ctv_collected = $ctv_collected;
                                }
                                else if($ctv_collected !== NULL) {
                                    $ctv_collected = (int) $ctv_collected;
                                }


                                $error = "";
                                $error_sl = "";
                                $error_shft = "";
                                $error_vps = "";
                                $error_vks = "";
                                $error_vrs = "";
                                $error_wpo = "";
                                $error_csc = "";
                                $error_psc = "";
                                $error_cac = "";
                                $error_pac = "";
                                $error_ctv = "";
                                $error_wpu = "";


                                if($staging_location == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_sl = "<p><strong>Staging Location: </strong><em>Any chance you forgot to select your Staging Location?</em></p>";
                                }

                                if($shift == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_shft = "<p><strong>Shift Sent Out: </strong><em>Any chance you forgot to select the shift you're reporting in for?</em></p>";
                                }

                                if($walk_pckts_out == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wpo = "<p><strong>Walk Packets Out: </strong><em>Make sure you entered this one. If none are out, use \"0\"</em></p>";
                                }
                                elseif($walk_pckts_out == 0) {
                                }
                                elseif(!is_int($walk_pckts_out)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wpo = "<p><strong>Walk Packets Out: </strong><em>Make sure you entered this one. If none are out, use \"0\"</em></p>";
                                }
                                elseif($walk_pckts_out < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_wpo = "<p><strong>Walk Packets Out: </strong><em>Make sure you entered this one. If none are out, use \"0\"</em></p>";
                                }


                                if($vols_phoning_snapshot == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vps = "<p><strong>Volunteers Making Calls: </strong><em>Did you enter the # of vols making calls? If none, use \"0\"</em></p>";
                                }
                                elseif($vols_phoning_snapshot == 0) {
                                }
                                elseif(!is_int($vols_phoning_snapshot)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vps = "<p><strong>Volunteers Making Calls: </strong><em>Did you enter the # of vols making calls? If none, use \"0\"</em></p>";
                                }
                                elseif($vols_phoning_snapshot < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vps = "<p><strong>Volunteers Making Calls: </strong><em>Did you enter the # of vols making calls? If none, use \"0\"</em></p>";
                                }


                                if($vols_knocking_snapshot == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vks = "<p><strong>Canvassers Out: </strong><em>Did you enter how many are out knocking? If none, use \"0\"</em></p>";
                                }
                                elseif($vols_knocking_snapshot == 0) {
                                }
                                elseif(!is_int($vols_knocking_snapshot)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vks = "<p><strong>Canvassers Out: </strong><em>Did you enter how many are out knocking? If none, use \"0\"</em></p>";
                                }
                                elseif($vols_knocking_snapshot < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vks = "<p><strong>Canvassers Out: </strong><em>Did you enter how many are out knocking? If none, use \"0\"</em></p>";
                                }


                                if($vols_returned_snapshot == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vrs = "<p><strong>Canvassers Returned: </strong><em>Did you enter how many volunteers are back from the last shift? If none, use \"0\"</em></p>";
                                }
                                elseif($vols_returned_snapshot == 0) {
                                }
                                elseif(!is_int($vols_returned_snapshot)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vrs = "<p><strong>Canvassers Returned: </strong><em>Did you enter how many volunteers are back from the last shift? If none, use \"0\"</em></p>";
                                }
                                elseif($vols_returned_snapshot < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_vrs = "<p><strong>Canvassers Returned: </strong><em>Did you enter how many volunteers are back from the last shift? If none, use \"0\"</em></p>";
                                }



                                if($canv_shifts_completed == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_csc = "<p><strong>Canvass Shifts Completed: </strong><em>Double check your entry. This should be a number.</em></p>";
                                }
                                elseif($canv_shifts_completed == 0) {
                                }
                                elseif(!is_int($canv_shifts_completed)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_csc = "<p><strong>Canvass Shifts Completed: </strong><em>Double check your entry. This should be a number.</em></p>";
                                }
                                elseif($canv_shifts_completed < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_csc = "<p><strong>Canvass Shifts Completed: </strong><em>Double check your entry. This should be a number.</em></p>";
                                }

                                if($phone_shifts_completed == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_psc = "<p><strong>Phone Shifts Completed: </strong><em>Double check your entry. This should be a number.</em></p>";
                                }
                                elseif($phone_shifts_completed == 0){
                                }
                                elseif(!is_int($phone_shifts_completed)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_psc = "<p><strong>Phone Shifts Completed: </strong><em>Double check your entry. This should be a number.</em></p>";
                                }
                                elseif($phone_shifts_completed < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_psc = "<p><strong>Phone Shifts Completed: </strong><em>Double check your entry. This should be a number.</em></p>";
                                }



                                if($canv_att_completed == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cac = "<p><strong>Canvass Attempts Completed: </strong><em>Did you enter the number of canvass attempts?</em></p>";
                                }
                                elseif($canv_att_completed == 0) {
                                }
                                elseif(!is_int($canv_att_completed)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cac = "<p><strong>Canvass Attempts Completed: </strong><em>Did you enter the number of canvass attempts?</em></p>";
                                }
                                elseif($canv_att_completed <0 ) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_cac = "<p><strong>Canvass Attempts Completed: </strong><em>Did you enter the number of canvass attempts?</em></p>";
                                }


                                if($phone_att_completed == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_pac = "<p><strong>Phone Attempts Completed: </strong><em>Did you enter the number of phone attempts?</em></p>";
                                }
                                elseif($phone_att_completed == 0) {
                                }
                                elseif(!is_int($phone_att_completed)){
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_pac = "<p><strong>Phone Attempts Completed: </strong><em>Did you enter the number of phone attempts?</em></p>";
                                }
                                elseif($phone_att_completed < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_pac = "<p><strong>Phone Attempts Completed: </strong><em>Did you enter the number of phone attempts?</em></p>";
                                }


                                if($ctv_collected == NULL) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_ctv = "<p><strong>CTV Cards Collected: </strong><em>Make sure you entered these. Must be a number (or 0).</em></p>";
                                }
                                elseif($ctv_collected == 0) {
                                }
                                elseif(!is_int($ctv_collected)) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_ctv = "<p><strong>CTV Cards Collected: </strong><em>Make sure you entered these. Must be a number (or 0).</em></p>";
                                }
                                elseif($ctv_collected < 0) {
                                    $error = "<p><h4>Hm, that entry looks just a little funky.</h4></p>";
                                    $error_ctv = "<p><strong>CTV Cards Collected: </strong><em>Make sure you entered these. Must be a number (or 0).</em></p>";
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


                                if($error == "") {


                                $_SESSION["staging_location"] = $staging_location;
                                $_SESSION["shift"] = $shift;
                                $_SESSION["vols_phoning_snapshot"] = $vols_phoning_snapshot;
                                $_SESSION["vols_knocking_snapshot"] = $vols_knocking_snapshot;
                                $_SESSION["vols_returned_snapshot"] = $vols_returned_snapshot;
                                $_SESSION["walk_pckts_out"] = $walk_pckts_out;
                                $_SESSION["canv_shifts_completed"] = $canv_shifts_completed;
                                $_SESSION["phone_shifts_completed"] = $phone_shifts_completed;
                                $_SESSION["canv_att_completed"] = $canv_att_completed;
                                $_SESSION["phone_att_completed"] = $phone_att_completed;
                                $_SESSION["ctv_collected"] = $ctv_collected;
                                $_SESSION["walk_pckts_unatt"] = $walk_pckts_unatt;


                                    echo '<meta http-equiv="refresh" content="0.5;url=result_intraday.php">';

                                }
                                else {

                                    $_SESSION['error_sl'] = $error_sl;
                                    $_SESSION['error_shft'] = $error_shft;
                                    $_SESSION['error_vps'] = $error_vps;
                                    $_SESSION['error_vks'] = $error_vks;
                                    $_SESSION['error_vrs'] = $error_vrs;
                                    $_SESSION['error_wpo'] = $error_wpo;
                                    $_SESSION['error_csc'] = $error_csc;
                                    $_SESSION['error_psc'] = $error_psc;
                                    $_SESSION['error_cac'] = $error_cac;
                                    $_SESSION['error_pac'] = $error_pac;
                                    $_SESSION['error_ctv'] = $error_ctv;
                                    $_SESSION['error_wpu'] = $error_wpu;

                                    echo '<meta http-equiv="refresh" content="0.5;url=report_intraday_error.php">';
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