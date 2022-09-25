<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
        
	}
	$jml_users = mysqli_num_rows(mysqli_query($db, "SELECT * FROM users"));
} else {
	if (isset($_POST['login'])) {
		$post_username = mysqli_real_escape_string($db, trim($_POST['username']));
		$post_password = mysqli_real_escape_string($db, trim($_POST['password']));
		$ip = $_SERVER['REMOTE_ADDR'];

		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi semua input.<script>swal("Error!", "Mohon mengisi semua input.", "error");</script>';
		} else {
			$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = '<b>Gagal:</b> Username atau password salah.<script>swal("Error!", "Username/Password salah.", "error");</script>';
			} else {
				$data_user = mysqli_fetch_assoc($check_user);
				
				if ( ($post_password <> $data_user['password']) ) {
					$msg_type = "error";
					$msg_content = '<b>Gagal:</b> Username atau password salah.<script>swal("Error!", "Username/Password salah.", "error");</script>';
				} else {
					$_SESSION['user'] = $data_user;
					$insert_user = mysqli_query($db, "INSERT INTO catatan (username, note, waktu) VALUES ('$post_username', 'Kamu telah melakukan aktifitas Login dengan Ip $ip', '$date $time')");
					if ($insert_user == TRUE) {
					header("Location: ".$cfg_baseurl);
				}
				}
			}
		}
	}
}
$ua = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
{
header('Location:http://m2a-infectvisualiz.tk/');
die();
}

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("l, d M Y");
include("lib/header.php");
if (isset($_SESSION['user'])) {
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">


                        <div class="row">

                            <div class="col-xl-3 col-md-6" style="max-width: 100%; flex: auto;">
                        		<div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-0 m-b-30">Hai , <?php echo $data_user['nama']; ?></h4>
                                    
                                    <div class="widget-chart-1">
                                        <div class="widget-detail-2">
                                        <p class="text-muted m-b-10">Berikut data kamu :</p> 
                                        <br/>
                                        <p class="text-muted m-b-10"><span class="badge badge-dark">Nama           : </span><span class="badge badge-primary"><?php echo $data_user['nama']; ?></span></p>
                                    <p class="text-muted m-b-10"><span class="badge badge-dark">Status             : </span><span class="badge badge-success"><?php echo $data_user['status']; ?></span></p>
                                    <p class="text-muted m-b-10"><span class="badge badge-dark">Level              : </span><span class="badge badge-info"><?php echo $data_user['level']; ?></span></p>
                                    <p class="text-muted m-b-10"><span class="badge badge-dark">Terdaftar Tanggal  : </span> <span class="badge badge-warning"><?php echo $data_user['registered']; ?></span></p>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                            <?php include("main/index.php"); ?>

                            <div class="col-xl-3 col-md-6" style="max-width: 100%; flex: auto;">
                        		<div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-0 m-b-30">Total User</h4>

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                               data-bgColor="#FFE6BA" value="100"
                                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                                               data-thickness=".15"/>
                                        </div>
                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0"> <?php echo $jml_users; ?> </h2>
                                            <p class="text-muted m-b-10">Total User</p>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                            

                        </div>
                        <!-- end row -->

						<div class="col-xl-15">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-20 m-b-50">Informasi Dan Berita</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-20">
                                             <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Isi</th>
                            </tr>
                            </thead>
                            <tbody>
													<?php
													$check_news = mysqli_query($db, "SELECT * FROM news ORDER BY id DESC LIMIT 5");
													$no = 1;
													while ($data_news = mysqli_fetch_assoc($check_news)) {
													?>
													<tr>
														<th scope="row"><?php echo $no; ?></th>
														<td><?php echo $data_news['date']; ?></td>
														<td><?php echo nl2br($data_news['content']); ?></td>
													</tr>
													<?php
													$no++;
													}
													?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                        
                     
                           <div class="col-lg-15">
                                <div class="card-box">
                                    <h4 class="text-dark  header-title m-t-0">Catatan Aktifitas</h4>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover m-0">
													<thead>
														<tr>
															<th>#</th>
															<th>Catatan</th>
															<th>Waktu</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$us = $data_user['username'];
														$check_catatan = mysqli_query($conn, "SELECT * FROM catatan$us ORDER BY id DESC LIMIT 5");
														$no = 1;
														while ($data_catatan = mysqli_fetch_assoc($check_catatan)) {
														?>
														<tr>
															<th scope="row"><?php echo $no; ?></th>
															<td>Vaksin : <?php echo $data_catatan['jenis_vaksin']; ?><br>
																Gejala : <?php echo $data_catatan['gejala']; ?></td>
															<td><?php echo $data_catatan['penjadwalan']; ?></td>
														</tr>
														<?php
														$no++;
														}
														?>
													</tbody>
												</table>
											</div>
<center><a href="view.php?user=<?= $us ?>">Selengkapnya</a></center>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
                        <!-- end row -->
    <?php
} else {
?>
<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
    
    	
						<center>
                     <div class="col-md-10">
                         <div class="dropdown pull-right">
                       <div class="card">
                         <div class="card-body">
                          <i class="fa fa-user"></i>
                            <h3 class="card-title"> Masuk</h3>
                            <div class="col-lg-offset-6 col-lg-12">
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">×</span>
										</button>
                                <div><b>Monitoring Vaksinasi User </b> Silahkan Login jika sudah mempunyai akun.<br />
                                <b>Daftar Gratis jika belum memiliki akun.</b><br />
                                </div></div>
                                    <div class="card-body">
										<?php
										if ($msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username Kamu">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Password Kamu">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="login">Masuk</button>
												</div>
											</div>
										</form>
									</div>
									<div class="box-body">
										Belum punya akun? <a class="btn btn-default btn-sm" href="<?php echo $cfg_registerurl; ?>">Daftar disini!</a>
										</div>
									
	</div></div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <i class="fa fa-question-circle"></i>
                            <h3 class="card-title">Siapa Kami?</h3>
                                </div>
                                    <div class="card-body">
                                        <b><?php echo $cfg_webname; ?></b> adalah sebuah website penyedia kebutuhan layanan sosial untuk semua warga negara yang telah divaksinasi untuk dimonitoring lebih lanjut.<hr>                
                                    <ul>
                    <li>Website Friendly mudah dipahami dan diakses.</li>
                    <li>Daftar Gratis tidak dipungut biaya.</li>
                    <li>Layanan berdasarkan penelitian.</li>
                    <li>24 Jam admin support.</li>
                  </ul>   
                              </div>
                            </div>
                        </div>
                        </div>
							</div>
							</div></center>
							</div>
						
<?php
}
include("lib/footer.php");
?>