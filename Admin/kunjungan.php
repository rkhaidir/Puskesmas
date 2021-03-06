
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Laporan Kunjungan</h3>
	</div>
	<div class="panel-body">
		<form method="POST" class="form-horizontal">
			<div class="form-group">
				<label for="" class="label-control col-md-2">Pilih Tanggal</label>
				<div class="col-md-3">
					<input type="text" name="mulai" class="form-control" id="date" required="">
				</div>
				<div class="col-md-3">
					<input type="text" name="akhir" class="form-control" id="date" required="">
				</div>
				<div class="col-md-3">
					<input type="submit" name="cari" value="Cari" class="btn btn-md btn-primary">
				</div>
			</div>
		</form>
		<?php
		if(isset($_POST['cari'])) {
			$mulai = $_POST['mulai'];
			$akhir = $_POST['akhir'];

			$query = mysqli_query($con, "SELECT * FROM diagnosis, pasien WHERE (diagnosis.tanggal BETWEEN '$mulai' AND '$akhir')");
			?>
			<button type="button" class="btn btn-md btn-primary" onclick="window.open('cetak.php?mulai=<?php echo $mulai; ?>&akhir=<?php echo $akhir ?>','mywindow','width=700, height=500')"><i class="fa fa-print fa-fw"></i> Cetak</button>
			<br>
			<br>
			<table class="table table-responsive table-bordered" id="myTable">
				<thead>
					<tr>
						<th>No</th>
						<th>No Antrian</th>
						<th>Nama Pasien</th>
						<th>Jenis Kelamin</th>
						<th>Dokter Menangani</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=1;
					while($row = mysqli_fetch_array($query)) {
						?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $row['no_antrian'] ?></td>
							<td><?php echo $row['nama'] ?></td>
							<td><?php echo $row['jenis_kelamin'] ?></td>
							<td><?php echo $row['dokter'] ?></td>
							<td>
								<a href="?page=detail_pasien&no_antrian=<?php echo $row['no_antrian'] ?>" class="btn btn-sm btn-primary">Detail</a>
							</td>
						</tr>
						<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		<?php } ?>
	</div>
</div>



