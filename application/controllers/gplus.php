<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gplus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("api_client");
	}

	public function connect()
	{
		$state = $this->input->post("state");
		if( !$state OR $state != $this->session->userdata("state") ){ exit("wrong parameter"); }
		$code = $this->input->post("code");
		$token_bearer = $this->api_client->autenticate( $code );
		$set_data["token"] = json_encode($token_bearer["token"]);
		$this->session->set_userdata($set_data);
		// $data = array( "status" => "success", "bearer" => $token_bearer );
		$data = array( "status" => "success" );
		echo json_encode( $data );
	}

	public function get_people()
	{
		$token = $this->session->userdata("token");
		$people = $this->api_client->get_people( $token );
		echo json_encode( $people );
	}

	public function get_token()
	{
		$data["token"] = $this->session->userdata("token");
		echo $data["token"];
	}

	public function client_test()
	{
		$this->api_client->do_something();
	}

	public function disconnect()
	{
		if( $this->session->userdata("token") ){
			$token = json_decode($this->session->userdata("token"))->access_token;
		    $this->api_client->revoke_token($token);
		    $this->session->unset_userdata("token");
		}
	    echo json_encode( array("status" => "Successfully logged out") );
	}
}

/* End of file gplus.php */
/* Location: ./application/controllers/gplus.php */