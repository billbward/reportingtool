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
                <a class="navbar-brand" href="activity_report.php">BGTX Soft Reporting Tool</a>
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
                        <li class="divider"></li>
                        <li>
                            <a href="pass_to_home.php">
                                <div>
                                    <i class="fa fa-check fa-fw"></i> Reporting Tool - Enter A Report
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
                    <h1 class="page-header" style="text-align:center;">Statewide Activity Report</h1>
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

                                <script>
                                $(document).ready(function() {
                                
                                    $('#test').DataTable({
                                        searching: true
                                        ordering: true
                                        paging: true
                                    });
                                    
                                    } );
                                </script> 
                                <table class="table table-hover table-striped" id="test">
                                    <thead>
                                        <tr>
                                           <th class="col-lg-2">State</th>
                                            <th style='text-align:center;'>Locations Open</th>
                                            <th style='text-align:center;'>Canv Shifts Today</th>
                                            <th style='text-align:center;'>Phone Shifts Today</th>
                                            <th style='text-align:center;'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;'>Canv Shifts Completed</th>
                                            <th style='text-align:center;'>Canv Att Completed</th>
                                            <th style='text-align:center;'>Att Per Shift</th>
                                            <th style='text-align:center;'>CTV Collected</th>
                                            <th style='text-align:center;'>Phone Shifts Completed</th>
                                            <th style='text-align:center;'>Phone Att Completed</th>
                                            <th style='text-align:center;'>Att Per Shift</th>
                                            <th style='text-align:center;'>Canvass Shifts Recruited</th>
                                            <th style='text-align:center;'>Phone Shifts Recruited</th>
                                            <th style='text-align:center;'>Canv Shifts Tmrw</th>
                                            <th style='text-align:center;'>Phone Shifts Tmrw</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                        or die("Can't connect to database".mysql_error());
                                                                                                                                                        

                                                    $reg_query = "select a.*
                                                                    , sc.sl_count
                                                            from(
                                                            select 'Texas' as statewide
                                                                    
                                                                    , sum(case when open_status = 'Open' then 1 else 0 end) as open_loc
                                                                    , sum(canv_shifts_sched_today_1) + sum(canv_shifts_sched_today_2) + sum(canv_shifts_sched_today_3)  as canv_shifts_sched_today_total
                                                                    , sum(phone_shifts_sched_today) as phone_shifts_sched_today
                                                                    , sum(walk_pckts_out) as walk_pckts_out
                                                                    , sum(canv_shifts_completed) as canv_shifts_completed
                                                                    , sum(canv_att_completed) as canv_att_completed
                                                                    , case when sum(canv_shifts_completed) = 0 then '-'
                                                                        else round(sum(canv_att_completed) / sum(canv_shifts_completed),0) end as canv_att_per_shift
                                                                    , sum(ctv_collected) as ctv_collected
                                                                    , sum(phone_shifts_completed) as phone_shifts_completed
                                                                    , sum(phone_att_completed) as phone_att_completed
                                                                    , case when sum(phone_shifts_completed) = 0 then '-'
                                                                        else round(sum(phone_att_completed) / sum(phone_shifts_completed),0) end as phone_att_per_shift
                                                                    , sum(canv_shifts_recruit_today) as canv_shifts_recruit_today
                                                                    , sum(phone_shifts_recruit_today) as phone_shifts_recruit_today
                                                                    , sum(canv_shifts_sched_tomorrow_1) + sum(canv_shifts_sched_tomorrow_2) + sum(canv_shifts_sched_tomorrow_3) as canv_shifts_sched_tomorrow_total
                                                                    , sum(phone_shifts_sched_tomorrow) as phone_shifts_sched_tomorrow

                                                            from (

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
                                                            group by 1
                                                            order by 1
                                                            )a
                                                            left join (select 'Texas' as statewide
                                                                            , count(distinct sl) as sl_count
                                                            from master_db.dynamic_dropdown
                                                            group by 1
                                                            order by 1
                                                            )sc on sc.statewide=a.statewide
                                                            order by 1"
                                                    ;



                                                    $reg_result = mysqli_query($db, $reg_query);

                                                
                                                    $reg_row = mysqli_fetch_array($reg_result,MYSQL_ASSOC);
                                                        
                                                    
                                                    echo '<tr>';

                                                           echo '<td>' . $reg_row['statewide'] . '</td>'; 
                                                        
                                                    //open_status  

                                                        if($reg_row['sl_count'] == NULL) {
                                                            //echo '<td style="text-align:center;">' . $reg_row['open_loc'] . '</td>';
                                                            
                                                        }
                                                        elseif($reg_row['open_loc'] >= 1) {
                                                            echo '<td style="text-align:center;" class="green">' . $reg_row['open_loc'] . ' / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                        else {
                                                            echo '<td style="text-align:center;" class="red">' . $reg_row['open_loc'] . ' / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                     
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_today_total'] . '</td>';
                                                         
                                                            echo '<td style="text-align:center;" >' . $reg_row['phone_shifts_sched_today'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['walk_pckts_out'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_att_completed'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_att_per_shift'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['ctv_collected'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_completed'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_att_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_att_per_shift'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_recruit_today'] . '</td>';
                                                           
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_recruit_today'] . '</td>';
                                                    
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_tomorrow_total'] . '</td>';
                                                        
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_sched_tomorrow'] . '</td>';
                                                         
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
                                <script>
                                
                                    $('#test').DataTable({
                                        searching: true
                                        ordering: true
                                        paging: true
                                    });
                                    
                                </script>
                                <table class="table table-hover table-striped" id="test">
                                    <thead>
                                        <tr>
                                           <th class="col-lg-2">Region</th>
                                            <th style='text-align:center;'>Locations Open</th>
                                            <th style='text-align:center;'>Canv Shifts Today</th>
                                            <th style='text-align:center;'>Phone Shifts Today</th>
                                            <th style='text-align:center;'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;'>Canv Shifts Completed</th>
                                            <th style='text-align:center;'>Canv Att Completed</th>
                                            <th style='text-align:center;'>Att Per Shift</th>
                                            <th style='text-align:center;'>CTV Collected</th>
                                            <th style='text-align:center;'>Phone Shifts Completed</th>
                                            <th style='text-align:center;'>Phone Att Completed</th>
                                            <th style='text-align:center;'>Att Per Shift</th>
                                            <th style='text-align:center;'>Canvass Shifts Recruited</th>
                                            <th style='text-align:center;'>Phone Shifts Recruited</th>
                                            <th style='text-align:center;'>Canv Shifts Tmrw</th>
                                            <th style='text-align:center;'>Phone Shifts Tmrw</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                        or die("Can't connect to database".mysql_error());
                                                                                                    

                                                    $reg_query = " select distinct dd.region
                                                                , dd.sl_count
                                                                , open_loc
                                                                , canv_shifts_sched_today_total
                                                                , phone_shifts_sched_today
                                                                , walk_pckts_out
                                                                , canv_shifts_completed
                                                                , canv_att_completed
                                                                , canv_att_per_shift
                                                                , ctv_collected
                                                                , phone_shifts_completed
                                                                , phone_att_completed
                                                                , phone_att_per_shift
                                                                , canv_shifts_recruit_today
                                                                , phone_shifts_recruit_today
                                                                , canv_shifts_sched_tomorrow_total
                                                                , phone_shifts_sched_tomorrow 
  
                                                                from (select region, count(distinct sl) as sl_count from master_db.dynamic_dropdown group by region) dd
                                                                left join (
                                                                select a.*
                                                                        , sc.sl_count
                                                                from(
                                                                select region
                                                                    
                                                                    , sum(case when open_status = 'Open' then 1 else 0 end) as open_loc
                                                                    , sum(canv_shifts_sched_today_1) + sum(canv_shifts_sched_today_2) + sum(canv_shifts_sched_today_3)  as canv_shifts_sched_today_total
                                                                    , sum(phone_shifts_sched_today) as phone_shifts_sched_today
                                                                    , sum(walk_pckts_out) as walk_pckts_out
                                                                    , sum(canv_shifts_completed) as canv_shifts_completed
                                                                    , sum(canv_att_completed) as canv_att_completed
                                                                    , case when sum(canv_shifts_completed) = 0 then '-'
                                                                        else round(sum(canv_att_completed) / sum(canv_shifts_completed),0) end as canv_att_per_shift
                                                                    , sum(ctv_collected) as ctv_collected
                                                                    , sum(phone_shifts_completed) as phone_shifts_completed
                                                                    , sum(phone_att_completed) as phone_att_completed
                                                                    , case when sum(phone_shifts_completed) = 0 then '-'
                                                                        else round(sum(phone_att_completed) / sum(phone_shifts_completed),0) end as phone_att_per_shift
                                                                    , sum(canv_shifts_recruit_today) as canv_shifts_recruit_today
                                                                    , sum(phone_shifts_recruit_today) as phone_shifts_recruit_today
                                                                    , sum(canv_shifts_sched_tomorrow_1) + sum(canv_shifts_sched_tomorrow_2) + sum(canv_shifts_sched_tomorrow_3) as canv_shifts_sched_tomorrow_total
                                                                    , sum(phone_shifts_sched_tomorrow) as phone_shifts_sched_tomorrow

                                                            from (

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
                                                            group by 1
                                                            order by 1
                                                            )a
                                                            left join (select region
                                                                            , count(distinct sl) as sl_count
                                                            from master_db.dynamic_dropdown
                                                            group by 1
                                                            order by 1
                                                            )sc on sc.region=a.region
                                                            order by 1
                                                            )b on b.region = dd.region"
                                                    ;



                                                    $reg_result = mysqli_query($db, $reg_query);

                                                
                                                    $reg_snapshot = array();
                                                    
                                                    while ($reg_row = mysqli_fetch_array($reg_result,MYSQL_ASSOC)) {
                                                           
                                                            $reg_snapshot[] = $reg_row;
                                                            
                                                    echo '<tr>';

                                                           echo '<td>' . $reg_row['region'] . '</td>'; 
                                                        
                                                    //open_status    
                                                        if($reg_row['open_loc'] >= 1) {
                                                            echo '<td style="text-align:center;" class="green">' . $reg_row['open_loc'] . ' / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                        else {
                                                            echo '<td style="text-align:center;" class="red"> 0 / ' . $reg_row['sl_count'] . '</td>';
                                                        }
                                                     
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_today_total'] . '</td>';
                                                         
                                                            echo '<td style="text-align:center;" >' . $reg_row['phone_shifts_sched_today'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['walk_pckts_out'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_att_completed'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_att_per_shift'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['ctv_collected'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_completed'] . '</td>';
                                                            
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_att_completed'] . '</td>';
                                                             
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_att_per_shift'] . '</td>';
                                                          
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_recruit_today'] . '</td>';
                                                           
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_recruit_today'] . '</td>';
                                                    
                                                            echo '<td style="text-align:center;">' . $reg_row['canv_shifts_sched_tomorrow_total'] . '</td>';
                                                        
                                                            echo '<td style="text-align:center;">' . $reg_row['phone_shifts_sched_tomorrow'] . '</td>';
                                                         
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
                $where_clause = "where dd.region = '" . $selected_region . "'";
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
                                            <a href="activity_report.php">
                                                <div>
                                                    <i class="fa fa-tasks fa-fw"></i> Statewide
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <?php
                                        while ($rselect_row = mysqli_fetch_array($rselect_result,MYSQL_ASSOC)) {
                                            echo '<li>';
                                            echo '<a href="activity_report.php?id=' . $rselect_row['region'] . '#dataTables-example">';
                                            echo '<div>';
                                            echo '<i class="fa fa-users fa-fw"></i> ' . $rselect_row['region'];
                                            echo '</div>';
                                            echo '</a>';
                                            echo '</li>';
                                            echo '<li class="divider"></li>';
                                            
                                        }   

                                        ?> 
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
                                            <th style='text-align:center;'>Canv Shifts Today</th>
                                            <th style='text-align:center;'>Phone Shifts Today</th>
                                            <th style='text-align:center;'>Walk Packets Sent Out</th>
                                            <th style='text-align:center;'>Canv Shifts Completed</th>
                                            <th style='text-align:center;'>Canv Att Completed</th>
                                            <th style='text-align:center;'>Att Per Shift</th>
                                            <th style='text-align:center;'>CTV Collected</th>
                                            <th style='text-align:center;'>Phone Shifts Completed</th>
                                            <th style='text-align:center;'>Phone Att Completed</th>
                                            <th style='text-align:center;'>Att Per Shift</th>
                                            <th style='text-align:center;'>Canvass Shifts Recruited</th>
                                            <th style='text-align:center;'>Phone Shifts Recruited</th>
                                            <th style='text-align:center;'>Canv Shifts Tmrw</th>
                                            <th style='text-align:center;'>Phone Shifts Tmrw</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                            $db = mysqli_connect("domain", "user", "pw", "database")
                                                        or die("Can't connect to database".mysql_error());


                                            $sl_query = "       select dd.region
                                                                , dd.sl as staging_location
                                                                , open_status
                                                                , canv_shifts_sched_today_total
                                                                , phone_shifts_sched_today
                                                                , walk_pckts_out
                                                                , canv_shifts_completed
                                                                , canv_att_completed
                                                                , canv_att_per_shift
                                                                , ctv_collected
                                                                , phone_shifts_completed
                                                                , phone_att_completed
                                                                , phone_att_per_shift
                                                                , canv_shifts_recruit_today
                                                                , phone_shifts_recruit_today
                                                                , canv_shifts_sched_tomorrow_total
                                                                , phone_shifts_sched_tomorrow
                                                        from master_db.dynamic_dropdown dd
                                                        left join(
                                                                select region
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
                                                        order by staging_location asc
                                                        )b on b.staging_location=dd.sl
                                                        " . $where_clause
                                                        ;



                                                    $sl_result = mysqli_query($db, $sl_query);

                                                
                                                    $sl_snapshot = array();
                                                    
                                                    while ($sl_row = mysqli_fetch_array($sl_result,MYSQL_ASSOC)) {
                                                           
                                                            $sl_snapshot[] = $sl_row;
                                                            
                                                    echo '<tr>';

                                                           echo '<td>' . $sl_row['staging_location'] . '</td>'; 
                                                        
                                                    //open_status    
                                                        if($sl_row['open_status'] == 'Open') {
                                                            echo '<td style="text-align:center;" class="green">' . $sl_row['open_status'] . '</td>';
                                                        }
                                                        else {
                                                            echo '<td style="text-align:center;" class="red">Closed</td>';
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
