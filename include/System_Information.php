<?php
error_reporting(0);
	class System_Information
	{
		public function __construct($host_address)
		{
		    $this->host_address = $host_address;
			$this->create_data_array();
		}
		private function create_data_array()
		{
			//---------- SYSTEM DESCRIPTION STARTS HERE
			if(snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysDescr.0', 300) != FALSE)
			{
				$this->data_fetched = 'yes';
				$data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysDescr.0', 300);
				if(strlen($data) == 0)
				{
					$data = '<span id="no_data_received">No data received</span>';
				}
				else
				{
					if($data == 'STRING: ')
					{
						$data = '<span id="no_data_received">No data received</span>';
					}
					else
					{
						if(substr_count($data, 'STRING: ') > 0)
                        {
                            $data = substr($data, strlen('STRING: '), strlen($data));
                        }
                        else
                        {
                            $data = $data;
                        }
						$data_lower = strtolower($data);
						if(substr_count($data_lower, 'windows') > 0)
						{
						    $this->operating_system = 'windows';
						}
						elseif(substr_count($data_lower, 'linux') > 0)
						{
						    $this->operating_system = 'linux';
						}
						else
						{
							$this->operating_system = 'unknown';	
						}
					}
				}
				$this->data_array['system description'] = $data;
			}
			else
			{
				$this->data_array['system description'] = '<span id="no_data_received">Error in fetching the object data</span>';
				$this->data_fetched = 'no';
			}
			//---------- SYSTEM DESCRIPTION ENDS HERE
			
			//---------- SYSTEM UP TIME STARTS HERE
			if(snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysUpTime.sysUpTimeInstance', 300) != FALSE)
			{
				$this->data_fetched = 'yes';
				$data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysUpTime.sysUpTimeInstance', 300);
				if(strlen($data) == 0)
				{
					$data = '<span id="no_data_received">No data received</span>';
				}
				else
				{
					if($data == 'STRING: ')
					{
						$data = '<span id="no_data_received">No data received</span>';
					}
					else
					{
						if(substr_count($data, 'STRING: ') > 0)
                        {
                            $data = substr($data, strlen('STRING: '), strlen($data));
                        }
                        else
                        {
                            $data = $data;
                        }
					}
				}
				$this->data_array['system up time'] = $data;
			}
			else
			{
				$this->data_array['system up time'] = '<span id="no_data_received">Error in fetching the object data</span>';
				$this->data_fetched = 'no';
			}
			//---------- SYSTEM UP TIME ENDS HERE
			
			//---------- SYSTEM CONTACT INFORMATION STARTS HERE
			if(snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysContact.0', 300) != FALSE)
			{
				$this->data_fetched = 'yes';
				$data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysContact.0', 300);
				if(strlen($data) == 0)
				{
					$data = '<span id="no_data_received">No data received</span>';
				}
				else
				{
					if($data == 'STRING: ')
					{
						$data = '<span id="no_data_received">No data received</span>';
					}
					else
					{
						if(substr_count($data, 'STRING: ') > 0)
                        {
                            $data = substr($data, strlen('STRING: '), strlen($data));
                        }
                        else
                        {
                            $data = $data;
                        }
					}
				}
				$this->data_array['system contact information'] = $data;
			}
			else
			{
				$this->data_array['system contact information'] = '<span id="no_data_received">Error in fetching the object data</span>';
				$this->data_fetched = 'no';
			}
			//---------- SYSTEM CONTACT INFORMATION ENDS HERE
			
			//---------- SYSTEM NAME STARTS HERE
			if(snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysName.0', 300) != FALSE)
			{
				$this->data_fetched = 'yes';
				$data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysName.0', 300);
				if(strlen($data) == 0)
				{
					$data = '<span id="no_data_received">No data received</span>';
				}
				else
				{
					if($data == 'STRING: ')
					{
						$data = '<span id="no_data_received">No data received</span>';
					}
					else
					{
						if(substr_count($data, 'STRING: ') > 0)
                        {
                            $data = substr($data, strlen('STRING: '), strlen($data));
                        }
                        else
                        {
                            $data = $data;
                        }
					}
				}
				$this->data_array['system name'] = $data;
			}
			else
			{
				$this->data_array['system name'] = '<span id="no_data_received">Error in fetching the object data</span>';
				$this->data_fetched = 'no';
			}
			//---------- SYSTEM NAME ENDS HERE
			
			//---------- SYSTEM LOCATION STARTS HERE
			if(snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysLocation.0', 300) != FALSE)
			{
				$this->data_fetched = 'yes';
				$data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.system.sysLocation.0', 300);
				if(strlen($data) == 0)
				{
					$data = '<span id="no_data_received">No data received</span>';
				}
				else
				{
					if($data == 'STRING: ')
					{
						$data = '<span id="no_data_received">No data received</span>';
					}
					else
					{
						if(substr_count($data, 'STRING: ') > 0)
                        {
                            $data = substr($data, strlen('STRING: '), strlen($data));
                        }
                        else
                        {
                            $data = $data;
                        }
					}
				}
				$this->data_array['system location'] = $data;
			}
			else
			{
				$this->data_array['system location'] = '<span id="no_data_received">Error in fetching the object data</span>';
				$this->data_fetched = 'no';
			}
			//---------- SYSTEM LOCATION ENDS HERE
		}
		public function get_data_array()
		{
		    return $this->data_array;
		}
		public function get_operating_system()
		{
		    return $this->operating_system;
		}
		public function __destruct()
		{
			/*
			 * No code needed here
			 */
		}
		public $data_fetched;
		private $host_address;
		private $data_array = array();
		private $operating_system;
	}
?>