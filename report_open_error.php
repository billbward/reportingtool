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
                <div class="report-panel panel panel-yellow">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>Hm, that entry looks a little funky...</strong>      </h3>
                        <h5>Check out the error message(s) below to find the error.</h5>
                    </div>
                    <div class="panel-body">
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


                                     $error_sl = $_SESSION['error_sl'];
                                     $error_os = $_SESSION['error_os'];
                                     $error_cs1 = $_SESSION['error_cs1'];
                                     $error_cs2 = $_SESSION['error_cs2'];
                                     $error_cs3 = $_SESSION['error_cs3'];
                                     $error_ps = $_SESSION['error_ps'];
                                     $error_wp = $_SESSION['error_wp'];
                                                

                                     echo "<hr>";
                                    //echo $error;
                                    echo $error_sl;
                                    echo $error_os;
                                    echo $error_cs1;
                                    echo $error_cs2;
                                    echo $error_cs3;
                                    echo $error_ps;
                                    echo $error_wp;

                                    if($error_os == '') {
                                        $_SESSION['error_os'] = 1;

                                    }
                                    else {
                                        $_SESSION['error_os'] = 0;
                                    }


                                    echo "<hr>";
                                    
                                    echo "<br><div style=\"text-align:center;\">";
                                    echo "<strong>Give it another shot:</strong>";
                                    echo "<p><a href=\"javascript:history.go(-1)\" style=\"color: #FFFFFF\"><button type=\"button\" class=\"btn btn-lg btn-primary btn-default\">Click Here</button></a></p>";
                                    echo "<p>Thanks!</p>";


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