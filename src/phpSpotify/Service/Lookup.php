<?php

namespace phpSpotify\Service;

class Lookup extends Base{
	
	protected $name='lookup';
	protected $params;
	protected $method;
	
	public function __construct($method,$params) {
		$this->method=$method;
		$this->params=array(
    		'uri'=>$params[0],
    		'extras'=>(isset($params[1])?$params[1]:'')
    	);
	}
	
}