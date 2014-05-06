<html>
    <head>
        <title>index.php</title>
        <style type="text/css">
            body {
                font-family: arial;
                font-size: 13px;
            }
        </style>
        <link href="css/common.css" rel="stylesheet" type="text/css" />
        <link href="css/index.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="body_id" class="body_common">
        <?php
            
            include('include/header.php');
            
            print '<div id="container">';
            
            /*+----------------------------------------------+
             *|            Displaying the form               |
             *+----------------------------------------------+
             */
            include('include/index_page_form.php');
            $object = new index_page_form();
            
            print '</div>';
            
            include('include/footer.php');
        ?>
    </body>
</html>