<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller {

	public function index()
	{
		echo "this is a test";
	}

	public function client_test()
	{
		$this->load->library("api_client");
		$this->api_client->do_something();
	}

}

/* End of file tests.php */
/* Location: ./application/controllers/tests.php */