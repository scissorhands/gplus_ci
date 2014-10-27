<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class API_Client
{
  protected 	$ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function do_something()
	{
		echo "something";
	}
	
}

/* End of file API_Client.php */
/* Location: ./application/libraries/API_Client.php */
