<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once GOOGLE_API_PATH . 'Google/Client.php';
require_once GOOGLE_API_PATH . 'Google/Service/Analytics.php';
require_once GOOGLE_API_PATH . 'Google/Service/Books.php';

class API_Client
{
  protected 	$ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function do_something()
	{
		$client = new Google_Client();
		$client->setApplicationName( APP_NAME );
  		$client_id = GOOGLE_CLIENT_ID;
		$email_address = GOOGLE_CLIENT_EMAIL_ADDRESS;
		$keyfile = "keys/Localdash-3ff365cea570.p12";
		$client->setAssertionCredentials(
			    new Google_Auth_AssertionCredentials(
			        $email_address, // Auth email
			        array(Google_Service_Analytics::ANALYTICS_READONLY), // Scopes
			       	file_get_contents(APPPATH . $keyfile) // keyfile
			    )
			);
		$client->setClientId($client_id); // from API console
		$analytics = new Google_Service_Analytics($client);
		$accounts = $analytics->management_accounts->listManagementAccounts();
		exit( json_encode( $accounts ) );
	}
	
}

/* End of file API_Client.php */
/* Location: ./application/libraries/API_Client.php */
