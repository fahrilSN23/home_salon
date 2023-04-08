<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	public function index(){
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
		$data['tk'] = $this->model_app->view_where('tentangkami', array('id' => 1))->row_array();
		$data['record'] = $this->model_app->view_ordering('jenis','id_jenis','ASC');
		$data['record1'] = $this->db->query("SELECT * FROM produk WHERE aktif = 1 ORDER BY RAND() LIMIT 3");
		$this->template->load('main/template','main/content',$data);
	}
}
