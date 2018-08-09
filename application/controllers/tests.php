<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("api_client");
	}

	public function index()
	{
		echo "this is a test";
	}

	public function gplus_session_client_enviroment()
	{
		$state = md5(rand());
		$this->session->set_userdata(["state" => $state]);
		$data = array(
			"title" 	=>	"Google+: Sign In",
			"content" 	=>	"gplus/login_client_enviroment",
			"state" 	=>	$state,
			"client_id"	=>	GOOGLE_CLIENT_ID
		);
		$this->load->view("template/loader", $data);
	}
}

/* End of file tests.php */
/* Location: ./application/controllers/tests.php */