<?php
if(isset($_GET['no_antrian'])) {
	$no_antrian = $_GET['no_antrian'];
	$id_pendaftaran = $_GET['id_pendaftaran'];

	$query = mysqli_query($con, "SELECT * FROM diagnosis, pasien WHERE pasien.id_pasien=diagnosis.id_pasien AND diagnosis.no_antrian='$no_antrian'");
	$data = mysqli_fetch_array($query);

	$query1 = mysqli_query($con, "SELECT * FROM diagnosis, resep WHERE diagnosis.no_antrian='$no_antrian'");
}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Obat Pasien <?php echo $data['nama']; ?></h3>
	</div>
	<div class="panel-body">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="col-md-2">Nama</label>
				<div class="col-md-5">
					<input type="text" value="<?php echo $data['nama']; ?>" readonly class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2">Jenis Kelamin</label>
				<div class="col-md-5">
					<input type="text" value="<?php echo $data['jenis_kelamin']; ?>" readonly class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-2">Dokter yang Menangani</label>
				<div class="col-md-5">
					<input type="text" value="<?php echo $data['dokter']; ?>" readonly class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2">Tanggal</label>
				<div class="col-md-5">
					<input type="text" value="<?php echo date("d-m-Y"); ?>" readonly class="form-control">
				</div>
			</div>
		</form>

		<br>
		<br>
		<table class="table table-responsive table-bordered">
			<thead>
				<tr>
					<th>Nama Obat</th>
					<th>Jenis Obat</th>
					<th>Jumlah</th>
					<th>Keterangan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($row = mysqli_fetch_array($query1)){
				?>
				<tr>
					<td><?php echo $row['nama_obat'] ?></td>
					<td><?php echo $row['jenis_obat'] ?></td>
					<td><?php echo $row['jumlah'] ?></td>
					<td><?php echo $row['keterangan'] ?></td>
					<td>
						<?php if($row['status'] == "Proses") { ?>
						<a href="?page=selesai&id=<?php echo $row['id_resep'] ?>&no_antrian=<?php echo $no_antrian ?>&jumlah=<?php echo $row['jumlah'] ?>&nama_obat=<?php echo $row['nama_obat'] ?>" class="btn btn-sm btn-danger">Selesai</a>
					<?php } else {echo $row['status']; } ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<br>
		<br>
		<a href="?page=status&id=<?php echo $id_pendaftaran; ?>" class="btn btn-sm btn-primary">Selesai</a>
	</div>
</div>