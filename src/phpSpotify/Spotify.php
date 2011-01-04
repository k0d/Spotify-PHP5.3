<?php

namespace phpSpotify;

class Spotify {
	
	const SPOTIFYURL = 'http://ws.spotify.com/';
	const DEFAULTRESPONSEFORMAT = 'xml';
	const DEFAULTSPOTIFYAPIVERSION = 1;
	
	public function __construct() {
		
    }
    
    static public function searchArtist($artist,$page=1) {
    	$wsURL=self::SPOTIFYURL.'search/'.self::DEFAULTSPOTIFYAPIVERSION.'/artist';
    	$wsPARAMS=array(
    		'q'=>$artist,
    		'page'=>$page
    	);
    	$wsURL.='?'.http_build_query($wsPARAMS);
    	return $wsURL;
    }
    
}