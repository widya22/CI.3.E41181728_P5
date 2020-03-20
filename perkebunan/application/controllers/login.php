<?php 

class Login extends CI_Controller{
	//fungsi yang pertama dijalankan pada saat class Login dijalanakan 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');//(untuk mengaktifkan modelm_login)

	}

	function index(){
		$this->load->view('v_login'); //function index akanmelemparke view v_login
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