<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/offcanvas.css">
</head>
<body>

	<nav class="navbar navbar-fixed-top navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>
          		<a class="navbar-brand" href="/">BUKU</a>
			</div>
        	<div id="navbar" class="collapse navbar-collapse navbar-right">
        		<ul class="nav navbar-nav">
        			<li><a href="home.php">Home</a></li>
        			<li class="active"><a href="admin.php">Admin</a></li>
        			<li><a href="pengadaan.php">Pengadaan</a></li>
        		</ul>
        	</div>
		</div>
	</nav>

	<div class="container">
		<div class="col-md-4 col-md-offset-4">
			<form method="post">
				<?php
					require_once 'koneksi.php';
					if (isset($_POST['tambah'])) {
						$judul_buku = $_POST['judul_buku'];
						$pengarang = $_POST['pengarang'];
						$penerbit = $_POST['penerbit'];
						$tahun = $_POST['tahun'];
						$stok_buku = $_POST['stok_buku'];
						if (!$judul_buku && !$pengarang && !$penerbit && !$tahun) {
							echo "<div class='alert alert-danger'>Data tidak boleh kosong!</div>";
						} else {
							mysqli_query($con, "INSERT INTO tabel_buku (judul_buku,pengarang,penerbit,tahun,stok_buku) VALUES ('$judul_buku','$pengarang','$penerbit','$tahun','$stok_buku')");
							echo "<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
						}
					}
				?>
				<div class="panel panel-default">
					<div class="panel-body">
						<center><h3>Tambah Data</h3></center>
						<hr>
						<div class="form-group">
							<label>Judul Buku :</label>
							<input type="text" name="judul_buku" class="form-control" maxlength="50" required>
						</div>
						<div class="form-group">
							<label>Pengarang :</label>
							<input type="text" name="pengarang" class="form-control" maxlength="50" required>
						</div>
						<div class="form-group">
							<label>Penerbit :</label>
							<input type="text" name="penerbit" class="form-control" maxlength="50" required>
						</div>
						<div class="form-group">
							<label>Tahun :</label>
							<input type="number" name="tahun" class="form-control" placeholder="20xx" maxlength="10" required>
						</div>
						<div class="form-group">
							<label>Stok Buku :</label>
							<input type="number" name="stok_buku" class="form-control" maxlength="10" value="0">
						</div>
						<div class="form-group">
							<button type="submit" name="tambah" class="btn btn-success btn-block">Tambah</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>