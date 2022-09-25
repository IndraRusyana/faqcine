<?php
// <!-- Rajawali Code-->

function random($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_number($length) {
	$str = "";
	$characters = array_merge(range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

$conn = mysqli_connect("localhost", "root", "", "rajawalicode");  

// tambah data ke history
function add_his($user,$data1,$data2,$data3){
	global $conn;
	$jenis_vaksin = $data1;
	$penjadwalan = $data2;
	$gejala = $data3;

	$table = "CREATE TABLE catatan$user(
				id INT(11) AUTO_INCREMENT PRIMARY KEY,
				jenis_vaksin VARCHAR(100) NOT NULL,
				penjadwalan VARCHAR(100) NOT NULL,
				gejala VARCHAR(100) NOT NULL
				)";

	mysqli_query($conn, $table);

	mysqli_query($conn, "INSERT INTO catatan$user VALUES('', '$jenis_vaksin', '$penjadwalan', '$gejala' )");	
}

// fungsi baca database
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

// fungsi buat table di database
function create_table($user){
	global $conn;

	// buat table baru
	$table = "CREATE TABLE data$user(
				id INT(11) PRIMARY KEY,
				jenis_vaksin VARCHAR(100) NOT NULL,
				ket VARCHAR(100) NOT NULL,
				penjadwalan VARCHAR(100) NOT NULL,
				gejala VARCHAR(100) NOT NULL,
				tindakan VARCHAR(100) NOT NULL
				)";

	mysqli_query($conn, $table);

	mysqli_query($conn, "INSERT INTO data$user VALUES('0', '', '', '', '', '')");	
}

// fungsi tambah data jenis vaksin
function add_vk($data1,$data2){
	global $conn;
	$user = $data1;
	$jenis_vaksin = $data2;

	$update = "UPDATE data$user SET 
				jenis_vaksin = '$jenis_vaksin'
				WHERE id = 0";

	mysqli_query($conn, $update);

	return mysqli_affected_rows($conn);
}

// fungsi tambahdata keterangan 
function add_ket($data1,$data2){
	global $conn;
	$user = $data1;
	$ket = $data2;

	$update = "UPDATE data$user SET 
				ket = '$ket'
				WHERE id = 0";

	mysqli_query($conn, $update);

	return mysqli_affected_rows($conn);
}

// fungsi tambah data penjadwalan
function add_penjadwalan($data1,$data2){
	global $conn;
	$user = $data1;
	$penjadwalan = $data2;

	$update = "UPDATE data$user SET 
				penjadwalan = '$penjadwalan'
				WHERE id = 0";

	mysqli_query($conn, $update);

	return mysqli_affected_rows($conn);
}

// fungsi tambah data gejala
function add_gejala($data1,$data2){
	global $conn;
	$user = $data1;
	$gejala = $data2;

	$update = "UPDATE data$user SET 
				gejala = '$gejala'
				WHERE id = 0";

	mysqli_query($conn, $update);

	return mysqli_affected_rows($conn);
}

// fungsi tambah data tindakan
function add_tindakan($data1,$data2){
	global $conn;
	$user = $data1;
	$tindakan = $data2;

	$update = "UPDATE data$user SET 
				tindakan = '$tindakan'
				WHERE id = 0";

	mysqli_query($conn, $update);

	return mysqli_affected_rows($conn);
}

// fungsi penyimpanan sementara array
function temp_arr($data){
	global $AstraZeneca;
	global $Sinopharm;
	global $Moderna;
	global $Pfizer;
	global $Sinovac;
	global $Novavax;

	if ($data == "AstraZeneca") {
		$jenis = $AstraZeneca;
	} elseif ($data == "Sinopharm") {
		$jenis = $Sinopharm;
	} elseif ($data == "Moderna") {
		$jenis = $Moderna;
	} elseif ($data == "Pfizer") {
		$jenis = $Pfizer;
	} elseif ($data == "Sinovac") {
		$jenis = $Sinovac;
	} elseif ($data == "Novavax") {
		$jenis = $Novavax;
	}

	return $jenis;
}

// data vaksin covid
$AstraZeneca = [
			"jenis" => "Covid-19 Oxford-AstraZeneca",
			"umum" => ["Nyeri, hangat, gatal, atau memar di area suntikan","Sakit Kepala","Tidak Enak Badan","Tubuh terasa lelah","Nyeri otot dan sendi","Muntah","Demam","Diare","Mengigil","Gejala Flu"],
			"jarang" => ["Reaksi Alergi","Tidak terdapat dalam list"],
			"informasi" => "Vaksin AstraZeneca atau AZD1222 adalah vaksin untuk mencegah penyakit COVID-19. Vaksin ini merupakan hasil kerja sama antara Universitas Oxford dan AstraZeneca yang dikembangkan sejak Februari 2020.<br>Vaksin AstraZeneca berasal dari virus hasil rekayasa genetika (viralvector). Vaksin ini bekerja dengan cara menstimulasi atau memicu tubuh untuk membentuk antibodi yang dapat melawan infeksi virus SARS-Cov-2.",
			"penjadwalan" => ["+30 days","+84 days"]
			];
$Sinopharm = [
			"jenis" => "COVID-19 China National Pharmaceutical Group Corporation (Sinopharm)",
			"umum" => ["Nyeri, hangat, gatal, atau memar di area suntikan","Demam ringan","Sakit kepala","Tubuh terasa lelah"],
			"jarang" => ["Reaksi Alergi","Tidak terdapat dalam list"],
			"informasi" => "Jenis vaksin COVID-19 Sinopharm memanfaatkan virus Corona yang sudah dimatikan atau sering disebut dengan inactivated vaccine. Vaksin ini diklaim menjadi yang pertama di dunia yang menunjukkan imunogenisitas dan keamanan yang sangat bagus.<br>Dikutip dari New York Times, jenis vaksin COVID-19 Sinopharm bekerja dengan mengajarkan sistem kekebalan untuk membuat antibodi melawan virus corona SARS-CoV-2. Antibodi menempel pada protein virus, seperti yang disebut lonjakan protein yang menempel di permukaannya.<br>Setelah divaksin dengan vaksin COVID-19 Sinopharm, sistem kekebalan tubuh dapat merespons infeksi virus Corona hidup. Salah satu jenis sel kekebalan yaitu sel B menghasilkan antibodi yang menempel pada penyerang. Antibodi yang menargetkan spike protein dapat mencegah virus memasuki sel.",
			"penjadwalan" => ["+21 days",0]
			]; 
$Moderna = [
			"jenis" => "COVID-19 Moderna",
			"umum" => ["Demam ringan","Tangan pegal dan nyeri","Tubuh terasa lelah"],
			"jarang" => ["Reaksi Alergi","Tidak terdapat dalam list"],
			"informasi" => "Jenis vaksin COVID-19 Moderna menggunakan messenger RNA (mRNA). Virus Corona memiliki struktur seperti spike di permukaannya yang disebut protein S. Vaksin mRNA COVID-19 memberi petunjuk kepada sel tentang cara membuat bagian protein S yang tidak berbahaya.<br>Setelah vaksinasi, sel mulai membuat potongan protein dan menampilkannya pada permukaan sel. Sistem kekebalan akan mengenali bahwa protein tidak termasuk di sana dan mulai membangun respons kekebalan dan membuat antibodi.",
			"penjadwalan" => ["+28 days",0]
			]; 
$Pfizer = [
			"jenis" => "COVID-19 Pfizer-BioNTech",
			"umum" => ["Sakit Kepala","Nyeri otot","Tubuh terasa lelah","Kedinginan"],
			"jarang" => ["Reaksi Alergi","Tidak terdapat dalam list"],
			"informasi" => "Vaksin COVID-19 Pfizer-BioNTech dinamakan BNT162b2 dan berbasis teknologi messenger RNA (mRNA). Vaksin ini menggunakan gen sintetis yang lebih mudah diciptakan, sehingga bisa diproduksi lebih cepat dibanding teknologi biasa.<br>Virus yang tidak aktif ini tidak menyebabkan sakit tetapi mengajari sistem imun untuk memberikan respons perlawanan. Dengan mRNA, tubuh tidak disuntik virus mati maupun dilemahkan, melainkan disuntik kode genetik dari virus tersebut. Hasilnya, tubuh akan memproduksi protein yang merangsang respons imun.",
			"penjadwalan" => ["+21 days","+28 days"]
			];
$Sinovac = [
			"jenis" => "COVID-19 Sinovac",
			"umum" => ["Demam ringan","Tangan pegal dan nyeri","Tidak terjadi efek samping"],
			"jarang" => ["Reaksi Alergi","Tidak terdapat dalam list"],
			"informasi" => "Jenis vaksin COVID-19 Sinovac bekerja untuk menguatkan sistem kekebalan tubuh sehingga antibodi dapat melawan virus Corona. Vaksin ini dibuat dengan platform atau metode virus yang telah dimatikan (inactivated virus).<br>Lewat cara tersebut maka tubuh bisa belajar mengenali virus penyebab COVID-19, SARS-COV-2, tanpa harus menghadapi risiko infeksi serius. Vaksin ini diberikan dalam dua dosis atau perlu dua kali suntikan.",
			"penjadwalan" => ["+14 days",0]
			]; 
$Novavax = [
			"jenis" => "COVID-19 Novavax",
			"umum" => ["Demam ringan","Tangan pegal dan nyeri","Tidak terjadi efek samping"],
			"jarang" => ["Reaksi Alergi","Tidak terdapat dalam list"],
			"informasi" => "Novavax adalah perusahaan bioteknologi yang berbasis di Maryland, Amerika Serikat yang mengambil pendekatan tradisional untuk mengembangkan vaksin melawan COVID-19. Vaksin Novavax menggunakan spike protein yang dibuat khusus yang meniru protein spike alami dalam virus Corona.<br>Dikutip dari Very Well Health, vaksin ini bekerja dengan memasukkan protein yang memicu respons antibodi, yang menghalangi kemampuan virus Corona di masa depan untuk mengikat sel dan mencegah infeksi. Protein tersebut dikombinasikan dengan adjuvan Matrix-M Novavax, yang penting dalam meningkatkan respons imun yang ditimbulkan oleh antigen protein.",
			"penjadwalan" => ["+21 days",0]
			]; 



if ( isset($_POST['input_vk']) ) {
	$hidden = true;
	if ( isset($_POST['vaksin']) ) { 

		$vk = $_POST['vaksin'];
		
		if ($vk == "AstraZeneca") {
			$jenis = $AstraZeneca;
			$info = $AstraZeneca["informasi"]; 
		} elseif ( $vk == "Sinopharm" ) {
			$jenis = $Sinopharm;
			$info = $Sinopharm["informasi"];
		} elseif ( $vk == "Moderna" ) {
			$jenis = $Moderna;
			$info = $Moderna["informasi"];
		} elseif ( $vk == "Pfizer" ) {
			$jenis = $Pfizer;
			$info = $Pfizer["informasi"];
		} elseif ( $vk == "Sinovac" ) {
			$jenis = $Sinovac;
			$info = $Sinovac["informasi"];
		} elseif ( $vk == "Novavax" ) {
			$jenis = $Novavax;
			$info = $Novavax["informasi"];
		}
	}
}