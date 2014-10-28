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
		$data = array(
			"title" => "Gplus: flujo del entorno del cliente",
			"content" => "gplus/login_client_enviroment",
			"client_id" => GP_CLIENT_ID,
		);
		$this->load->view("template/loader", $data);
	}

	public function client_test()
	{
		$this->api_client->do_something();
	}

}

/* End of file tests.php */
/* Location: ./application/controllers/tests.php */