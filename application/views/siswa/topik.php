<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('siswa/mapel/') ?>">Mata Pelajaran</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>

	<!-- pesan  -->
	<?php if ($this->session->flashdata('pesan')) : ?>
		<div class="alert alert-success alert-dismissible fade show">
			<p class="m-0"> <?= $this->session->flashdata('pesan') ?></p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif ?>
	<?php if ($this->session->flashdata('errors')) : ?>
		<div class="alert alert-danger alert-dismissible fade show">
			<?= $this->session->flashdata('errors') ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif ?>

	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h1 class="h4 text-uppercase text-success font-weight-bold"><?= $title; ?></h1>
			<hr class="border-success my-0">
			<table class="table table-borderless my-0">
				<tr>
					<th>Mata Pelajaran</th>
					<td><?= $mengajar['nama_mapel']; ?></td>
				</tr>
				<tr>
					<th>Guru</th>
					<td><?= $mengajar['nama_guru']; ?></td>
				</tr>
				<tr>
					<th>Semester</th>
					<td><?= $mengajar['semester']; ?></td>
				</tr>
			</table>
		</div>
		<div class="card-body">
			<?php if (empty($topik)) : ?>
				<div class="alert alert-warning text-center" role="alert">
					Tidak Ada Topik
				</div>
			<?php endif ?>
			<div class="row justify-content-center">
				<?php foreach ($topik as $key => $value) : ?>
					<div class="col-xl-12 col-md-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<a class="font-weight-bold h4 card-link" href="<?= base_url("siswa/topik/detail/" . $value["id_topik"]); ?>"><?= substr($value['judul_topik'], 0, 50); ?></a>
								<br>
								Diberikan: <?= tanggal($value['topik_mulai']) ?> / Jam <?= jammenit($value['topik_mulai']) ?> <br>
								Batas: <?= tanggal($value['topik_berakhir']) ?> / Jam <?= jammenit($value['topik_berakhir']) ?>
							</div>
							<div class="card-body">
								<div class="text  mb-1">
									<?= substr($value['deskripsi_topik'], 0, 160); ?>
								</div>
								<hr>
								<a href="<?= base_url("siswa/topik/detail/" . $value["id_topik"]); ?>" class="btn btn-primary btn-icon-split btn-sm">
									<span class="icon text-white-50">
										<i class="fas fa-eye"></i>
									</span>
									<span class="text">Lihat</span>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="card-footer">
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					<?php
					if ($halaman > 1) {
						$sebelumnya = $halaman - 1;;
					} else {
						$sebelumnya = 1;
					}
					if ($halaman == $jumlah_halaman) {
						$selanjutnya = $jumlah_halaman;
					} else {
						$selanjutnya = $halaman  + 1;
					} ?>
					<li class="page-item">
						<a class="page-link" href="<?= base_url('siswa/topik/index/' . $mengajar['id_mengajar'] . "/" . $sebelumnya); ?>">Sebelumnya</a>
					</li>
					<?php
					for ($i = 1; $i <= $jumlah_halaman; $i++) { ?>
						<li class="page-item">
							<a class="page-link" href="<?= base_url('siswa/topik/index/' . $mengajar['id_mengajar'] . "/" . $i); ?>"><?= $i; ?></a>
						</li>
					<?php } ?>
					<li class="page-item">
						<a class="page-link" href="<?= base_url('siswa/topik/index/' . $mengajar['id_mengajar'] . "/" . $selanjutnya); ?>">Selanjutnya</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
