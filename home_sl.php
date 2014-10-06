<?php
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

    <title>Wendy Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap_bill.css"rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                        <h3><strong>Staging Location Soft Reporting Tool</strong>      </h3>
                        <h5>Hey there! Select your staging location and then a reporting option below</h5>
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
                                                    header("Location:login.php");
                                                } 


                                                $db = pg_connect("host=localhost dbname=postgres user=wbw4 password=")
                                                    or die("Can't connect to database".pg_last_error());

                                                $sl = pg_escape_string($db, $_POST['sl']);




                                                echo "<hr>";
                                                echo "<div style=\"text-align: center;\">";
                                                echo "<h4><strong>" . $sl . "</strong> </h4>";
                                                echo "</div>";

                                            ?>
                                          
                                <hr>
                                <div style="text-align:center;"> 
                                <a href="report_open.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-success btn-block">Open Your Staging Location</button></a>
                                <a href = "report_intraday.php" style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-primary btn-block_half" style="display:inline">Shift Time 1</button></a>
                                <a href="report_intraday.php"  style="color: #FFFFFF"><button type="button" class="btn btn-lg btn-primary btn-block_half" style="display:inline">Shift Time 2</button></a>
                                <a href="report_close.php" style="color: #FFFFFF" ><button type="button" class="btn btn-lg btn-danger btn-block">Close Your Staging Location</button></a>
                            <!--
                                <a href="report_open.php" class="btn btn-lg btn-success btn-block">Open Your Staging Location</a>
                                <a href="report_intraday.php" class="btn btn-lg btn-primary btn-block_half" type="btn-block_half">Shift Time 1</a>
                                <a href="report_intraday.php" class="btn btn-lg btn-primary btn-block_half">Shift Time 2</a>
                                <a href="report_close.php" class="btn btn-lg btn-danger btn-block">Close Your Staging Location</a>
                            -->
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


