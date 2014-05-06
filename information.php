<!DOCTYPE HTML>
<html>
    <head>
		<meta charset="UTF-8">
        <title>information.php</title>
        <style type="text/css">
            body {
                font-family: arial;
                font-size: 13px;
            }
        </style>
        <link href="css/common.css" rel="stylesheet" type="text/css" />
        <link href="css/information.css" rel="stylesheet" type="text/css" />
        <?php
            print '<script type="text/javascript" src="jQuery/jquery-1.7.1.min.js"></script>';
            print '<script type="text/javascript" src="jQuery/jquery.easing.1.3.js"></script>';
            print '<script type="text/javascript" src="jQuery/jquery.easing.compatibility.js"></script>';
        ?>
        <script type="text/javascript">
            jQuery(document).ready(
                function()
                {
                    jQuery("#block_data_1").hide();
					jQuery("#block_data_2").hide();
					jQuery("#block_data_3").hide();
                    jQuery("#block_data_4").hide();
                }
            );
        </script>
		
    </head>
    <body id="body_id" class="body_common">
        <?php
            //error_reporting(0);
            include('include/header.php');
            
            print '<div id="container">';
            
            /*+----------------------------------------------+
             *|         Displaying sytem information         |
             *+----------------------------------------------+
             */
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
				
				include('include/System_Information.php');
				$object = new System_Information($_POST['host_address']);
				if($object->data_fetched == 'no')
				{
					print '<div id="host_down">ERROR. HOST IS PROBABLY DOWN OR HAS SNMP SERVICE TURNED OFF</div>';
					die();
				}
				$data_array = $object->get_data_array();
				//----------------------------------------------------------------
				print '<div id="operation_system" class="information">';
					$operating_system_name = $object->get_operating_system();
					print $_POST['host_address'].' is running <span id="operating_system_name">'.$operating_system_name.'</span> operating system';
				print '</div>';
				//----------------------------------------------------------------
				$i = 1;
				print '<div id="system_information" class="information">';
					
					print '<div id="block_header_id_1" class="block_header">';
						print '<span class="click">click for </span><a href="#">System Information</a>';
					print '</div>';
					
					print '<div id="block_data_1" class="block_data">';
						foreach($data_array as $key => $value)
						{
							print '<div id="row_id_'.$i.'" class="row">';
								print '<div id="col_id_1" class="col_left">';
									print $key;
								print '</div>';
								print '<div id="col_id_2" class="col_right">';
									print $value;
								print '</div>';
							print '</div>';
							$i = $i + 1;
						}
					print '</div>';
					
				print '</div>';
				
				/*+----------------------------------------------+
				*|         Displaying storage information        |
				*+-----------------------------------------------+
				*/
				if($operating_system_name != 'unknown')
				{
					$object = null;
					include('include/Data_Storage.php');
					$object = new Data_Storage($operating_system_name, $_POST['host_address']);
					if($object->data_fetched == 'yes')
					{
						print '<div id="storage_information" class="information">';
						
							print '<div id="block_header_id_2" class="block_header">';
								print '<span class="click">click for </span><a href="#">Storage Information</a>';
							print '</div>';
							
							print '<div id="block_data_2" class="block_data">';
							
								$data_array = null;
								$data_array = $object->get_data_array();
								$row_number = count($data_array[0]);
								for($i=0; $i<$row_number; $i++)
								{
									$allocation_unit = $data_array[2][$i];
									if($allocation_unit == '0')
									{
										$used  = 0;
										$total = 0;
									}
									else
									{
										$divide_unit     = 1024*1024*1024;
										$used            = $data_array[4][$i]*$allocation_unit;
										$total           = $data_array[3][$i]*$allocation_unit;
										$used            = round($used/$divide_unit, 1);
										$total           = round($total/$divide_unit, 1);
									}
									print '<div id="row_number_'.($i+1).'" class="row">';
										print '<span class="drive_description"><b>'.$data_array[1][$i].'</b></span><br>';
										//print ($total - $used).' GB free of '.$total.' GB</br>';
										print '<span class="total_and_free">'.$used.' GB used Total ( '.$total.' GB )</span></br>';
									print '</div>';
									
									print '<div id="row_number_'.($i+1).'_image" class="row row_drive">';
										print '<div class="disk">';
											//$total = round($total, 0);
											//$used  = round($used, 0);
											$length_percentage = round(($used*100)/$total)*4;
											print '<div class="disk_used" style="width: '.$length_percentage.'px;">';
											print '</div>';
										print '</div>';
									print '</div>';
								}
							print '</div>';
							
						print '</div>';
					}
				}
								
				/*+----------------------------------------------+
				*|         Displaying running applications       |
				*+-----------------------------------------------+
				*/
				
				//----------------------------------------------------------------
				
				if($operating_system_name != 'unknown')
				{
					$object = null;
					include('include/Running_Applications.php');
					$object = new Running_Applications($operating_system_name, $_POST['host_address']);
					
					if($object->data_fetched == 'yes')
					{
						print '<div id="running_applications" class="information">';
				
							print '<div id="block_header_id_3" class="block_header">';
								print '<span class="click">click for </span><a href="#">Running applications</a>';
							print '</div>';
					
							print '<div id="block_data_3" class="block_data">';
							
								$data_array = null;
								$data_array = $object->get_data_array();
								print '<div id="row_title" class="row">';
									print '<div class="col col_start">';
										print '<b>Application name</b>';
									print '</div>';
									print '<div class="col">';
										print '<b>Memory</b>';
									print '</div>';
									print '<div class="col">';
										print '<b>Application type</b>';
									print '</div>';
									print '<div class="col">';
										print '<b>Run status</b>';
									print '</div>';
								print '</div>';
								
								$row_number = count($data_array[0]);
								for($i=0; $i<$row_number; $i++)
								{
									print '<div id="row_number_'.($i+1).'" class="row">';
										print '<div class="col col_start">';
											print $data_array[0][$i];
										print '</div>';
										print '<div class="col">';
											print $data_array[1][$i];
										print '</div>';
										print '<div class="col">';
											print $data_array[2][$i];
										print '</div>';
										print '<div class="col">';
											print $data_array[3][$i];
										print '</div>';
									print '</div>';
								}
								
							print '</div>';
				
						print '</div>';
					}
					
				}
				
				//----------------------------------------------------------------
                
                /*+----------------------------------------------+
				*|       Displaying installed information        |
				*+-----------------------------------------------+
				*/
				if($operating_system_name != 'unknown')
				{
					$object = null;
					include('include/Installed_Information.php');
					$object = new Installed_Information($operating_system_name, $_POST['host_address']);
					if($object->data_fetched == 'yes')
					{
						print '<div id="installed_information" class="information">';
						
							print '<div id="block_header_id_4" class="block_header">';
								print '<span class="click">click for </span><a href="#">Installed Information</a>';
							print '</div>';
							
							print '<div id="block_data_4" class="block_data">';
							
								$data_array = null;
								$data_array = $object->get_data_array();
								for($i=0; $i<count($data_array[0]); $i++)
                                {
                                    $installation_date = explode(',', $data_array[2][$i])[0];
                                    $installation_time = explode('.', explode(',', $data_array[2][$i])[1])[0];
                                    print '<div class="installed_application_class">';
                                        print '<b>'.$data_array[1][$i].'</b><br>';
                                        print 'Installation date : '.$installation_date.'<br>';
                                        print 'Installation time : '.$installation_time.'<br>';
                                    print '</div>';
                                }
                                
							print '</div>';
							
						print '</div>';
					}
				}
				
            }
            else
            {
                /*
                 * If someone tries to add GET variables with the URL redirect to index.php
                 */
                header('Location: index.php');
                
            }

            print '</div>';
            
            include('include/footer.php');
        ?>
		<script>
			var showExperiments_1 = true;
			var showExperiments_2 = true;
			var showExperiments_3 = true;
            var showExperiments_4 = true;
		</script>
		<script>
			
            jQuery("#block_header_id_1").click(
                function()
                {
                    if(showExperiments_1 == true)
                    {
                        jQuery("#block_data_1").slideDown(1000);
						jQuery("#block_header_id_1").css({
							'text-shadow': '2px 2px 2px #69e420'
						});
						jQuery("#block_header_id_1 .click").hide();
                        showExperiments_1 = false;
                    }
                    else
                    {
                        jQuery("#block_data_1").slideUp(1000);
						jQuery("#block_header_id_1").css({
							'text-shadow': '2px 2px 2px #808080'
						});
						jQuery("#block_header_id_1 .click").show();
                        showExperiments_1 = true;
                    }
                }
            );
		</script>
		
		<script>
			
            jQuery("#block_header_id_2").click(
                function()
                {
                    if(showExperiments_2 == true)
                    {
                        jQuery("#block_data_2").slideDown(2000);
						jQuery("#block_header_id_2").css({
							'text-shadow': '2px 2px 2px #69e420'
						});
						jQuery("#block_header_id_2 .click").hide();
                        showExperiments_2 = false;
                    }
                    else
                    {
                        jQuery("#block_data_2").slideUp(2000);
						jQuery("#block_header_id_2").css({
							'text-shadow': '2px 2px 2px #808080'
						});
						jQuery("#block_header_id_2 .click").show();
                        showExperiments_2 = true;
                    }
                }
            );
		</script>
		
		<script>
			
            jQuery("#block_header_id_3").click(
                function()
                {
                    if(showExperiments_3 == true)
                    {
                        jQuery("#block_data_3").slideDown(2000);
						jQuery("#block_header_id_3").css({
							'text-shadow': '2px 2px 2px #69e420'
						});
						jQuery("#block_header_id_3 .click").hide();
                        showExperiments_3 = false;
                    }
                    else
                    {
                        jQuery("#block_data_3").slideUp(2000);
						jQuery("#block_header_id_3").css({
							'text-shadow': '2px 2px 2px #808080'
						});
						jQuery("#block_header_id_3 .click").show();
                        showExperiments_3 = true;
                    }
                }
            );
		</script>
        <script>
			
            jQuery("#block_header_id_4").click(
                function()
                {
                    if(showExperiments_4 == true)
                    {
                        jQuery("#block_data_4").slideDown(2000);
						jQuery("#block_header_id_4").css({
							'text-shadow': '2px 2px 2px #69e420'
						});
						jQuery("#block_header_id_4 .click").hide();
                        showExperiments_4 = false;
                    }
                    else
                    {
                        jQuery("#block_data_4").slideUp(2000);
						jQuery("#block_header_id_4").css({
							'text-shadow': '2px 2px 2px #808080'
						});
						jQuery("#block_header_id_4 .click").show();
                        showExperiments_4 = true;
                    }
                }
            );
		</script>
    </body>
</html>