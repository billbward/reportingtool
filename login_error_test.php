<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL Report Login - Error</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap_bill.css" rel="stylesheet">

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

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Login Error</strong>      </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="login_error.php">
                            <fieldset>
                                		<?php
                                            /*$db = mysqli_connect("23.229.203.8", "bward", "gtown11.", "master_db")
                                                or die("Can't connect to database".mysql_error());

                                            $table_name = 'master_db.user_table_test';

                                            $result = mysqli_query($db, "select * from " . $table_name);
                                            if (!$result) {
                                                echo "An error occurred.\n";
                                                exit;
                                            }

                                            //grab the vanids that exist in the table and slot into an array
                                            $vld_usr = array();
                                            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                                                $vld_usr[] = (int)$row['vanid'];
                                            }

                                            $myc_id = mysql_escape_string($_POST['myc_id']);

											//if the given myc_id is in the valid user list, head to home page
											if(in_array($myc_id, $vld_usr) == TRUE) {
												//echo $myc_id . " is valid."
												$ses_key = $myc_id . time();
												session_start();
												$_SESSION['vanid'] = $myc_id;
												$_SESSION['key'] = $ses_key;
												$_SESSION['sl'] = "";
                                                session_write_close();


                                                */
                                                $url = "home.php";

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

                                                /*
                                                error_reporting(E_ALL);
                                                ini_set('display_errors', 'On');
                                                header("Location: www.google.com");
                                                */
                                                
                                                
											

                                        print_r($_SESSION['key']);

										echo '<p style="text-align: center;">You entered "' . $myc_id . '", which is not an approved MyCampaignID.</p>';
										echo '<p style="text-align: center;"><a href=login.php>Please try again</a></p>';
                                        
										?>
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


