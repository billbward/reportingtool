<!DOCTYPE html>
<html lang="en">
<?php

session_start();

$myc_id = $_SESSION['vanid'];
$key = $_SESSION['key'];

session_write_close();

$db = mysqli_connect("23.229.203.8", "bward", "gtown11.", "master_db")
or die("Can't connect to database".mysql_error());

$role_result = mysqli_query($db, "select * from master_db.user_table where vanid = " . $myc_id );

$rresult_fetch = mysqli_fetch_array($role_result,MYSQL_ASSOC);
$role = $rresult_fetch["role"]; 

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



if($role == 'FO') {
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
}

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Staging Location Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap_bill.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

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

    <div id="wrapper">

                <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="statewide_report.php">BGTX Soft Reporting Tool</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="statewide_report.php">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Statewide Activity Snapshot
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Statewide Shift Report
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Logout<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>

        <!--<div id="page-wrapper"> -->
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <h1 class="page-header" style="text-align:center;">Statewide Staging Location Summary</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

                <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Staging Location Activity</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="dataTables-example">
                                    <thead>
                                        <tr>
                                           <th class="col-lg-2">Staging Location</th>
                                            <th style='text-align:center;'>Open Status</th>
                                            <th style='text-align:center;' class='col-sm-1'>Canv Shifts Today</th>
                                            <th style='text-align:center;' class='col-sm-1'>Phone Shifts Today</th>
                                            <th style='text-align:center;' class='col-sm-1'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;' class='col-sm-1'>Canv Shifts Completed</th>
                                            <th style='text-align:center;' class='col-sm-1'>Canv Att Completed</th>
                                            <th style='text-align:center;' class='col-sm-1'>Att Per Shift</th>
                                            <th style='text-align:center;' class='col-sm-1'>CTV Collected</th>
                                            <th style='text-align:center;' class='col-sm-1'>Phone Shifts Completed</th>
                                            <th style='text-align:center;' class='col-sm-1'>Phone Att Completed</th>
                                            <th style='text-align:center;' class='col-sm-1'>Att Per Shift</th>
                                            <th style='text-align:center;' class='col-sm-1'>Canvass Shifts Recruited</th>
                                            <th style='text-align:center;' class='col-sm-1'>Phone Shifts Recruited</th>
                                            <th style='text-align:center;' class='col-sm-1'>Canv Shifts Tmrw</th>
                                            <th style='text-align:center;' class='col-sm-1'>Phone Shifts Tmrw</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                            $db = mysqli_connect("23.229.203.8", "bward", "gtown11.", "master_db")
                                                        or die("Can't connect to database".mysql_error());

                                            //$table_name = 'master_db.master_metrics_table';


                                            $sl_query = "select region
                                                                , staging_location
                                                                , open_status
                                                                , canv_shifts_sched_today_1 + canv_shifts_sched_today_2 + canv_shifts_sched_today_3 as canv_shifts_sched_today_total
                                                                , phone_shifts_sched_today
                                                                , walk_pckts_out
                                                                , canv_shifts_completed
                                                                , canv_att_completed
                                                                , case when canv_shifts_completed = 0 then '-'
                                                                    else round(canv_att_completed / canv_shifts_completed,0) end as canv_att_per_shift
                                                                , ctv_collected
                                                                , phone_shifts_completed
                                                                , phone_att_completed
                                                                , case when phone_shifts_completed = 0 then '-'
                                                                    else round(phone_att_completed / phone_shifts_completed,0) end as phone_att_per_shift
                                                                , canv_shifts_recruit_today
                                                                , phone_shifts_recruit_today
                                                                , canv_shifts_sched_tomorrow_1 + canv_shifts_sched_tomorrow_2 + canv_shifts_sched_tomorrow_3 as canv_shifts_sched_tomorrow_total
                                                                , phone_shifts_sched_tomorrow
                                                        from(
                                                        select m.*
                                                                , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                                , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                                (select @rank := 1) r , 
                                                                (select @sl :='') s
                                                        where date = current_date
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        order by staging_location asc"
                                                        ;



                                                    $sl_result = mysqli_query($db, $sl_query);

                                                
                                                    $sl_snapshot = array();
                                                    //$count = 0;
                                                    while ($sl_row = mysqli_fetch_array($sl_result,MYSQL_ASSOC)) {
                                                           
                                                            $sl_snapshot[] = $sl_row;
                                                            //$count = $count + 1;
                                                        
                                                    //echo '<tr class="even gradeA">';
                                                    echo '<tr>';

                                                           echo '<td>' . $sl_row['staging_location'] . '</td>'; 
                                                        
                                                    //open_status    
                                                        if($sl_row['open_status'] == 'Open') {
                                                            echo '<td style="text-align:center;" class="green">' . $sl_row['open_status'] . '</td>';
                                                        }
                                                        else {
                                                            echo '<td style="text-align:center;" class="red">' . $sl_row['open_status'] . '</td>';
                                                        }
                                                     
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_sched_today_total'] . '</td>';
                                                         
                                                            echo '<td style="text-align:center;" >' . $sl_row['phone_shifts_sched_today'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['walk_pckts_out'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_att_completed'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_att_per_shift'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['ctv_collected'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_shifts_completed'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_att_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_att_per_shift'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_recruit_today'] . '</td>';
                                                           
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_shifts_recruit_today'] . '</td>';
                                                    
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_sched_tomorrow_total'] . '</td>';
                                                        
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_shifts_sched_tomorrow'] . '</td>';
                                                         
                                                    echo '</tr>';
                                                     }


                                    ?>
                                    <!--
                                    <tfoot>
                                        <tr>
                                           <th>Staging Location</th>
                                            <th>Open Status</th>
                                            <th>Canv Shifts Sched Today</th>
                                            <th>Phone Shifts Sched Today</th>
                                            <th>Walk Packets Sent Out</th>
                                            <th>Canvass Shifts Completed</th>
                                            <th>Canvass Attempts Completed</th>
                                            <th>Canvass Attempts Per Shift</th>
                                            <th>CTV Collected</th>
                                            <th>Phone Shifts Completed</th>
                                            <th>Phone Attempts Completed</th>
                                            <th>Phone Attempts Per Shift</th>
                                            <th>Future Canvass Shifts Recruited</th>
                                            <th>Future Phone Shifts Recruited</th>
                                            <th>Canvass Shifts Scheduled Tomorrow</th>
                                            <th>Phone Shifts Scheduled Tomorrow</th>
                                        </tr>
                                    </tfoot>
                                        -->
                                </tbody>
                                </table>
                            </div>
                          </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

   <!-- </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
