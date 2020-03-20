<?php

//Pewarisan sifat pada class Overview dari CI_Controller
class Home extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
        // saat method index dijalankan maka akan di lempar view admin/overview.php
        
        $this->load->view("template/v_home_header");
        $this->load->view("template/v_home_sidebar");
        $this->load->view("template/v_home_index");
        $this->load->view("template/v_home_footer");
	}
}