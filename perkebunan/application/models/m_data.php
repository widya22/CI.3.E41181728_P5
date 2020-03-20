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