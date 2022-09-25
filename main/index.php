<style type="text/css">
	tr{
		color: white;
	}

	ul,p{
		list-style: none;
		padding-left: 0;
	}

	li{
		width: 100%;
	}

	label{
		width: 85%;
		height: auto;
		text-align: left;
		color: white;
	}

</style>


 <!-- Jika ada variabel username otomatis bikin tabel data$user -->
<?php 
$username = $data_user['username'];

if ( isset($username) ) {
	create_table($username);
} 

$db = query("SELECT * FROM data$username")[0];
if ($db['jenis_vaksin'] == "") {
	$hidden = true;
}

if (isset($_POST['ubah'])) {
	$hidden = true;
}

?>

<!-- jika seluruh data telah diinput form ini akan hilang -->
<?php if ( !isset($_POST['input_vk']) && !isset($_POST['tgl']) && isset($hidden) ) : ?>
<div class="col-xl-3 col-md-6" style="max-width: 100%; flex: auto;">
	<div class="card-box">
		<div class="dropdown pull-right">
            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-dots-vertical"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            </div>
        </div>

        <h4 class="header-title mt-0 m-b-30">Pilih Jenis Vaksin</h4>
		<form id="vaksin" action="" method="post" ">
			<ul>
				<li>
					<input id="vaksin1" type="radio" name="vaksin" value="AstraZeneca">
					<label for="vaksin1">Covid-19 Oxford-AstraZeneca</label>
				</li>
				<li>
					<input id="vaksin2" type="radio" name="vaksin" value="Sinopharm">
					<label  for="vaksin2">Covid-19 China National Pharmaceutical Group (Sinopharm)</label>
				</li>
				<li>
					<input id="vaksin3" type="radio" name="vaksin" value="Moderna">
					<label for="vaksin3">Covid-19 Moderna</label>
				</li>
				<li>
					<input id="vaksin4" type="radio" name="vaksin" value="Pfizer">
					<label for="vaksin4">Covid-19 Pfizer-BioNTech</label>
				</li>
				<li>
					<input id="vaksin5" type="radio" name="vaksin" value="Sinovac">
					<label for="vaksin5">Covid-19 Sinovac</label>
				</li>
				<li>
					<input id="vaksin6" type="radio" name="vaksin" value="Novavax">
					<label for="vaksin6">Covid-19 Novavax</label>
				</li>	
				<li>
					<button type="submit" class="btn btn-outline-info" name="input_vk">Input</button>	
				</li>
			</ul>
		</form>
	<?php endif; ?>

	<!-- input jenis vaksin ke tabel -->
	<?php if ( isset($_POST['vaksin']) ) {
		add_vk($username,$_POST['vaksin']);
	} ?>

	<!-- jika belum milih jenis vaksin dan tidak ada var info, form ini tidak akan tampil -->
	<?php if ( isset($_POST['vaksin']) && isset($info) ) : ?>
	<div class="col-xl-3 col-md-6" style="max-width: 100%; flex: auto;">
	<div class="card-box" style="text-align: justify;">
		<h1 class="header-title mt-0 m-b-30"><?= $_POST['vaksin']; ?></h1>
		<p align="justify" ><?= $info; ?></p>

		<h4 class="header-title mt-0 m-b-30">Gejala Apa Yang Anda Alami</h4>
		<form action="" method="post">
			<ul>

				<?php $i = 0;
				foreach ($jenis['umum'] as $key) : ?>
					<li>
						<input id="gejala<?= $i ?>" type="radio" name="gejala" value="<?= $key ?>">
						<label for="gejala<?= $i ?>"><?= $key; ?></label>
					</li>
				<?php $i++; endforeach; ?>

				<?php $x = 1;
				foreach ($jenis['jarang'] as $key) : ?>
					<li>
						<input id="gejala<?= $i ?>" type="radio" name="gejala" value="<?= $key ?>">
						<label for="gejala<?= $i ?>"><?= $key; ?></label>
					</li>
				<?php $i++; endforeach; ?> 

			</ul>

			<h4 class="header-title mt-0 m-b-30">Penjadwalan Vaksinasi</h4>
			<ul style="list-style: none;">
				<li>
					<input id="thp1" type="radio" name="thp" value="1">
					<label for="thp1">Saya Sudah Vaksinasi Tahap 1</label>
				</li>
				<li>
					<input id="thp2" type="radio" name="thp" value="2">
					<label for="thp2">Saya Sudah Vaksinasi Tahap 2</label>
				</li>	
				<li>
					<button type="submit" class="btn btn-outline-info" name="input_gjl_thp">Input</button>	
				</li>
			</ul>
		</form>
	<?php endif ?>
	</div>
	</div>

	<!-- input data gejala dan tindakan ke dalam tabel -->
	<?php if ( isset($_POST['gejala']) ) {
			$hidden = true;
			add_gejala($username,$_POST['gejala']);

			$rows = query("SELECT jenis_vaksin FROM data$username")[0]['jenis_vaksin'];
			$jenis = temp_arr($rows);

			if ( in_array($_POST['gejala'], $jenis['umum']) ) {
				$text = "Tidak Perlu Khawatir Gejala Anda Umum";
				add_tindakan($username,$text);
			}

			if ( in_array($_POST['gejala'], $jenis['jarang']) ) {
				$text = "Anda Sebaiknya Menghubungi Dokter";
				add_tindakan($username,$text);
			}
		} 

		if ( isset($_POST['thp']) ) {
			$text = "Anda Telah Vaksinasi Tahap " . $_POST['thp'];
			add_ket($username,$text);
		}

		?>

	<!-- tampil jika user belum vaksin tahap 2 -->
	<?php if ( isset($_POST['thp']) && $_POST['thp'] == 1 ) : ?>
	<div class="col-xl-3 col-md-6" style="max-width: 100%; flex: auto;">
	<div class="card-box">
		<form action="" method="post">
			<ul style="list-style: none;">
				<li>
					<h4 class="header-title mt-0 m-b-30" for="tgl" >Kapan Anda Vaksinasi Tahap 1 : </h4>
					<input id="tgl" type="date" name="tgl" placeholder="dd/mm/yyyy" required>
				</li><br>
				<li>
					<button type="submit" class="btn btn-outline-info" name="input_tgl">Input</button>	
				</li>
			</ul>
		</form>
	<?php endif; ?>

	<!-- input tgl vaksinasi user -->
	<?php if ( isset($_POST['input_tgl']) ) {
		$rows = query("SELECT jenis_vaksin FROM data$username")[0]['jenis_vaksin'];
		$jenis = temp_arr($rows);

		$min = date('d-m-Y', strtotime($jenis['penjadwalan'][0],strtotime($_POST['tgl'])));
		$text ="";
		if ( $jenis['penjadwalan'][1] !== 0) {
			$max = date('d-m-Y', strtotime($jenis['penjadwalan'][1],strtotime($_POST['tgl'])));
			$text = " - " . $max;
		}
		
		$result = "Vaksin Tahap 1 : " . $_POST['tgl'] . "<br>Vaksinasi Selanjutnya Pada " . $min . $text;

		add_penjadwalan($username,$result);
	} ?>

	<!-- input data ke history -->
	<?php
	$ket = query("SELECT ket FROM data$username")[0]['ket'];

	if ( isset($_POST['input_tgl']) || (isset($_POST['thp']) && $ket == "Anda Telah Vaksinasi Tahap 2" )) {
		// echo "mantap";
		$rows = query("SELECT * FROM data$username");

		foreach ($rows as $key) {
			if ( $ket == "Anda Telah Vaksinasi Tahap 2" ) {
				$key['penjadwalan'] = "Anda Telah Vaksinasi Tahap 2";
			}

			add_his($data_user['username'],$key['jenis_vaksin'],$key['penjadwalan'],$key['gejala']);
		}

	}

	

	?>


	<!-- tampil jika user input tgl atau user memilih vaksin tahap 2  -->
	<?php
	$rows = query("SELECT ket FROM data$username")[0]['ket'];

	if ( !isset($hidden) || isset($_POST['tgl']) || (isset($_POST['input_gjl_thp']) && $rows == "Anda Telah Vaksinasi Tahap 2") ) : ?>


	<div class="col-xl-3 col-md-6" style="max-width: 100%;">
	<div class="card-box">
		<div class="dropdown pull-right">
            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-dots-vertical"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            </div>
        </div>

        <h4 class="header-title mt-0 m-b-30">Berikut Adalah Data Kamu</h4>
		
		<table border="0" cellpadding="10">

	<?php 

	// hasil dari pilihan user tampil disini
	$rows = query("SELECT * FROM data$username");
	foreach ($rows as $key) : ?>
			<tr>
				<th>Nama</th>
				<td><?= $data_user['nama']; ?></td>
			</tr>
			<tr>
				<th>Jenis Vaksin</th>
				<td><?= $key['jenis_vaksin']; ?></td>
			</tr>
			<tr>
				<th>Keterangan</th>
				<td><?= $key['ket']; ?></td>
			</tr>

			<?php if ( isset($_POST['tgl']) ) : ?>
			<tr>
				<th>Penjadwalan</th>
				<td><?= $key['penjadwalan']; ?></td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<th>Gejala</th>
				<td><?= $key['gejala']; ?></td>
			</tr>
			<tr>
				<th>Tindakan</th>
				<td><?= $key['tindakan']; ?></td>
			</tr>
			<tr>
				<td colspan="2">
					<form action="" method="post">
						<button type="submit" class="btn btn-outline-info" name="ubah">Ubah Data</button>
					</form>
						
				</td>
			</tr>
		</table>

		
	
<?php

endforeach; ?>
<?php endif; ?>
</div>
</div>


<!-- selesai -->