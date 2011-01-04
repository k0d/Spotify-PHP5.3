<?php

namespace phpSpotify;

/**
 * Main Spotify class
 * @author mark
 *
 */
class Spotify {
	
	const SPOTIFYURL = 'http://ws.spotify.com/';
	const DEFAULTRESPONSEFORMAT = 'xml';
	const DEFAULTSPOTIFYAPIVERSION = 1;
	
	public function __construct() {
		
    }
    
    /**
     * Performs a search for 
     * @param string $artist
     * @param int $page
     * @param string $responseformat
     * @return Ambigous <object, SimpleXMLElement, mixed>
     */
    static public function searchArtist($artist,$page=1,$responseformat=null) {
    	$responseformat=strtolower(isset($responseformat)?$responseformat:self::DEFAULTRESPONSEFORMAT);
    	$wsURL=self::SPOTIFYURL.'search/'.self::DEFAULTSPOTIFYAPIVERSION.'/artist.'.$responseformat;
    	$wsPARAMS=array(
    		'q'=>$artist,
    		'page'=>$page
    	);
    	$wsURL.='?'.http_build_query($wsPARAMS);
    	return self::request($wsURL,$responseformat);
    }
    
    /**
     * Performs a request and decodes the results depending on response format
     * @param string $url
     * @param string $responseformat
     * @return SimpleXMLElement|mixed
     */
    protected function request($url,$responseformat)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if($responseformat==='xml') {
        	return simplexml_load_string(curl_exec($curl));
        }else{
        	return json_decode(curl_exec($curl));
        }
    }
    
}