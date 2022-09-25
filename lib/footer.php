</div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2020 <b>FAQCINE</b> Create By Rajawali Code. All Right Reserved
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/popper.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/detect.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/fastclick.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/waves.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/morris/morris.min.js"></script>
		<script src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.core.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.app.js"></script>

    </body>
     <?php
$db_host = "localhost";
$MySQLi_CON = new MySQLi ($db_host, $db_user, $db_password, $db_name);
        if($MySQLi_CON->connect_errno)
            {
                die ("KESALAHAN : ->".$MySQLi_CON->connect_errno);
            }
$seminggulalu = date('Y-m-d', strtotime('-7 days', strtotime(date("Y-m-d"))));

    function dbrows_($tabel, $limit) {
        global $MySQLi_CON;
        $query = $MySQLi_CON->query("SELECT * FROM ".$tabel." WHERE ".$limit);
            
        $rows = $query->num_rows;
        return $rows;
        }

    function dbrowss_($tabel, $limit) {
        global $MySQLi_CON;
        $query = $MySQLi_CON->query("SELECT * FROM ".$tabel." WHERE ".$limit);
            
        $rows = $query->num_rows;
        return $rows;
        }
?>
</body>

</html>