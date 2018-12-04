<!DOCTYPE html>
<html>
<head>
	<title>Pengadaan</title>
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
        			<li><a href="admin.php">Admin</a></li>
        			<li class="active"><a href="pengadaan.php">Pengadaan</a></li>
        		</ul>
        	</div>
		</div>
	</nav>

	<div class="container">
		<?php
			require_once 'koneksi.php';
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$query = mysqli_query($con, "SELECT * FROM tabel_buku WHERE id_buku = '$id'");
				$array = mysqli_fetch_array($query);
		?>
		<div class="col-md-4 col-md-offset-4">
			<form method="post">
				<div class="panel panel-info">
					<div class="panel-body">
						<center><h3>TAMBAH STOK BUKU</h3></center>
						<hr>
						<div class="form-group">
							<?php
								if (isset($_POST['tambah'])) {
									$jumlah_stok = $_POST['jumlah_stok'];
									if ($jumlah_stok < 1) {
										echo "<div class='alert alert-danger'>Gagal : Masukan jumlah stok dengan benar.</div>";
									} else {
										$tambah = mysqli_query($con, "UPDATE tabel_buku SET stok_buku = stok_buku+$jumlah_stok WHERE id_buku = '$id'");
										if ($tambah) {
											echo "<div class='alert alert-success'>Stok buku berhasil ditambahkan sejumlah <b>" .$jumlah_stok. "</b> buku.</div>";
										} else {
											echo "<div class='alert alert-danger'>Kesalahan sumber.</div>";
										}
									}
								}
							?>
						</div>
						<div class="form-group">
							<label>JUDUL BUKU :</label>
							<input type="text" class="form-control" value="<?=$array['judul_buku'];?>" readonly>
						</div>
						<div class="form-group">
							<label>PENGARANG :</label>
							<input type="text" class="form-control" value="<?=$array['pengarang'];?>" readonly>
						</div>
						<div class="form-group">
							<label>PENERBIT :</label>
							<input type="text" class="form-control" value="<?=$array['penerbit'];?>" readonly>
						</div>
						<div class="form-group">
							<label>TAHUN :</label>
							<input type="text" class="form-control" value="<?=$array['tahun'];?>" readonly>
						</div>
						<div class="form-group">
							<label>STOK BUKU SAAT INI :</label>
							<input type="text" class="form-control" value="<?=$array['stok_buku'];?>" readonly>
						</div>
						<div class="input-group">
							<input type="number" name="jumlah_stok" class="form-control" placeholder="Tambah Stok" required>
							<div class="input-group-btn">
								<button type="submit" name="tambah" class="btn btn-primary">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<br>
		</div>
		<?php
			}
			$query = mysqli_query($con,"SELECT * FROM tabel_buku WHERE stok_buku = '0'");
			$jumlah_habis = mysqli_num_rows($query);
			if ($jumlah_habis < 1) {
				echo "<center><h4>Tidak ada buku yang kosong.</h4></center>";
			} else {
				echo "<center><h4>Terdapat " .$jumlah_habis. " buku dengan stok yang kosong</h4></center>";
			}
		?>
		<center><h4></h4></center>
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>JUDUL BUKU</th>
					<th>PENGARANG</th>
					<th>PENERBIT</th>
					<th>TAHUN</th>
					<th>STOK BUKU</th>
					<th>Tambah Stok</th>
				</tr>
			</thead>
			<tbody>
				<?php
						$query2 = mysqli_query($con,"SELECT * FROM tabel_buku WHERE stok_buku = '0'");
						while ($array = mysqli_fetch_array($query2)) {
				?>
				<tr>
					<td><?=$array['id_buku'];?></td>
					<td><?=$array['judul_buku'];?></td>
					<td><?=$array['pengarang'];?></td>
					<td><?=$array['penerbit'];?></td>
					<td><?=$array['tahun'];?></td>
					<td><?=$array['stok_buku'];?></td>
					<td><a href="?id=<?=$array['id_buku'];?>" class="btn btn-success"><i class="fa fa-plus"></i></a></td>
				</tr>
				<?php
						}
				?>	
			</tbody>
		</table>
	</div>
</body>
</html>