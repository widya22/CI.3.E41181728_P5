<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit Buruh</title>
   <!-- Custom fonts for this template-->
   <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin-2.min.css')?>" rel="stylesheet">

</head>
<body class="bg-gradient-primary">
	<h1></h1>
	<!-- mengarahkan aksi login ke fungsi aksi_login di controller login -->
	<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Data Buruh</h1>
                  </div>
<!-- data dari crud/edit disimpan di $user( tabel user) -->
	<?php foreach($user as $u){ ?>
  <!-- akan dieksekusi di crud/update -->
	<form action="<?php echo base_url(). 'crud/update'; ?>" method="post">
	<div class="form-group">
    <label for="formGroupExampleInput">Nama</label>
    <input type="hidden" class="form-control" id="formGroupExampleInput" name="id" value="<?php echo $u->id ?>">
					<input type="text" class="form-control" id="formGroupExampleInput" name="nama" value="<?php echo $u->nama ?>">
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput">Alamat</label>
    <td><input type="text" class="form-control" id="formGroupExampleInput" name="alamat" value="<?php echo $u->alamat ?>"></td>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Telepon</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="pekerjaan" value="<?php echo $u->pekerjaan ?>">
  </div>
  <input class="btn btn-primary" type="submit" value="Submit">
	</form>	

	<?php } ?>

	</div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

 <!-- Bootstrap core JavaScript-->
 <script src="<?php echo base_url('assets/jquery/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js')?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('js/sb-admin-2.min.js')?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('asset/chart.js/Chart.min.js')?>"></script>
    <script src="<?php echo base_url('assetsdatatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap4.min.js')?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('js/demo/chart-area-demo.js')?>"></script>
  <script src="<?php echo base_url('js/demo/chart-pie-demo.js')?>"></script>
  <script src="<?php echo base_url('js/demo/datatables-demo.js')?>"></script>
  <script src="<?php echo base_url('js/demo/chart-bar-demo.js')?>"></script>
</body>
</html>