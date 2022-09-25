<?php

date_default_timezone_set('Asia/Jakarta');
//error_reporting(0);

// web
$cfg_webname = "FAQCINE";
$cfg_baseurl = "";
$cfg_desc = "Monioring Vaksinasi Gratis!";
$cfg_author = "Rajawali Code";
$cfg_logo_txt = "Monitoring Vaksinasi";
$cfg_registerurl = "http://m2a-infectvisualiz.tk/daftar.php";
$cfg_about = " Monitoring Vaksinasi Gratis!";

// database
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "rajawalicode";

// date & time
$date = date("Y-m-d");
$time = date("H:i:s");

// require
require("lib/database.php");
require("lib/function.php");