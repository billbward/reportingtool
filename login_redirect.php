<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(isset($_SESSION['vanid'])) {
    unset($_SESSION['vanid']);
}
if(isset($_SESSION['key'])) {
    unset($_SESSION['key']);
}

function isset_or(&$check, $alternate = NULL) 
{ 
    return (isset($check)) ? $check : $alternate; 
} 

$db = mysqli_connect("domain", "user", "pw", "database")
     or die("Can't connect to database".mysql_error());

$myc_id = mysqli_real_escape_string($db, isset_or($_POST['myc_id'], NULL));
$ses_key = $myc_id . time();

$_SESSION['vanid'] = $myc_id;
$_SESSION['key'] = $ses_key;
$_SESSION['sl'] = "";
session_write_close();


?>
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

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="text-align:center;">
                        <h3><strong>One Moment...</strong>      </h3>
                        
                    </div>
                    <div class="panel-body">
                        <h4 style="text-align:center;">We're beaming your info to Wendy HQ in Fort Worth.</h4>
                        <h4 style="text-align:center;">Sit tight!</h4>
                        <form role="form" method="post" action="login_error.php">
                            <fieldset>
                                		<?php
                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                or die("Can't connect to database".mysql_error());

                                            $table_name = 'master_db.user_table';

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

                                            
											//if the given myc_id is in the valid user list, head to home page
											if(in_array($myc_id, $vld_usr) == TRUE) {
												//echo $myc_id . " is valid."
												
                                                $role_result = mysqli_query($db, "select * from " . $table_name . "where vanid = " . $myc_id);
                                                $role_row = mysqli_fetch_array($result, MYSQL_ASSOC);
                                            

                                                echo '<meta http-equiv="refresh" content="1.25;url=pass_to_home.php">';
                                                
                                            }

                                            else {

                                                session_start();
                                                $_SESSION['vanid'] = $myc_id;
                                                session_write_close();

                                                echo '<meta http-equiv="refresh" content="1.25;url=login_error.php">';
                                            }    
                                        
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


