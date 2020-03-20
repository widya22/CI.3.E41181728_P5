# CI.3.E41181728_P5
Tugas Membuat Web Sederhana
# DOKUMENTASI PRAKTIKUM 5 WEB Sederhana
## Komponen yang Diperlukan
Berikut adalah komonenyang diperluan untuk pembuatan WEB Sederhana, yaitu :
1. PHP MYSQL
2. Webserver XAMPP atau Wampp
3. Code Igniter 3.1.11
4. Text editor Visual Studio code atau Sublime (saya menggunakan Visual Studio Code)
5. Template SB Admin

## Persiapan 
1.	Download Codeigniter 
2.	Setelah download, extract CodeIgniter dan pindahkan ke htdocs pada direktori xampp lalu rename folder CodeIgiter sesuai keinginan. Namun disini saya ganti dengan nama perkebunan.
3.	Download SB Admin 2
4.	Extract SB Admin 2
5.	Copy folder css, vendor, dan js pada SB Admin 2, kemudian paste pada foder CI yang telah diletakkan di htdoc
6.	Buat database 
## Langkah-Langkah
A.	Lakukan kofigurasi pada aplication/config/config.php. sesuaikan dengan url kalian
``` bash
$config['base_url'] = 'http://localhost/CI.3.E41181728_P5/perkebunan/';

```

B.	Lakukan konfigurasi pada aplication/config/autoload.php
``` bash
$autoload['libraries'] = array('database','session', 'form_validation');

```
``` bash
$autoload['helper'] = array('url');
$autoload['helper'] = array('url');
```

C.	Atur application/config/database.php
``` bash
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'nama database', 
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

```
D.	Buat file login.php pada aplication/controller
``` bash
<?php 

class Login extends CI_Controller{
    //fungsi yang pertama dijalankan pada saat class Login dijalanakan 
    function __construct(){
        parent::__construct();      
        $this->load->model('m_login');//(untuk mengaktifkan model m_login)

    }

    function index(){
        $this->load->view('v_login'); //function index akan melemparke view v_login
    }

    function aksi_login(){
        $username = $this->input->post('username');//menangkap data username
        $password = $this->input->post('password');//menangkap data password
        //data username dan passwrod dimasukkan ke dalam array
        $where = array(
            'username' => $username,
            'password' => ($password)
            );
        $cek = $this->m_login->cek_login("admin",$where)->num_rows(); //menghitung jumlah record
        //jika username dan password diteukan atau benar
        if($cek > 0){

            $data_session = array( //membuat sebuah session
                'nama' => $username, //session nama dengan isi username
                'status' => "login" //session status berisi login
                );

            $this->session->set_userdata($data_session);

            redirect(base_url("admin")); //dempar ke controller admin
        
        //jika username dan password tidak di temukan atau maka akan ditamplikan pesan  
        }else{
            echo "Username dan password salah !";
        }
    }

    function logout(){
        $this->session->sess_destroy(); //untuk menghapus semua session
        redirect(base_url('login')); //dikembalikan ke lohin
    }
    
}

```	

E.	Buat file m_login pada aplication/models
``` bash
<?php 

class M_login extends CI_Model{ 
    function cek_login($table,$where){      
        return $this->db->get_where($table,$where);
    }   
}

```	
F.	Buat file admin.php pada aplication/controller
``` bash
<?php 

class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        //untuk mengetahui user sudah berhasil login
        if($this->session->userdata('status') != "login"){ //untuk mengecek user sudah memiliki session, jika punya akan menjalankan function index dibawah
            redirect(base_url("login")); //jika user tidak memiliki session maka dialihkan ke halaman login
        }
    }

    function index(){
         //dilempar ke view template
         $this->load->view("template/v_home_header");
        $this->load->view("template/v_home_sidebar");
        $this->load->view("template/v_home_index");
        $this->load->view("template/v_home_footer");
    }
}

```
G.	Buat file v_login.php pada aplication/views. Jangan lupa masukkan template. Setelah masukkan template, tambahkan code berikut
	

``` bash
<form class="user" action="<?php echo base_url('login/aksi_login'); ?>" method="post">   
    
  <div class="form-group">
  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama" name="username">
  </div>
  <div class="form-group">
  <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Password" name="password">
  </div>
  <input class="btn btn-primary" type="submit" value="Login">
  </form>
```	
H.	Buat Folder template yang isinya v_home_header.php, v_home_sidebar.php, v_home_footer.php, v_home_index.php, v_home_index2.php (sesuaikan dengan tempalte yang dipakai, ini untuk menampikan layout dari template yang  dipaki saya menggunakan SB Admin 2)

