<?php

namespace phpSpotify\Service;

class Search {
	
	protected $name='search';
	protected $params;
	protected $method;
	
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