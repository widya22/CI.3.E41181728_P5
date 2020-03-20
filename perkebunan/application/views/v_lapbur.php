<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  

  <!-- Begin Page Content -->
  <div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"></h6>
	  </div>
	  <div class="card-body">
		<div class="table-responsive">
		
		<center><h1>Data Buruh</h1></center>
		<!-- menghubungkan ke crud/tambah -->
	
		  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		  <thead>
			  <tr>
				<th>No</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telepon</th>
				
			  </tr>
			</thead>
			<tfoot>
			  <tr>
			  <th>No</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telepon</th>
			  </tr>
			</tfoot>
		<?php 
		$no = 1;
		// data dari crud/tampilkan disimpan di $user( tabel user)
		foreach($user as $u){ //$user menjadi $ur diubah menjadi variabel perantara
		?>
		<tr>
		<!-- mencetak no -->
			<td><?php echo $no++ ?></td> 
			<!-- mencetak $u dari tabel user kolom nama -->
			<td><?php echo $u->nama ?></td>
			<!-- mencetak $u dari tabel user kolom alamat -->
			<td><?php echo $u->alamat ?></td>
			<!-- mencetak $u dari tabel user kolom pekerjaan -->
			<td><?php echo $u->pekerjaan ?></td>
			
		</tr>
		<?php } ?>
	</table>
	</div>
	
	  </div>
	</div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->