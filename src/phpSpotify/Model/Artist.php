<?php

namespace phpSpotify\Model;

class Artist {
	
	protected $rawartist;
	
	public function __construct($rawartist) {
		$this->rawartist=$rawartist;
	}
	
	public function getRawartist() {
		return $this->rawartist;
	}
	
	public function getName() {
		return (isset($this->rawartist->name)?$this->rawartist->name:false);
	}
	
	public function getUri() {
		return (isset($this->rawartist->href)?$this->rawartist->href:false);
	}
	
}