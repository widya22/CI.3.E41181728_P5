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