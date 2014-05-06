<?php
    class index_page_form
    {
        public function __construct()
        {
            $this->display_form();
        }
        private function display_form()
        {
            print '<div id="index_page_form">';
                print '<form action="information.php" method="POST">';
                    print '<div id="block_1" class="block">';
                        print '<div id="sub_block_1">Enter the host name or IP address<br></div>';
                    print '</div>';
                    print '<div id="block_2" class="block">';
                        print '<div id="sub_block_2"><input type="text" name="host_address" id="host_address"></div>';
                    print '</div>';
                    print '<div id="block_3" class="block">';
                        print '<div id="sub_block_3"><input type="submit" name="submit" value="search" id="submit_button"></div>';
                    print '</div>';
                print '</form>';
            print '</div>';
        }
        public function __destruct()
        {
            /*
             * No code needed here
             */
        }
    }
?>