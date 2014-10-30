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

	public function save_token()
	{
		$code = $this->input->post("code");
		// $data["code"] = $code;
		// exit( json_encode( $code ) );
		$token = $this->api_client->autenticate( $code );
		$people = $this->api_client->get_people( $token->access_token );
		// exit( json_encode( $people ) );
		$data["access_token"] = $token->access_token;

		$this->session->set_userdata($data);
		echo json_encode($data);
	}

	public function get_token()
	{
		$data["access_token"] = $this->session->userdata("access_token");
		echo json_encode( $data );
	}

	public function show_sess()
	{
		$session = $this->session->all_userdata();
		exit( json_encode( $session ) );
	}

	public function client_test()
	{
		$this->api_client->do_something();
	}

}

/* End of file tests.php */
/* Location: ./application/controllers/tests.php */