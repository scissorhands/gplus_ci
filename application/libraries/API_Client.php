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
		$this->client->setClientId( GOOGLE_CLIENT_ID );
		$this->client->setClientSecret( GOOGLE_SECRET );
		$this->client->setRedirectUri('postmessage');

		$this->plus = new Google_Service_Plus( $this->client );
	}

	public function autenticate($code)
	{
        $this->client->authenticate($code);
        $data["token"] = json_decode($this->client->getAccessToken());
        $attributes = $this->client->verifyIdToken($data["token"]->id_token, GOOGLE_CLIENT_ID)
            ->getAttributes();
        $data["email"] = $attributes["payload"]["email"];
        return $data;
	}

	public function list_people($token)
	{
		$this->client->setAccessToken($token);
		try {
    		$people = $this->plus->people->listPeople('me', 'visible',[]);
		} catch (Exception $e) {
			exit( json_encode(['error'=>$e->getMessage()]));
		}
    	return $people->toSimpleObject();
	}

	public function get_people($token)
	{
		$this->client->setAccessToken($token);
		try {
    		$people = $this->plus->people->get('me',[]);
		} catch (Exception $e) {
			exit( json_encode(['error'=>$e->getMessage()]));
		}
    	return $people->toSimpleObject();
	}

	public function revoke_token($token)
	{
		$this->client->revokeToken($token);
	}
	
}

/* End of file API_Client.php */
/* Location: ./application/libraries/API_Client.php */
