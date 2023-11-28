<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

	<title>Registration</title>
	<style type="text/css">
		.error {
			font-size: 15px;
			color: red;
		}
	</style>
</head>

<body>
	<?php

	$nikErr = $namaErr = $usernameErr = $passwordErr = $telpErr  = NULL;
	$nik = $nama = $username = $password = $telp  = NULL;


	$flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["nik"])) {
			$nikErr = "Tolong Masukkan NIk";
			$flag = false;
		} else {
			$nik = test_input($_POST["nik"]);
		}

		if (empty($_POST["nama"])) {
			$namaErr = "Tolong Masukkan Nama";
			$flag = false;
		} else {
			$nama = test_input($_POST["nama"]);
		}

		if (empty($_POST["username"])) {
			$usernameErr= "Tolong Masukkan Username";
			$flag = false;
		} else {
			$username= test_input($_POST["username"]);
		}

		if (empty($_POST["password"])) {
			$passwordErr = "Tolong Masukkan Password";
			$flag = false;
		} else {
			$password = md5($_POST["password"]);
		}
        if (empty($_POST["telp"])) {
			$telpErr = "Tolong Masukkan Nomor Telpon";
			$flag = false;
		} else {
			$telp = test_input($_POST["telp"]);
		}
		// submit form if validated successfully
		if ($flag) {

			$koneksi=mysqli_connect("localhost","root","","pengaduan_masyarakat");

			if ($koneksi->connect_error) {
				die("connection failed error: " . $koneksi->connect_error);
			}
						$sql = "INSERT INTO masyarakat (nik,nama,username,password,telp) VALUES('$nik', '$nama', '$username', '$password', '$telp') ";
			
		//validasi nik
						$sql2 = $koneksi->query("SELECT * FROM masyarakat WHERE nik='$nik'");
						$cek = $sql2 -> num_rows;

						if ($cek > 0) {
							echo "<script>alert('NIK Sudah Terdaftar');window.location='register.php';</script>";
						}

		//validasi username
		$sql3 = $koneksi->query("SELECT * FROM masyarakat WHERE username='$username'");
						$cek2 = $sql3 -> num_rows;

						if ($cek2 > 0) {
							echo "<script>alert('Username Sudah Terdaftar');window.location='register.php';</script>";
						}
			// execute sql insert
			if ($koneksi->query($sql) === TRUE) {
				echo "<script> alert('data saved successfully');</script>";
				header('location:loginpage.php');
			}
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	?>
	<form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<div class="card pt-2 mx-auto" style="max-width: 30rem;">
			<div class="card-header" style="font-size: 25px;
			font-style: italic;">
				<header>DAFTAR</header>
			</div>
			<div class="card-body">
				<div class="card-text mb-2">
					NIK : <input type="text" name="nik" class="form-control" placeholder="NIK Wajib 16 Digit" minlength="16" maxlength="16" value="<?= $nik; ?>">
					<span class="error"> <?= $nikErr; ?></span>
				</div>
				<div class="card-text mb-2">
					Nama: <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $nama ?>">
					<span class="error"> <?= $namaErr ?></span>
				</div>
				<div class="card-text mb-2">
					Username : <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $username; ?>">
					<span class="error"> <?= $usernameErr; ?></span>
				</div>
				<div class="card-text mb-2">
					Password : <input type="text" name="password" class="form-control" placeholder="Password" value="<?= $password; ?>">
					<span class="error"> <?= $passwordErr; ?></span>
				</div>
                <div class="card-text mb-2">
					Telp: <input type="text" name="telp" class="form-control" placeholder="Please enter your Phone" minlength="10" maxlength="12" value="<?= $telp; ?>">
					<span class="error"> <?= $telpErr; ?></span>
				</div>
			<div class="card-footer mb-2 btn-lg">
				<input class="btn btn-warning" type="submit" name="button" value="Daftar">
			</div>
		</div>
	</form>

</body>

</html>