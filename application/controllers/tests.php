<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("api_client");
		$this->load->model("gclients_model", "gclients");
	}

	public function index()
	{
		echo "this is a test";
	}

	public function gplus_session_client_enviroment()
	{
		$state = md5(rand());
		$this->session->set_userdata( array( "state" => $state ));
		$data = array(
			"title" 	=>	"Gplus: flujo del entorno del servidor",
			"content" 	=>	"gplus/login_client_enviroment",
			"state" 	=>	$state,
			"client_id"	=>	GP_CLIENT_ID
		);
		$this->load->view("template/loader", $data);
	}

	public function user_contacts($index = 0)
	{
		$clients = $this->gclients->get_users();
		$user = $clients[$index];
		$people = $this->api_client->get_people( $user->token );
		echo json_encode( $people );
	}

	public function remaining_time($index = 0)
	{
		$clients = $this->gclients->get_users();
		$user = $clients[$index];
		$time_created = json_decode($user->token)->created;
		$t=time();
		$timediff=$t-$time_created;
		exit( "$timediff" );
	}

	public function show_session()
	{
		echo json_encode( $this->session->all_userdata() );
	}

}

/* End of file tests.php */
/* Location: ./application/controllers/tests.php */