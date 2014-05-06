<html>
    <head>
        <title>index.php</title>
        <style type="text/css">
            body {
                font-family: arial;
                font-size: 13px;
            }
        </style>
    </head>
    <body id="snmp_body" class="body">
        <?php
            snmp_set_valueretrieval(SNMP_VALUE_LIBRARY);
            snmp_set_oid_output_format(SNMP_OID_OUTPUT_FULL);
            print '<pre>';
            print_r(snmpwalkoid("192.168.188.130", "public", ""));
            //print_r(snmpwalkoid("127.0.0.1", "public", ".iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTable.hrStorageEntry"));
            print '</pre>';
            
            print '<br><br>';
            print '<pre>';
            //print_r(snmpwalkoid("127.0.0.1", "public", ""));
            //print_r(snmpwalkoid("192.168.254.27", "public", ""));
            print '</pre>';
            
            //print snmpget('127.0.0.1', 'public', '.iso.org.dod.internet.mgmt.mib-2.host.hrStorage.hrStorageTypes.7', 300);
        ?>
    </body>
</html>