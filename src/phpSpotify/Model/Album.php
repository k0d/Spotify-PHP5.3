<?php

namespace phpSpotify\Model;

class Album {
    
    protected $rawalbum;

    public function __construct($rawalbum) {
        $this->rawalbum = $rawalbum;
    }

    public function getRawalbum() {
        return $this->rawalbum;
    }

    public function getName() {
        return (isset($this->rawalbum->name) ? $this->rawalbum->name : false);
    }

    public function getArtist() {
        return (isset($this->rawalbum->artist) ? $this->rawalbum->artist : false);
    }

    public function getArtisturi() {
        $varname = 'artist-id';
        return (isset($this->rawalbum->$varname) ? $this->rawalbum->$varname : false);
    }

    public function getYear() {
        return (isset($this->rawalbum->released) ? $this->rawalbum->released : false);
    }

    public function getUri() {
        return (isset($this->rawalbum->href) ? $this->rawalbum->href : false);
    }

    public function isAvailableIn($territory) {
        $territories_raw = strtolower(isset($this->rawalbum->availability->territories) ? $this->rawalbum->availability->territories : '');
        if($territories_raw==='worldwide') {
            return true;
        }
        return in_array(strtolower($territory),explode(' ',$territories_raw));
    }

}