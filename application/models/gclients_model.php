<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gclients_model extends CI_Model {

	public function insert_client($client)
	{
		$this->db->insert("google_clients", $client);
	}

	public function get_users()
	{
		$query = $this->db->get("google_clients");
		return $query->result();
	}

	public function get_user($email)
	{
		$query = $this->db->where("email", $email)->get("google_clients");
		return $query->result();
	}

	public function delete_token($email)
	{
		$this->db->where("email", $email)->delete("google_clients");
	}

}

/* End of file gclients_model.php */
/* Location: ./application/models/gclients_model.php */