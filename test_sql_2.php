													<html>
													<body>
													<?php	
													$sl = 'Staging Location D';
													
													$db = pg_connect("host=localhost dbname=postgres user=wbw4 password=")
				                                    or die("Can't connect to database".pg_last_error());
                                                    

					                                $sl_q = pg_query($db, "select * from public.test_table_no_data");
					                                $sl_check = pg_fetch_array($sl_q, null ,PGSQL_ASSOC);


					                                ?>
					                            </body>
					                            </html>