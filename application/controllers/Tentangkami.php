<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tentangkami extends CI_Controller {
	public function index(){
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
		$data['tk'] = $this->model_app->view_where('tentangkami', array('id' => 1))->row_array();
		$this->template->load('main/template_sub','main/tentangkami',$data);
	}
}
