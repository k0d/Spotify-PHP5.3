<?php

namespace phpSpotify\Service;

class Search {
	
	protected $name='search';
	protected $params;
	protected $method;
	protected $methods=array(
		'album'=>array(
			'q'=>TRUE,
			'page'=>FALSE,
		),
		'artist'=>array(
			'q'=>TRUE,
			'page'=>FALSE,
		),
		'track'=>array(
			'q'=>TRUE,
			'page'=>FALSE,
		),
	);
	
	public function __construct($method,$params) {
		$this->method=$method;
		$this->params=array(
    		'q'=>$params[0],
    		'page'=>(isset($params[1])?$params[1]:1)
    	);
	}
	
    public function __get($varname) {
    	if(isset($this->$varname)) {
    		return $this->$varname;
    	}
    	return null;
    }
	
}