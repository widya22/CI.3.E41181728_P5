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