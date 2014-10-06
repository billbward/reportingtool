													<html>
													<body>

													<?php
													$sl = 'Staging Location D';
													
													$db = pg_connect("host=localhost dbname=postgres user=wbw4 password=")
				                                    or die("Can't connect to database".pg_last_error());

					                                $table_name = 'public.master_metrics_table_test';

					                                date_default_timezone_set('America/Chicago');
					                                $time = localtime(time(),true);

					                                $timestamp = sprintf("%02s",$time['tm_hour']) . ":" . sprintf("%02s",$time['tm_min']) . ":" . sprintf("%02s",$time['tm_sec']);
					                                $date = "2014-" . sprintf("%02s",$time['tm_mon']+1) . "-" . sprintf("%02s",$time['tm_mday']);
					                                $wday = $time['tm_wday'];
                                                    

					                                $sl_q = pg_query($db, "select distinct staging_location from public.master_metrics_table_test where date='" . $date . "'");
					                                $sl_check = pg_fetch_array($sl_q, null, PGSQL_ASSOC);

                                                    $result = pg_query($db, 
																				"select *

																				from(

																				select *
																				        , row_number() over (partition by staging_location, date order by time desc) as sl_entry_rank

																				from public.master_metrics_table_test
																				where staging_location='" . $sl .  "'
																				and date = '" . $date . "'
																				order by time desc
																				)a

																				where sl_entry_rank=1");

                                                        if (!$result) {
                                                            echo "An error occurred.\n";
                                                        exit;
                                                        }
                                                    

                                                    if(in_array($sl, $sl_check) == false) {
                                                    	$report = "First";
                                                    }
                                                    else{
                                                    $result_fetch = pg_fetch_array($result, null ,PGSQL_ASSOC);
                                                    $report = $result_fetch["report"]; 

                                                    echo $report; 
                                                    }


                                                    

                                                    ?>

                                                </body>
                                                </html>