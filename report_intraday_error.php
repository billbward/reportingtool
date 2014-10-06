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
                        <form role="form" method="post" action="login_error.php">
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


                                    $error_sl = $_SESSION['error_sl'];
                                    $error_shft = $_SESSION['error_shft'];                                      
                                    $error_vps = $_SESSION['error_vps'];
                                    $error_vks = $_SESSION['error_vks'];
                                    $error_vrs = $_SESSION['error_vrs'];
                                    $error_wpo = $_SESSION['error_wpo'];
                                    $error_csc = $_SESSION['error_csc'];
                                    $error_psc = $_SESSION['error_psc'];
                                    $error_cac = $_SESSION['error_cac'];
                                    $error_pac = $_SESSION['error_pac'];
                                    $error_ctv = $_SESSION['error_ctv'];
                                    $error_wpu = $_SESSION['error_wpu'];

                                    
                                    echo "<hr>";
                                    echo $error_sl;
                                    echo $error_shft;
                                    echo $error_wpo;                                    
                                    echo $error_vks;                                    
                                    echo $error_vrs;                                    
                                    echo $error_vps;

                                    
                                    echo $error_csc;
                                    echo $error_cac;
                                    echo $error_psc;
                                    echo $error_pac;
                                    echo $error_ctv;
                                    echo $error_wpu;

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