``` bash
<!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin-2.min.css')?>" rel="stylesheet">


```	
Hanya pada bagian link ditambahkan echo base_url

I.	Buat file crud.php pada aplication/controller. Ini digunakan untuk mengontrol models dan views.
``` bash
<?php 

class Crud extends CI_Controller{

    function __construct(){
        parent::__construct();      
        $this->load->model('m_data'); //untuk membuka model m_data(untuk mengkases database)
        $this->load->helper('url');

    }

    function index(){
        
        $this->load->view("template/v_home_header");
        $this->load->view("template/v_home_sidebar");
        $this->load->view("template/v_home_index");
        
        $this->load->view("template/v_home_footer");
    }

    function tampilkan(){
        //menyimpan data yg dikirim dari (m_data/tampilkan_data) ke sebuah array $data
        $data['user'] = $this->m_data->tampil_data()->result(); 
        $this->load->view("template/v_home_header"); //dilembar ke template/v_home_header untuk menampilkan template header
        $this->load->view("template/v_home_sidebar"); //dilembar ke template/v_home_sidebar untuk menampilkan template sidebar
        $this->load->view("template/v_home_index2"); ////dilembar ke template/v_home_index2 untuk menampilkan template index2
        $this->load->view('v_tampil',$data); // data yang disimpan di $data akan dilempar ke v_tampil
        $this->load->view("template/v_home_footer"); //dilembar ke template/v_home_footer untuk menampilkan template footer
    }

    function tambah(){
        $this->load->view('v_input'); // dari v_tampil akan dilempar ke v_input
    }

    function tambah_aksi(){
        $nama = $this->input->post('nama'); //untuk menangkap inputan dari input dengan name"nama" yang disimpan di $nama
        $alamat = $this->input->post('alamat'); //untuk menangkap inputan dari input dengan name"alamat" yang disimpan di $alamat
        $pekerjaan = $this->input->post('pekerjaan'); //untuk menangkap inputan dari input dengan name"pekerjaan"  yang disimpan di $pekerjaan

        // $Data untuk menyimpan data $nama, $alamat, $pekerjaan
        $data = array(
            // data $nama akandisimpan ke kolom nama di tabel 
            'nama' => $nama, 
            // data $alamat akan disimpan ke kolom alamat di tabel
            'alamat' => $alamat,
            // data $alamat akan disimpan ke kolom pekerja di tabel
            'pekerjaan' => $pekerjaan
            );
            //dieksekusi oleh functiion input_data di models m_data dengan membawa $data yang akan di masukkan ke tabel "user"
        $this->m_data->input_data($data,'user'); 
        redirect('crud/tampilkan'); //Selesai memaksukkan data ke tabel, akan dialihkan ke function tampilkan
    }

    function hapus($id){
        $where = array('id' => $id); //$id berdasarkan data pada kolom id di tabel yang akan disimpan di $where
        $this->m_data->hapus_data($where,'user'); //akan di eksekusi di m_data/hapus_data dengan parameternya $where(berisi id), dan nama tabel yaitu user
        redirect('crud/tampilkan'); //selesai menghapus data tampilan akan dialihkan ke tampilkan
    }
    function edit($id){ 
        $where = array('id' => $id); ////$id berdasarkan data pada kolom id di tabel yang akan disimpan di $where
        
        $data['user'] = $this->m_data->edit_data($where,'user')->result(); //dieksekusi oleh functiion edit_data di models m_data, result() digunakan untuk menangkan hasil dari function edit_data (membawa $data (berisi id) yang akan di edit dari tabel "user")
        $this->load->view('v_edit',$data); //$data akan dilempar ke v_edit
    }
    //menangkap data dari form edit
    function update(){
        $id = $this->input->post('id'); //$id berisi input dari name"id"
        $nama = $this->input->post('nama'); //$nama menangkap data inputan dari name "nama"
        $alamat = $this->input->post('alamat'); //$alamat menangkap data inputan dari name "alamat"
        $pekerjaan = $this->input->post('pekerjaan'); //pekerjaan menangkap data inputan dari name"pekerjaan"
        
        //data dijadikan array data
        $data = array(
            // data $nama akan disimpan ke kolom nama di tabel 
            'nama' => $nama,
            // data $alamat akan disimpan ke kolom alamat di tabel
            'alamat' => $alamat,
            // data $alamat akan disimpan ke kolom pekerja di tabel
            'pekerjaan' => $pekerjaan
        );
         
        //penentu lokasi data yang diupdate (parameter $where dari functionedit)
        $where = array(
            'id' => $id
        );
        //dieksekusi oleh fuction update_data di models m_data, berdasarkan $where(id yang ditangkap oleh edit) dan $data(data dari $nama,$alamat,$pekerjaan)
        $this->m_data->update_data($where,$data,'user');
        redirect('crud/tampilkan'); //selesai mengupdate, akan dialihkan ke tampilkan
    }
    function tampilkan_lapbur(){
        //menyimpan data yg dikirim dari (m_data/tampilkan_data) ke sebuah array $data
        $data['user'] = $this->m_data->tampil_data()->result(); 
        $this->load->view("template/v_home_header"); //dilembar ke template/v_home_header untuk menampilkan template header
        $this->load->view("template/v_home_sidebar"); //dilembar ke template/v_home_sidebar untuk menampilkan template sidebar
        $this->load->view("template/v_home_index2"); ////dilembar ke template/v_home_index2 untuk menampilkan template index2
        $this->load->view('v_lapbur',$data); // data yang disimpan di $data akan dilempar ke v_tampil
        $this->load->view("template/v_home_footer"); //dilembar ke template/v_home_footer untuk menampilkan template footer
    }
}
```
J.	Buat file m_data.php pada aplication/controller
``` bash
<?php 

class M_data extends CI_Model{
    function tampil_data(){
        // untuk mengambil data di tabel user, return digunakan untuk mengirim semua data dari tabel user ke fungsi yang memanggilnya(crud/tampilkan).
        return $this->db->get('user');  
    }

    //dari crud/tambah_aksi, $data akan diinputkan $table(user)
    function input_data($data,$table){ 
        $this->db->insert($table,$data);
    }

    //menghapus data dari database
    function hapus_data($where,$table){
        $this->db->where($where); //menyeleksi/menyesuaikan data berdasarkan $where
        $this->db->delete($table);//untuk menghapus record
    }

    //mengedit data dari database
    function edit_data($where,$table){      
        return $this->db->get_where($table,$where); //untuk mendapatkan data berdasarkan $where(id), return digunakan untuk mengirim data $where dari tabel user ke fungsi yang memanggilnya(crud/edit).
    }

        //mengupdate data dari database
    function update_data($where,$data,$table){
        $this->db->where($where); //berdasarkan $where(id dari fuction edit)
        $this->db->update($table,$data); //data yang tedapat di tabel user berdasarkan $where diupdate 
    }   
}
```	
K.	Buat v_admin.php pada aplication/views
``` bash
<!DOCTYPE html>
<html>
<head>
    <title>Membuat login dengan codeigniter | www.malasngoding.com</title>
</head>
<body>
    <h1>Login berhasil !</h1>
    <h2>Hai, <?php echo $this->session->userdata("nama"); ?></h2>
    <a href="<?php echo base_url('login/logout'); ?>">Logout</a>
</body>
</html>

```

