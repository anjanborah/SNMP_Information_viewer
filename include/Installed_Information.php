<?php
    class Installed_Information
    {
        public function __construct($operating_system, $host_address)
        {
            $this->operating_system = $operating_system;
            $this->host_address     = $host_address;
            if($this->operating_system == 'windows')
            {
                $this->create_data_array();
            }
            if($this->operating_system == 'linux')
            {
                $this->create_data_array();
            }
        }
        private function create_data_array()
        {
            $hrSWInstalledIndex = array();
            $hrSWInstalledIndex = snmpwalkoid($this->host_address, "public", ".iso.org.dod.internet.mgmt.mib-2.host.hrSWInstalled.hrSWInstalledTable.hrSWInstalledEntry.hrSWInstalledIndex");
            if($hrSWInstalledIndex != FALSE)
            {
                if(count($hrSWInstalledIndex) > 0)
                {
                    $this->data_fetched = 'yes';
                    
                    $installed_index = array();
                    $installed_name  = array();
                    $installed_date  = array();
                    $i = 0;
                    foreach($hrSWInstalledIndex as $key => $value)
                    {
                        $installed_index[$i] = str_replace('INTEGER: ', '', $value);
                        $i = $i + 1;
                    }
                    $hrSWInstalledIndex = null;
                    for($i=0; $i<count($installed_index); $i++)
                    {
                        $data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrSWInstalled.hrSWInstalledTable.hrSWInstalledEntry.hrSWInstalledName.'.$installed_index[$i], 300);
                        $data = str_replace('STRING: ', '', $data);
                        $data = str_replace('"', '', $data);
                        $installed_name[$i] = $data;
                    }
                    for($i=0; $i<count($installed_index); $i++)
                    {
                        $data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrSWInstalled.hrSWInstalledTable.hrSWInstalledEntry.hrSWInstalledDate.'.$installed_index[$i], 300);
                        $data = str_replace('STRING: ', '', $data);
                        $installed_date[$i] = $data;
                    }
                    $this->data_array[0] = $installed_index;
                    $this->data_array[1] = $installed_name;
                    $this->data_array[2] = $installed_date;
                }
                else
                {
                    $this->data_fetched = 'no';
                }
            }
            else
            {
                
            }
        }
        public function get_data_array()
        {
            return $this->data_array;
        }
        public function __destruct()
        {
            /*
             * No code needed here
             */
        }
        public $data_fetched;
        private $data_array = array();
        private $operating_system;
        private $host_address;
    }
?>