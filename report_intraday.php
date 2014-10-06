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

    <title>SL Report - Intraday</title>

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
                <div class="report-panel panel panel-primary">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>Staging Location - Shift Report</strong>      </h3>
                        <h5>Howdy! Let us know what you've accomplished so far today using the form below.</h5>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="report_intraday_redirect.php">
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
                                                    session_start();
                                                    $sl = $_SESSION['sl'];
                                                    echo "<div style=\"text-align:center;\">";
                                                    echo "<div style=\"text-align:left;\"><a href=\"pass_to_home.php\"><button type=\"button\" class=\"btn btn-primary btn-circle\"><i class=\"fa fa-home\"></i></button></a></div>";
                                                    echo "<h3><font face:\"Impact\"> <strong>" . $sl . "</strong></h3>";
                                                    session_write_close();
                                                    ?>
                                             <hr>  

                                        <div style="text-align:center;">
                                        <h4><strong>Select a Shift</strong>         </h4>
                                        </div>
                                        <div class="form-group" style="text-align: center;">
                                            <label>Most Recent Shift Sent Out</label>
                                            <select class="form-control" id="shift" name="shift">
                                                <option value="" selected disabled>Select a Shift...</option>
                                                <option value = "Shift 1">Shift 1 - 9:00a</option>
                                                <option value = "Shift 2">Shift 2 - 12:30p</option>
                                                <option value = "Shift 3">Shift 3 - 4:00p</option>
                                            </select>            
                                        </div>  

                                            <hr>  

                                        <div style="text-align:center;">
                                        <h4><strong>Shift Activity Snapshot</strong>         </h4>
                                        </div>
           
                                        <div class="form-group">
                                            <br><label>Walk Packets Out</label></br>
                                            <input class="form-control" style="text-align:center;" placeholder="Packets you just sent out" type="number" max="100" name="walk_pckts_out" id="walk_pckts_out">
                                        </div>                                   
                                        <div class="form-group">
                                            <label>Canvassers Out</label>
                                            <input class="form-control" style="text-align:center;" placeholder="Canvassers you just sent out" type="number" max="100" name="vols_knocking_snapshot" id="vols_knocking_snapshot">
                                        </div>                                   
                                        <div class="form-group">
                                            <label>Canvassers Returned</label>
                                            <input class="form-control" style="text-align:center;" placeholder="Last shift's canvassers who returned" type="number" max="100" name="vols_returned_snapshot" id="vols_returned_snapshot">
                                        </div>
                                        <div class="form-group">
                                            <label>Volunteers Calling</label>
                                            <input class="form-control" style="text-align:center;" placeholder="Volunteers currently making calls" type="number" max="100" name="vols_phoning_snapshot" id="vols_phoning_snapshot">
                                        </div>                                        


                                        <hr>

                                        <div style="text-align:center;">
                                        <h4><strong>Today's Cumulative Voter Contact</strong>         </h4>
                                        </div> 

                                        <div class="form-group">
                                            <br><label>Total Canvass Shifts Completed</label></br>
                                            <input class="form-control" style="text-align:center;" placeholder="All canvass shifts completed today" type="number" max="200" name="canv_shifts_completed" id="canv_shifts_completed">
                                        </div>      
                                        <div class="form-group">
                                            <label>Total Canvass Attempts Completed</label>
                                            <input class="form-control" style="text-align:center;" placeholder="All canv. attempts completed today" type="number" max="10000" name="canv_att_completed" id="canv_att_completed">
                                        </div>
                                        <div class="form-group">
                                            <label>Total Phone Shifts Completed</label>
                                            <input class="form-control" style="text-align:center;" placeholder="All phone shifts completed today" type="number" max="200" name="phone_shifts_completed" id="phone_shifts_completed">
                                        </div>
                                        <div class="form-group">
                                            <label style="display:inline">Total Phone Attempts Completed</label>
                                            <input class="form-control" style="text-align:center;" placeholder="All phone attempts completed today" type="number" max="10000" name="phone_att_completed" id="phone_att_completed">
                                        </div>      

                                        <div class="form-group">
                                            <label>Total Commit to Vote Cards Collected</label>
                                            <input class="form-control" style="text-align:center;" placeholder="All CTV cards collected today" type="number" max="5000" name="ctv_collected" id="ctv_collected">
                                        </div>      

                                        
                                        <hr>
                                        

                                        <div style="text-align:center;">
                                        <h4><strong>Staging Location Inventory</strong>         </h4>
                                        </div>                                   
                                        <div class="form-group">
                                            <br><label>Walk Packets Available at SL</label></br>
                                            <input class="form-control" style="text-align:center;" placeholder="Packets ready to be walked" type="number" max="500" name="walk_pckts_unatt" id="walk_pckts_unatt">
                                        </div>

                                        
                                        <div style="text-align:center;">  
                                        <hr>
                                       
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-check"></i></button>
                                        <p><strong>Submit Form</strong></p>

                                        <p><button type="reset" class="btn btn-warning btn-outline "><strong>Reset Form</strong></button></p>
                                        
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