L.	Buat v_tampil.php pada aplication/views
``` bash
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
    <center><?php echo anchor('crud/tambah','Tambah Data'); ?></center>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
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
            <td>
                <!-- anchor untuk membuat hyperlink -->
                    <!-- melempar ke crud/edit dengan membawa data id yang disimpan di $u -->
                  <?php echo anchor('crud/edit/'.$u->id,'Edit'); ?> 
                    <!-- melempar ke crud/hapus dengan membawa data id yang disimpan di $u -->
                  <?php echo anchor('crud/hapus/'.$u->id,'Hapus'); ?>
            </td>
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
```
M.	Buat v_input.php pada aplication/views
``` bash
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tambah Buruh</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Tambah Data Buruh</h1>
                  </div>
<!-- form ini akan dijalankan oleh function tambah_aksi di controller crud-->
  <form action="<?php echo base_url(). 'crud/tambah_aksi'; ?>" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Nama</label>
    <input type="text"  class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama" name="nama">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Alamat</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Alamat" name="alamat">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Telepon</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nomor Telepon" name="pekerjaan">
  </div>
  <input class="btn btn-primary" type="submit" value="Tambah">
  </form>
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

```
N.	Buat v_lapbur.php pada aplication/views		
``` bash
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

```	
O.	Selesai....
