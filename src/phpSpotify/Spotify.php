<?php

namespace phpSpotify;

use phpSpotify\Service\Search;
use phpSpotify\SpotifyException;

require_once dirname(__FILE__).'/SpotifyException.php';

/**
 * Main Spotify class
 * @author onamali
 *
 */
class Spotify {
	
	const SPOTIFYURL = 'http://ws.spotify.com/';
	const RESPONSEFORMAT = 'json';
	const DEFAULTSPOTIFYAPIVERSION = 1;
	
	protected $spotifyurl;
	protected $apiversion;
	
	public function __construct($spotifyurl=self::SPOTIFYURL,$apiversion=self::DEFAULTSPOTIFYAPIVERSION) {
		$this->apiversion=$apiversion;
		$this->spotifyurl=$spotifyurl;
    }
    
    /**
     * Tries to make an api call depending on method name
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments) {
    	$call=preg_split('/(?<=\\w)(?=[A-Z])/', $name);
    	$service=(isset($call[0])?$call[0]:null);
    	$method=(isset($call[1])?$call[1]:null);
    	
    	$servicename=ucfirst(strtolower($service));
    	$servicefilename=dirname(__FILE__).'/Service/'.$servicename.'.php';
    	$serviceclassname='phpSpotify\Service\\'.$servicename;
    	if(is_readable($servicefilename)) {
    		require_once($servicefilename);
    	}else{
    		throw new SpotifyException('Service "'.$servicename.'" Not Found');
    		return false;
    	}
    	if(class_exists($serviceclassname)) {
	    	$request=new $serviceclassname($method,$arguments);
	    	return $this->request($request);
    	}else{
    		throw new SpotifyException('Service "'.$servicename.'" Not Found');
    		return false;
    	}
    }
    
    /**
     * Performs the actual call to the api
     * @param string $service
     * @param string $method
     * @param array $params
     * @return mixed
     */
    protected function request($request) {
    	$url=$this->spotifyurl.$request->name.'/'.$this->apiversion.'/'.$request->method.'.'
    		.self::RESPONSEFORMAT.'?'.http_build_query($request->params);
        
    	$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
        return json_decode(curl_exec($curl));
    }
    
}