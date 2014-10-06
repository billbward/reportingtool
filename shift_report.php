<?php

//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();

$myc_id = $_SESSION['vanid'];
$key = $_SESSION['key'];

session_write_close();

$db = mysqli_connect("domain", "user", "pw", "database")
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
<!DOCTYPE html>
<html lang="en">
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
                <a class="navbar-brand" href="pass_to_home.php">BGTX Soft Reporting Tool</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li>Hey <?php echo $rresult_fetch['firstname'] ?>, use this dropdown to navigate</li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-navicon fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="pass_to_home.php">
                                <div>
                                    <i class="fa fa-check fa-fw"></i> Reporting Tool - Enter A Report
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="activity_report.php">
                                <div>
                                    <i class="fa fa-bar-chart fa-fw"></i> Statewide Activity Report
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="shift_report.php">
                                <div>
                                    <i class="fa fa-bar-chart fa-fw"></i> Statewide Shift Report
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
                    <h1 class="page-header" style="text-align:center;">Statewide Shift Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

                <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-orange">
                        <div class="panel-heading">
                            <strong>Statewide Activity</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="test">
                                    <thead>
                                        <tr>
                                           <th class="col-lg-2">State</th>
                                            <th style='text-align:center;'>Locations Open</th>
                                            <th style='text-align:center;'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;'>Canvassers Sent Out</th>
                                            <th style='text-align:center;'>Shift 1 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 1 Vols Out</th>
                                            <th style='text-align:center;'>Shift 1 Flake Rate</th>
                                            <th style='text-align:center;'>Shift 1 Vols Returned</th>
                                            <th style='text-align:center;'>Shift 2 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 2 Vols Out</th>
                                            <th style='text-align:center;'>Shift 2 Flake Rate</th>
                                            <th style='text-align:center;'>Shift 2 Vols Returned</th>
                                            <th style='text-align:center;'>Shift 3 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 3 Vols Out</th>
                                            <th style='text-align:center;'>Shift 3 Flake Rate</th>
                                            <th style='text-align:center;'>Phone Shfts Sched</th>
                                            <th style='text-align:center;'>Phone Shifts Completed</th>
                                            <th style='text-align:center;'>Intraday Flake Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                        or die("Can't connect to database".mysql_error());


                                            $stw_query = "select dd.statewide
                                                                , dd.sl_count
                                                                , a.open_loc
                                                                , a.walk_pckts_out
                                                                , a.vols_knocking_snapshot
                                                                , a.canv_shifts_sched_today_1
                                                                , s1.vols_knocking_1
                                                                , s2.vols_returned_1
                                                                , a.canv_shifts_sched_today_2
                                                                , s2.vols_knocking_2
                                                                , s3.vols_returned_2
                                                                , a.canv_shifts_sched_today_3
                                                                , s3.vols_knocking_3
                                                                , a.phone_shifts_sched_today
                                                                , a.phone_shifts_completed



                                                        from (select 'Texas' as statewide
                                                                    , count(sl) as sl_count
                                                        from master_db.dynamic_dropdown
                                                        group by 1
                                                        order by 1
                                                        )dd
                                                        left join (
                                                        select 'Texas' as statewide
                                                            , sum(case when open_status = 'Open' then 1 else 0 end) as open_loc
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_snapshot
                                                            , sum(canv_shifts_sched_today_1) as canv_shifts_sched_today_1
                                                            , sum(canv_shifts_sched_today_2) as canv_shifts_sched_today_2
                                                            , sum(canv_shifts_sched_today_3) as canv_shifts_sched_today_3
                                                            , sum(phone_shifts_sched_today) as phone_shifts_sched_today
                                                            , sum(phone_shifts_completed) as phone_shifts_completed
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
                                                        )a on a.statewide=dd.statewide

                                                        left join (
                                                        select 'Texas' as statewide
                                                            , sum(canv_shifts_sched_today_1) as canv_shifts_sched_today_1
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_1
                                                        from(
                                                        select m.*
                                                            , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                            , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                            (select @rank := 1) r , 
                                                            (select @sl :='') s
                                                        where date = current_date
                                                        and report = 'Shift 1'
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        )s1 on s1.statewide=dd.statewide

                                                        left join (select 'Texas' as statewide
                                                            , sum(canv_shifts_sched_today_2) as canv_shifts_sched_today_2
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_2
                                                            , sum(vols_returned_snapshot) as vols_returned_1
                                                        from(
                                                        select m.*
                                                            , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                            , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                            (select @rank := 1) r , 
                                                            (select @sl :='') s
                                                        where date = current_date
                                                        and report = 'Shift 2'
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        )s2 on s2.statewide=dd.statewide

                                                        left join (
                                                        select 'Texas' as statewide
                                                            , sum(canv_shifts_sched_today_3) as canv_shifts_sched_today_3
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_3
                                                            , sum(vols_returned_snapshot) as vols_returned_2
                                                        from(
                                                        select m.*
                                                            , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                            , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                            (select @rank := 1) r , 
                                                            (select @sl :='') s
                                                        where date = current_date
                                                        and report = 'Shift 3'
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        )s3 on s3.statewide=dd.statewide"
                                                        ;



                                                    $stw = mysqli_query($db, $stw_query);
                                                    $stw_result = mysqli_fetch_array($stw,MYSQL_ASSOC);

                                                            if($stw_result['canv_shifts_sched_today_1'] == 0) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            elseif($stw_result['canv_shifts_sched_today_1'] == NULL) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            elseif($stw_result['vols_knocking_1'] == NULL) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_1_flake = round((1 - ($stw_result['vols_knocking_1'] / $stw_result['canv_shifts_sched_today_1'])) * 100,1) . "%";
                                                            }

                                                            if($stw_result['canv_shifts_sched_today_2'] == 0) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            elseif($stw_result['canv_shifts_sched_today_2'] == NULL) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            elseif($stw_result['vols_knocking_2'] == NULL) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_2_flake = round((1 - ($stw_result['vols_knocking_2'] / $stw_result['canv_shifts_sched_today_2'])) * 100,1) . "%";
                                                            }
                                                            
                                                            if($stw_result['canv_shifts_sched_today_3'] == 0) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            elseif($stw_result['canv_shifts_sched_today_3'] == NULL) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            elseif($stw_result['vols_knocking_3'] == NULL) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_3_flake = round((1 - ($stw_result['vols_knocking_3'] / $stw_result['canv_shifts_sched_today_3'])) * 100,1) . "%";
                                                            }

                                                            if($stw_result['phone_shifts_sched_today'] == NULL){
                                                                $phone_flake = NULL;
                                                            }
                                                            else{
                                                                $phone_flake = round((1 - ($stw_result['phone_shifts_completed'] / $stw_result['phone_shifts_sched_today'])) * 100,1) . "%"; 
                                                            }
                                                            
  
                                                    echo '<tr>';

                                                           echo '<td>' . $stw_result['statewide'] . '</td>'; 
                                                        
                                                    //open_status    
                                                        if($stw_result['open_loc'] == NULL) {
                                                            
                                                            echo '<td style="text-align:center;" class="red">' . '0' . ' / ' . $stw_result['sl_count'] . '</td>';
                                                            
                                                        }
                                                        elseif($stw_result['open_loc'] >= 1) {
                                                            echo '<td style="text-align:center;" class="green">' . $stw_result['open_loc'] . ' / ' . $stw_result['sl_count'] . '</td>';
                                                        }
                                                        else {
                                                            echo '<td style="text-align:center;" class="red">' . $stw_result['open_loc'] . ' / ' . $stw_result['sl_count'] . '</td>';
                                                        }
                                                     
                                                            echo '<td style="text-align:center;">' . $stw_result['walk_pckts_out'] . '</td>';
                                                         
                                                            echo '<td style="text-align:center;" >' . $stw_result['vols_knocking_snapshot'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $stw_result['canv_shifts_sched_today_1'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $stw_result['vols_knocking_1'] . '</td>';
                                                          
                                                            if($shift_1_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_1_flake . '</td>';
                                                            }
                                                             
                                                            echo '<td style="text-align:center;">' . $stw_result['vols_returned_1'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $stw_result['canv_shifts_sched_today_2'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $stw_result['vols_knocking_2'] . '</td>';
                                                          
                                                            if($shift_2_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_2_flake . '</td>';
                                                            }
                                                             
                                                            echo '<td style="text-align:center;">' . $stw_result['vols_returned_2'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $stw_result['canv_shifts_sched_today_3'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $stw_result['vols_knocking_3'] . '</td>';
                                                          
                                                            if($shift_3_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_3_flake . '</td>';
                                                            }
                                                            
                                                            echo '<td style="text-align:center;">' . $stw_result['phone_shifts_sched_today'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $stw_result['phone_shifts_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $phone_flake . '</td>';
                                                         
                                                    echo '</tr>';
                                                     


                                    ?>
                                    
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

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Regional Activity</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="test">
                                    <thead>
                                        <tr>
                                           <th class="col-lg-2">Region</th>
                                            <th style='text-align:center;'>Locations Open</th>
                                            <th style='text-align:center;'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;'>Canvassers Sent Out</th>
                                            <th style='text-align:center;'>Shift 1 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 1 Vols Out</th>
                                            <th style='text-align:center;'>Shift 1 Flake Rate</th>
                                            <th style='text-align:center;'>Shift 1 Vols Returned</th>
                                            <th style='text-align:center;'>Shift 2 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 2 Vols Out</th>
                                            <th style='text-align:center;'>Shift 2 Flake Rate</th>
                                            <th style='text-align:center;'>Shift 2 Vols Returned</th>
                                            <th style='text-align:center;'>Shift 3 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 3 Vols Out</th>
                                            <th style='text-align:center;'>Shift 3 Flake Rate</th>
                                            <th style='text-align:center;'>Phone Shfts Sched</th>
                                            <th style='text-align:center;'>Phone Shifts Completed</th>
                                            <th style='text-align:center;'>Intraday Flake Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                        or die("Can't connect to database".mysql_error());


                                            $reg_query = "select dd.region
                                                                , dd.sl_count
                                                                , a.open_loc
                                                                , a.walk_pckts_out
                                                                , a.vols_knocking_snapshot
                                                                , a.canv_shifts_sched_today_1
                                                                , s1.vols_knocking_1
                                                                , s2.vols_returned_1
                                                                , a.canv_shifts_sched_today_2
                                                                , s2.vols_knocking_2
                                                                , s3.vols_returned_2
                                                                , a.canv_shifts_sched_today_3
                                                                , s3.vols_knocking_3
                                                                , a.phone_shifts_sched_today
                                                                , a.phone_shifts_completed



                                                        from (select region
                                                                    , count(sl) as sl_count
                                                        from master_db.dynamic_dropdown
                                                        group by 1
                                                        order by 1
                                                        )dd
                                                        left join (
                                                        select region
                                                            , sum(case when open_status = 'Open' then 1 else 0 end) as open_loc
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_snapshot
                                                            , sum(canv_shifts_sched_today_1) as canv_shifts_sched_today_1
                                                            , sum(canv_shifts_sched_today_2) as canv_shifts_sched_today_2
                                                            , sum(canv_shifts_sched_today_3) as canv_shifts_sched_today_3
                                                            , sum(phone_shifts_sched_today) as phone_shifts_sched_today
                                                            , sum(phone_shifts_completed) as phone_shifts_completed
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
                                                        group by region
                                                        order by region asc
                                                        )a on a.region=dd.region

                                                        left join (select region
                                                            , sum(canv_shifts_sched_today_1) as canv_shifts_sched_today_1
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_1
                                                        from(
                                                        select m.*
                                                            , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                            , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                            (select @rank := 1) r , 
                                                            (select @sl :='') s
                                                        where date = current_date
                                                        and report = 'Shift 1'
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        group by region
                                                        order by region asc
                                                        )s1 on s1.region=dd.region

                                                        left join (select region
                                                            , sum(canv_shifts_sched_today_2) as canv_shifts_sched_today_2
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_2
                                                            , sum(vols_returned_snapshot) as vols_returned_1
                                                        from(
                                                        select m.*
                                                            , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                            , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                            (select @rank := 1) r , 
                                                            (select @sl :='') s
                                                        where date = current_date
                                                        and report = 'Shift 2'
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        group by region
                                                        order by region asc
                                                        )s2 on s2.region=dd.region

                                                        left join (
                                                        select region
                                                            , sum(canv_shifts_sched_today_3) as canv_shifts_sched_today_3
                                                            , sum(walk_pckts_out) as walk_pckts_out
                                                            , sum(vols_knocking_snapshot) as vols_knocking_3
                                                            , sum(vols_returned_snapshot) as vols_returned_2
                                                        from(
                                                        select m.*
                                                            , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                            , @sl := staging_location as sl_var

                                                        from master_db.master_metrics_table m, 
                                                            (select @rank := 1) r , 
                                                            (select @sl :='') s
                                                        where date = current_date
                                                        and report = 'Shift 3'
                                                        order by staging_location asc, time desc
                                                        )a
                                                        left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                        where rank=1
                                                        group by region
                                                        order by region asc
                                                        )s3 on s3.region=dd.region"
                                                        ;



                                                    $reg_result = mysqli_query($db, $reg_query);

                                                
                                                    $reg_shift = array();
                                                    
                                                    while ($reg_row = mysqli_fetch_array($reg_result,MYSQL_ASSOC)) {
                                                           
                                                            $reg_shift[] = $reg_row;
                                                            
                                                            if($reg_row['canv_shifts_sched_today_1'] == 0) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            elseif($reg_row['canv_shifts_sched_today_1'] == NULL) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            elseif($reg_row['vols_knocking_1'] == NULL) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_1_flake = round((1 - ($reg_row['vols_knocking_1'] / $reg_row['canv_shifts_sched_today_1'])) * 100,1) . "%";
                                                            }

                                                            if($reg_row['canv_shifts_sched_today_2'] == 0) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            elseif($reg_row['canv_shifts_sched_today_2'] == NULL) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            elseif($reg_row['vols_knocking_2'] == NULL) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_2_flake = round((1 - ($reg_row['vols_knocking_2'] / $reg_row['canv_shifts_sched_today_2'])) * 100,1) . "%";
                                                            }
                                                            
                                                            if($reg_row['canv_shifts_sched_today_3'] == 0) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            elseif($reg_row['canv_shifts_sched_today_3'] == NULL) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            elseif($reg_row['vols_knocking_3'] == NULL) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_3_flake = round((1 - ($reg_row['vols_knocking_3'] / $reg_row['canv_shifts_sched_today_3'])) * 100,1) . "%";
                                                            }

                                                            if($reg_row['phone_shifts_sched_today'] == NULL){
                                                                $phone_flake = NULL;
                                                            }
                                                            else{
                                                                $phone_flake = round((1 - ($reg_row['phone_shifts_completed'] / $reg_row['phone_shifts_sched_today'])) * 100,1) . "%"; 
                                                            }
                                                            
                                                        
                                                    
                                                    echo '<tr>';

                                                           echo '<td>' . $reg_row['region'] . '</td>'; 
                                                        
                                                    //open_status    
                                                        if($reg_row['open_loc'] == NULL) {
                                                            echo '<td style="text-align:center;" class="red">' . '0' . ' / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                        elseif($reg_row['open_loc'] >= 1) {
                                                            echo '<td style="text-align:center;" class="green">' . $reg_row['open_loc'] . ' / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                        else {
                                                            echo '<td style="text-align:center;" class="red">' . $reg_row['open_loc'] . ' / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                     
                                                            echo '<td style="text-align:center;">' . $reg_row['walk_pckts_out'] . '</td>';
                                                         
                                                            echo '<td style="text-align:center;" >' . $reg_row['vols_knocking_snapshot'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_today_1'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['vols_knocking_1'] . '</td>';
                                                          
                                                            if($shift_1_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_1_flake . '</td>';
                                                            }
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['vols_returned_1'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_today_2'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['vols_knocking_2'] . '</td>';
                                                          
                                                            if($shift_2_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_2_flake . '</td>';
                                                            }
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['vols_returned_2'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_today_3'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['vols_knocking_3'] . '</td>';
                                                          
                                                            if($shift_3_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_3_flake . '</td>';
                                                            }
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_sched_today'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $phone_flake . '</td>';
                                                         
                                                    echo '</tr>';
                                                     }


                                    ?>
                                    
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

<?php 
    $db = mysqli_connect("domain", "user", "pw", "database")
        or die("Can't connect to database".mysql_error());

        $rselect_query = "select distinct region from master_db.dynamic_dropdown";
        $rselect_result = mysqli_query($db, $rselect_query);

        $selected_region = mysqli_real_escape_string($db, $_GET["id"]);

        if (isset($_GET["id"])) {        
                $where_clause = "where region = '" . $selected_region . "'";
                $regionname = ': ' . $selected_region;
            }
        else {
            $where_clause = '';
            $regionname = '';
        } 
?>

                <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <strong>Staging Location Activity<?php echo $regionname ?></strong>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i></i> Select Region<i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-alerts">
                                        <li>
                                            <a href="shift_report.php">
                                                <div>
                                                    <i class="fa fa-tasks fa-fw"></i> Statewide
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <?php
                                        while ($rselect_row = mysqli_fetch_array($rselect_result,MYSQL_ASSOC)) {
                                            echo '<li>';
                                            echo '<a href="shift_report.php?id=' . $rselect_row['region'] . '#dataTables-example">';
                                            echo '<div>';
                                            echo '<i class="fa fa-users fa-fw"></i> ' . $rselect_row['region'];
                                            echo '</div>';
                                            echo '</a>';
                                            echo '</li>';
                                            echo '<li class="divider"></li>';
                                            
                                        }   

                                        ?>    
                                        
                                    </ul>
                                    <!-- /.dropdown-alerts -->
                                </li>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="dataTables-example">
                                    <thead>
                                        <tr>
                                           <th class="col-lg-2">Staging Location</th>
                                            <th style='text-align:center;'>Open Status</th>
                                            <th style='text-align:center;'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;'>Canvassers Sent Out</th>
                                            <th style='text-align:center;'>Shift 1 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 1 Vols Out</th>
                                            <th style='text-align:center;'>Shift 1 Flake Rate</th>
                                            <th style='text-align:center;'>Shift 1 Vols Returned</th>
                                            <th style='text-align:center;'>Shift 2 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 2 Vols Out</th>
                                            <th style='text-align:center;'>Shift 2 Flake Rate</th>
                                            <th style='text-align:center;'>Shift 2 Vols Returned</th>
                                            <th style='text-align:center;'>Shift 3 Shifts Sched</th>
                                            <th style='text-align:center;'>Shift 3 Vols Out</th>
                                            <th style='text-align:center;'>Shift 3 Flake Rate</th>
                                            <th style='text-align:center;'>Phone Shfts Sched</th>
                                            <th style='text-align:center;'>Phone Shifts Completed</th>
                                            <th style='text-align:center;'>Intraday Flake Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 



                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                        or die("Can't connect to database".mysql_error());

                                            


                                            $sl_query = "select sl
                                                            , most_recent_report
                                                            , a.open_status
                                                            , a.walk_pckts_out
                                                            , a.vols_knocking_snapshot
                                                            , a.canv_shifts_sched_today_1
                                                            , s1.vols_knocking_1
                                                            , s2.vols_returned_1
                                                            , a.canv_shifts_sched_today_2
                                                            , s2.vols_knocking_2
                                                            , s3.vols_returned_2
                                                            , a.canv_shifts_sched_today_3
                                                            , s3.vols_knocking_3
                                                            , a.phone_shifts_sched_today
                                                            , a.phone_shifts_completed



                                                    from (select * from master_db.dynamic_dropdown " . $where_clause . " )dd
                                                    left join (
                                                    select region
                                                        , staging_location
                                                        , report as most_recent_report
                                                        , open_status
                                                        , walk_pckts_out
                                                        , vols_knocking_snapshot
                                                        , canv_shifts_sched_today_1
                                                        , canv_shifts_sched_today_2
                                                        , canv_shifts_sched_today_3
                                                        , phone_shifts_sched_today
                                                        , phone_shifts_completed
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
                                                    order by staging_location asc
                                                    )a on a.staging_location=dd.sl

                                                    left join (
                                                    select region
                                                        , staging_location
                                                        , report
                                                        , open_status
                                                        , canv_shifts_sched_today_1
                                                        , walk_pckts_out
                                                        , vols_knocking_snapshot as vols_knocking_1
                                                    from(
                                                    select m.*
                                                        , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                        , @sl := staging_location as sl_var

                                                    from master_db.master_metrics_table m, 
                                                        (select @rank := 1) r , 
                                                        (select @sl :='') s
                                                    where date = current_date
                                                    and report = 'Shift 1'
                                                    order by staging_location asc, time desc
                                                    )a
                                                    left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                    where rank=1
                                                    order by staging_location asc
                                                    )s1 on s1.staging_location=dd.sl

                                                    left join (select region
                                                        , staging_location
                                                        , report
                                                        , open_status
                                                        , canv_shifts_sched_today_2
                                                        , walk_pckts_out
                                                        , vols_knocking_snapshot as vols_knocking_2
                                                        , vols_returned_snapshot as vols_returned_1
                                                    from(
                                                    select m.*
                                                        , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                        , @sl := staging_location as sl_var

                                                    from master_db.master_metrics_table m, 
                                                        (select @rank := 1) r , 
                                                        (select @sl :='') s
                                                    where date = current_date
                                                    and report = 'Shift 2'
                                                    order by staging_location asc, time desc
                                                    )a
                                                    left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                    where rank=1
                                                    order by staging_location asc
                                                    )s2 on s2.staging_location=dd.sl

                                                    left join (
                                                    select region
                                                        , staging_location
                                                        , report
                                                        , open_status
                                                        , canv_shifts_sched_today_2
                                                        , walk_pckts_out
                                                        , vols_knocking_snapshot as vols_knocking_3
                                                        , vols_returned_snapshot as vols_returned_2
                                                    from(
                                                    select m.*
                                                        , @rank := if(@sl = staging_location, @rank + 1, 1) as rank
                                                        , @sl := staging_location as sl_var

                                                    from master_db.master_metrics_table m, 
                                                        (select @rank := 1) r , 
                                                        (select @sl :='') s
                                                    where date = current_date
                                                    and report = 'Shift 3'
                                                    order by staging_location asc, time desc
                                                    )a
                                                    left join master_db.dynamic_dropdown dd on dd.sl=a.staging_location
                                                    where rank=1
                                                    order by staging_location asc
                                                    )s3 on s3.staging_location=dd.sl"
                                                        ;



                                                    $sl_result = mysqli_query($db, $sl_query);

                                                
                                                    $sl_shift = array();
                                                    
                                                    while ($sl_row = mysqli_fetch_array($sl_result,MYSQL_ASSOC)) {
                                                           

                                                            $sl_shift[] = $sl_row;
                                                            

                                                            if($sl_row['canv_shifts_sched_today_1'] == 0) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            elseif($sl_row['canv_shifts_sched_today_1'] == NULL) {
                                                                $shift_1_flake = NULL;
                                                            }
                                                            elseif($sl_row['vols_knocking_1'] == NULL) {
                                                                $shift_1_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_1_flake = round((1 - ($sl_row['vols_knocking_1'] / $sl_row['canv_shifts_sched_today_1'])) * 100,1) . "%";
                                                            }

                                                            if($sl_row['canv_shifts_sched_today_2'] == 0) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            elseif($sl_row['canv_shifts_sched_today_2'] == NULL) {
                                                                $shift_2_flake = NULL;
                                                            }
                                                            elseif($sl_row['vols_knocking_2'] == NULL) {
                                                                $shift_2_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_2_flake = round((1 - ($sl_row['vols_knocking_2'] / $sl_row['canv_shifts_sched_today_2'])) * 100,1) . "%";
                                                            }
                                                            
                                                            if($sl_row['canv_shifts_sched_today_3'] == 0) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            elseif($sl_row['canv_shifts_sched_today_3'] == NULL) {
                                                                $shift_3_flake = NULL;
                                                            }
                                                            elseif($sl_row['vols_knocking_3'] == NULL) {
                                                                $shift_3_flake = NULL; 
                                                            }
                                                            else{
                                                                $shift_3_flake = round((1 - ($sl_row['vols_knocking_3'] / $sl_row['canv_shifts_sched_today_3'])) * 100,1) . "%";
                                                            }

                                                            if($sl_row['phone_shifts_sched_today'] == NULL){
                                                                $phone_flake = NULL;
                                                            }
                                                            else{
                                                                $phone_flake = round((1 - ($sl_row['phone_shifts_completed'] / $sl_row['phone_shifts_sched_today'])) * 100,1) . "%"; 
                                                            }
                                                            
                                                        
                                                    
                                                    echo '<tr>';

                                                           echo '<td>' . $sl_row['sl'] . '</td>'; 
                                                        
                                                    //open_status    
                                                        if($sl_row['open_status'] == 'Open') {
                                                            echo '<td style="text-align:center;" class="green">' . $sl_row['open_status'] . '</td>';
                                                        }
                                                        
                                                        else {
                                                            echo '<td style="text-align:center;" class="red">Closed</td>';
                                                        }
                                                     
                                                            echo '<td style="text-align:center;">' . $sl_row['walk_pckts_out'] . '</td>';
                                                         
                                                            echo '<td style="text-align:center;" >' . $sl_row['vols_knocking_snapshot'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_sched_today_1'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $sl_row['vols_knocking_1'] . '</td>';
                                                          
                                                            if($shift_1_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_1_flake . '</td>';
                                                            }
                                                             
                                                            echo '<td style="text-align:center;">' . $sl_row['vols_returned_1'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_sched_today_2'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $sl_row['vols_knocking_2'] . '</td>';
                                                          
                                                            if($shift_2_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_2_flake . '</td>';
                                                            }
                                                             
                                                            echo '<td style="text-align:center;">' . $sl_row['vols_returned_2'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['canv_shifts_sched_today_3'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $sl_row['vols_knocking_3'] . '</td>';
                                                          
                                                            if($shift_3_flake < 0){
                                                                echo '<td style="text-align:center;">0%</td>';
                                                            }
                                                            else {
                                                            echo '<td style="text-align:center;">' . $shift_3_flake . '</td>';
                                                            }
                                                            
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_shifts_sched_today'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $sl_row['phone_shifts_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $phone_flake . '</td>';
                                                         
                                                    echo '</tr>';
                                                     }


                                    ?>
                                    
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
