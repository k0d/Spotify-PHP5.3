<?php

namespace phpSpotify;

use phpSpotify\Model\Results;

use phpSpotify\Service\Search;
use phpSpotify\SpotifyException;

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
		spl_autoload_register(__NAMESPACE__ .'\Spotify::autoload');
    }
    
   	static protected function autoload($class) {
    	$filename=dirname(__FILE__).'/'.str_replace('phpSpotify/', '', str_replace('\\','/',$class)).'.php';
    	if(file_exists($filename)) {
	        require_once($filename);
	    }
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
    	$serviceclassname='phpSpotify\Service\\'.$servicename;
    	if(class_exists($serviceclassname)) {
	    	$request=new $serviceclassname($method,$arguments);
	    	$rawresults=$this->request($request);
	    	if(is_null($rawresults)) {
	    		throw new SpotifyException('Unable to connect to the Spotify Metadata API.');
	    		return false;
	    	}else{
		    	$results=new Results();
		    	$results->parseRaw($rawresults);
		    	return $results;
	    	}
    	}else{
    		throw new SpotifyException('Service "'.$servicename.'" Not Found.');
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