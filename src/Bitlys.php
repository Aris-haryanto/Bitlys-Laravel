<?php

namespace Arisharyanto\Bitlys;
 
use App\Http\Controllers\Controller;
 
class Bitlys extends Controller
{
 
    function __construct(){
    	$config['access_token'] = config('bitlys.access_token');
    	$config['bitly_base_url'] = config('bitlys.bitly_base_url');
        $this->config = (object) $config;
    }

    public function sendResponse($type, $url, $param){
    	$server_output = '';

    	if($type == 'POST'){
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_POST, count($param));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	        $server_output = curl_exec($ch);
	        curl_close($ch);

	    }else if($type == 'GET'){
	    	$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($param));
	    	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    	$server_output = curl_exec($ch);
	        curl_close($ch);

	    }

        return json_decode($server_output);
        
	}

	public static function shorten($url){
		$_this = new self;
		$host 	= $_this->config->bitly_base_url.'v3/shorten';
		$param 	= array(
						'access_token' => $_this->config->access_token,
                        'longUrl'  => $url
                      	);

	    $result = $_this->sendResponse('GET', $host, $param);
	    return $result->data->url;
	}

	public static function expand($url){
		$_this = new self;
		$host 	= $_this->config->bitly_base_url.'v3/expand';
		$param 	= array(
						'access_token' => $_this->config->access_token,
						'shortUrl' => $url
						);

	    $result = $_this->sendResponse('GET', $host, $param);
	    return $result->data->expand[0]->long_url;
	}

	public static function clicks($url){
		$_this = new self;
		$host 	= $_this->config->bitly_base_url.'v3/link/clicks';
		$param 	= array(
						'access_token' => $_this->config->access_token,
						'link' => $url
						);

	    $result = $_this->sendResponse('GET', $host, $param);
	    return $result->data->link_clicks;
	}

	public static function countries($url){
		$_this = new self;
		$host 	= $_this->config->bitly_base_url.'v3/link/countries';
		$param 	= array(
						'access_token' => $_this->config->access_token,
						'link' => $url
						);

	    $result = $_this->sendResponse('GET', $host, $param);
	    return $result->data->countries;
	}

 
}