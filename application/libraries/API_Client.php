<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once GOOGLE_API_PATH . 'Google/Client.php';
require_once GOOGLE_API_PATH . 'Google/Service/Analytics.php';
require_once GOOGLE_API_PATH . 'Google/Service/Books.php';
require_once GOOGLE_API_PATH . 'Google/Service/Plus.php';

class API_Client
{
  protected 	$ci;
  private 		$client;
  private 		$plus;

	public function __construct()
	{
        $this->ci =& get_instance();

        $this->client = new Google_Client();
		$this->client->setApplicationName( APP_NAME );
		$this->client->setClientId( OAUTH_CLIENT_ID );
		$this->client->setClientSecret( OAUTH_SECRET );
		$this->client->setRedirectUri('postmessage');

		$this->plus = new Google_Service_Plus( $this->client );
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

	public function autenticate($code)
	{
        // Exchange the OAuth 2.0 authorization code for user credentials.
        $this->client->authenticate($code);
        $data["token"] = json_decode($this->client->getAccessToken());

        // $token = json_decode($this->client->getAccessToken());
		// Verifica el token
		// $reqUrl = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=' .
		//   $token->access_token;
		// $req = new Google_HttpRequest($reqUrl);

		// $tokenInfo = json_decode( $client::getIo()->authenticatedRequest($req)->getResponseBody() );
		// exit( json_encode( $tokenInfo ) );

        // You can read the Google user ID in the ID token.
        // "sub" represents the ID token subscriber which in our case
        // is the user ID. This sample does not use the user ID.
        $attributes = $this->client->verifyIdToken($data["token"]->id_token, OAUTH_CLIENT_ID)
            ->getAttributes();
        $data["email"] = $attributes["payload"]["email"];
        return $data;
	}

	public function get_people($token)
	{
		$this->client->setAccessToken($token);
    	$people = $this->plus->people->listPeople('me', 'visible', array());
    	return $people->toSimpleObject();
	}

	public function revoke_token($token)
	{
		$this->client->revokeToken($token);
	}
	
}

/* End of file API_Client.php */
/* Location: ./application/libraries/API_Client.php */
