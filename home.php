<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
        			<li class="active"><a href="home.php">Home</a></li>
        			<li><a href="admin.php">Admin</a></li>
        			<li><a href="pengadaan.php">Pengadaan</a></li>
        		</ul>
        	</div>
		</div>
	</nav>

	<div class="container">
		<div class="col-md-4 col-md-offset-4">
			<form method="post">
				<div class="input-group">
					<input type="number" name="id_buku" class="form-control" placeholder="ID Buku">
					<div class="input-group-btn">
						<button type="submit" name="cari" class="btn btn-default">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</div>
			</form>
			<br>
		</div>
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>JUDUL BUKU</th>
					<th>PENGARANG</th>
					<th>PENERBIT</th>
					<th>TAHUN</th>
					<th>STOK BUKU</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require_once 'koneksi.php';
					if (isset($_POST['cari'])) {
						$id_buku = $_POST['id_buku'];
						$query = mysqli_query($con, "SELECT * FROM tabel_buku WHERE id_buku = '$id_buku'");
						$array = mysqli_fetch_array($query);
						if ($array == 0) {
							echo "<tr><td colspan='5'>ID Buku tidak ada/Buku tidak ditemukan...</td></tr>";
						} else {
				?>
				<tr>
					<td><?=$array['id_buku'];?></td>
					<td><?=$array['judul_buku'];?></td>
					<td><?=$array['pengarang'];?></td>
					<td><?=$array['penerbit'];?></td>
					<td><?=$array['tahun'];?></td>
					<td><?=$array['stok_buku'];?></td>
				</tr>
				<?php
						}
					} else {
						$query = mysqli_query($con,"SELECT * FROM tabel_buku");
						while ($array = mysqli_fetch_array($query)) {
							if ($array['stok_buku'] < 1) {
								$stok_buku = "<td style='color:red'>Kosong</td>";
							} else {
								$stok_buku = "<td style='color:green'>" .$array['stok_buku']. "</td>";
							}
				?>
				<tr>
					<td><?=$array['id_buku'];?></td>
					<td><?=$array['judul_buku'];?></td>
					<td><?=$array['pengarang'];?></td>
					<td><?=$array['penerbit'];?></td>
					<td><?=$array['tahun'];?></td>
					<?=$stok_buku;?>
				</tr>
				<?php
						}
					}
				?>	
			</tbody>
		</table>
	</div>
</body>
</html>