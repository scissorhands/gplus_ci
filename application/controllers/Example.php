<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("api_client");
	}

	public function index()
	{
		$data = [
			"title" 	=>	"Google+: Sign In",
			"content" 	=>	"gplus/home"
		];
		$this->load->view("template/loader", $data);
	}

	public function gplus_sign_in()
	{
		$state = md5(rand());
		$this->session->set_userdata(["state" => $state]);
		$data = [
			"title" 	=>	"Google+: Sign In",
			"content" 	=>	"gplus/google_sign_in",
			"state" 	=>	$state,
			"client_id"	=>	GOOGLE_CLIENT_ID
		];
		$this->load->view("template/loader", $data);
	}

}

/* End of file Example.php */
/* Location: ./application/controllers/Example.php */