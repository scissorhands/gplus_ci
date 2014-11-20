<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gplus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("api_client");
		$this->load->model("gclients_model", "gclients");
	}

	public function connect()
	{
		$state = $this->input->post("state");
		if( !$state OR $state != $this->session->userdata("state") ){ exit("wrong parameter"); }
		$code = $this->input->post("code");
		$token_bearer = $this->api_client->autenticate( $code );
		$google_user = array(
			"token" => json_encode($token_bearer["token"]),
			"email" => $token_bearer["email"],
		);
		$guser = $this->gclients->get_user( $google_user["email"] );
		if( !$guser ){;
			$google_user["refresh_token"] = $token_bearer["token"]->refresh_token;
			$this->gclients->insert_client($google_user);
		}
		$this->session->set_userdata($google_user);
		$data = array( "status" => "success" );
		echo json_encode( $data );
	}

	public function get_people()
	{
		$token = $this->session->userdata("token");
		$people = $this->api_client->get_people( $token );
		echo json_encode( $people );
	}

	public function show_users()
	{
		$users = $this->gclients->get_users();
		$people = array();
		foreach ($users as $user) {
			$people[$user->email] = $this->api_client->get_people( $user->token );
		}
		exit( json_encode( $people ) );
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
			$this->gclients->delete_token($this->session->userdata("email"));
		    $this->api_client->revoke_token($token);
		    $this->session->unset_userdata("token");
		    $this->session->unset_userdata("email");
		}
	    echo json_encode( array("status" => "Successfully logged out") );
	}
}

/* End of file gplus.php */
/* Location: ./application/controllers/gplus.php */