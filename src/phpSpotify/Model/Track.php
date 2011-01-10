<?php

namespace phpSpotify\Model;

class Track {
	
	protected $rawtrack;
	
	public function __construct($rawtrack) {
		$this->rawtrack=$rawtrack;
	}
	
	public function getRawtrack() {
		return $this->rawtrack;
	}
	
	public function getName() {
		return (isset($this->rawtrack->name)?$this->rawtrack->name:false);
	}
	
	public function getUri() {
		$varname='href';
		return (isset($this->rawtrack->$varname)?$this->rawtrack->$varname:false);
	}
	
	public function isAvailable() {
		return (isset($this->rawtrack->available)?$this->rawtrack->available:false);
	}
	
	public function getArtists() {
		return (isset($this->rawtrack->artists)?$this->rawtrack->artists:false);
	}
	
	public function getAlbum() {
		return (isset($this->rawtrack->album)?$this->rawtrack->album:false);
	}
	
	public function isAvailableIn($territory) {
		$territories_raw=strtolower(isset($this->rawtrack->availability->territories)?$this->rawtrack->availability->territories:'');
		if($territories_raw==='worldwide') {
			return true;
		}
		return in_array(strtolower($territory), explode(' ',$territories_raw));
	}
	
	public function getLength() {
		return (isset($this->rawtrack->length)?$this->rawtrack->length:false);
	}
	
	public function getPopularity() {
		return (isset($this->rawtrack->popularity)?$this->rawtrack->popularity:false);
	}
	
	public function getTracknumber() {
		$varname='track-number';
		return (isset($this->rawtrack->$varname)?$this->rawtrack->$varname:false);
	}
	
}