 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<?php
		$session_guru = $this->session->userdata('guru');
		$session_siswa = $this->session->userdata('siswa');
		?>

 	<!-- Chat Box-->
 	<div class="card shadow mb-4">
 		<div class="card-header">
 			<h4 class="text-success font-weight-bold"><?= $title; ?> - <?= $detail['jenjang'] . $detail['singkatan_jurusan'] . $detail['rombel'] . ' ' .  $detail['nama_mapel'] ?></h4>
 		</div>
 		<div class="px-4 py-5 chat-box bg-white" style="max-height: calc(100vh - 250px); overflow-y: auto;">

 			<?php foreach ($diskusi as $key => $value) : ?>
 				<?php
					if (empty($value['id_siswa'])) {
						$nama_pengirim = $value['nama_guru'];
					} else {
						$nama_pengirim = $value['nama_siswa'];
					}
					// jika id_guru tidak kosong, berarti dia guru
					// dan dapat label guru
					if (!empty($value['id_guru'])) {
						$label_guru = '<i class="fa fa-star"></i>';
						$foto = "assets/img/guru/$value[foto_guru]";
					} else {
						$label_guru = '';
						$foto = "assets/img/siswa/$value[foto_siswa]";
					}
					// jika id_guru/id_siswa = id yang login
					// maka jadikan bg_success dan ml-auto
					if ($this->session->userdata('siswa')) {
						if ($value['id_siswa'] == $session_siswa['id_siswa']) {
							$warna_bg = 'bg-success';
							$warna_teks = 'text-white';
							$letak = 'ml-auto';
						} else {
							$warna_bg = 'bg-light';
							$warna_teks = 'text-grey';
							$letak = 'mr-auto';
						}
					} elseif ($this->session->userdata('guru')) {
						if ($value['id_guru'] == $session_guru['id_guru']) {
							$warna_bg = 'bg-success';
							$warna_teks = 'text-white';
							$letak = 'ml-auto';
						} else {
							$warna_bg = 'bg-light';
							$warna_teks = 'text-grey';
							$letak = 'mr-auto';
						}
					} else {
						$warna_bg = 'bg-light';
						$warna_teks = 'text-grey';
						$letak = 'mr-auto';
					}

					?>
 				<!-- Orang lain Message-->
 				<div class="media w-50 mb-3 <?= $letak ?>"><img src="<?= base_url($foto) ?>" width="50" class="rounded-circle">
 					<div class="media-body ml-3">
 						<div class="<?= $warna_bg ?> rounded py-2 px-3 mb-2">
 							<p class="text-small mb-1 <?= $warna_teks ?>"><?= $nama_pengirim ?> <?= $label_guru ?></p>
 							<p class="text-small mb-0 <?= $warna_teks ?>"><?= $value['pesan_diskusi'] ?></p>
 						</div>
 						<p class="small text-muted"><?= tanggal_waktu($value['tanggal_diskusi']) ?></p>
 					</div>
 				</div>
 				<?php
					$warna_bg = 'bg-light';
					$warna_teks = 'text-grey';
					$letak = 'mr-auto';
					?>
 			<?php endforeach ?>
 		</div>

 		<!-- Typing area -->
 		<?php if (empty($session_siswa)) {
				$id_siswa = "NULL";
				$id_guru = $session_guru['id_guru'];
			} else {
				$id_siswa = $session_siswa['id_siswa'];
				$id_guru = "NULL";
			}
			?>

 		<form action="" class="bg-light" method="POST">
 			<input type="hidden" name="id_pengirim_siswa" value="<?= $id_siswa; ?>">
 			<input type="hidden" name="id_pengirim_guru" value="<?= $id_guru ?>">
 			<div class="input-group">
 				<input type="text" placeholder="Tuliskan Pesan..." class="form-control rounded-0 border-0 py-4 bg-light" name="pesan_diskusi">
 				<div class="input-group-append">
 					<button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i></button>
 				</div>
 			</div>
 		</form>
 		<!-- tutup pesan  -->
 	</div>
 </div>
