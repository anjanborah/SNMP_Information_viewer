<?php
    class Data_Storage
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
            $hrStorageIndex = array();
            $hrStorageIndex = snmpwalkoid($this->host_address, "public", ".iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTable.hrStorageEntry.hrStorageIndex");
            if($hrStorageIndex != FALSE)
            {
                if(count($hrStorageIndex) > 0)
                {
                    $this->data_fetched = 'yes';
                    
                    $storage_index            = array();
                    $storage_description      = array();
                    $storage_allocation_units = array();
                    $storage_size             = array();
                    $storage_used             = array();
                    $i = 0;
                    foreach($hrStorageIndex as $key => $value)
                    {
                        $storage_index[$i] = str_replace('INTEGER: ', '', $value);
                        $i = $i + 1;
                    }
                    $hrStorageIndex = null;
                    for($i=0; $i<count($storage_index); $i++)
                    {
                        $data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTable.hrStorageEntry.hrStorageDescr.'.$storage_index[$i], 300);
                        $data = str_replace('STRING: ', '', $data);
                        $storage_description[$i] = $data;
                    }
                    for($i=0; $i<count($storage_index); $i++)
                    {
                        $data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTable.hrStorageEntry.hrStorageAllocationUnits.'.$storage_index[$i], 300);
                        $data = str_replace('INTEGER: ', '', $data);
                        $data = str_replace(' Bytes', '', $data);
                        $storage_allocation_units[$i] = $data;
                    }
                    for($i=0; $i<count($storage_index); $i++)
                    {
                        $data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTable.hrStorageEntry.hrStorageSize.'.$storage_index[$i], 300);
                        $data = str_replace('INTEGER: ', '', $data);
                        $storage_size[$i] = $data;
                    }
                    for($i=0; $i<count($storage_index); $i++)
                    {
                        $data = snmpget($this->host_address, 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTable.hrStorageEntry.hrStorageUsed.'.$storage_index[$i], 300);
                        $data = str_replace('INTEGER: ', '', $data);
                        $storage_used[$i] = $data;
                    }
                    
                    $this->data_array[0] = $storage_index;
                    $this->data_array[1] = $storage_description;
                    $this->data_array[2] = $storage_allocation_units;
                    $this->data_array[3] = $storage_size;
                    $this->data_array[4] = $storage_used;
                    
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