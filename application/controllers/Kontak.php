<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kontak extends CI_Controller {
	public function index(){
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
		$this->template->load('main/template','main/kontak',$data);
	}
}
