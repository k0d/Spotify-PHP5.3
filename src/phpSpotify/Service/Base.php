<?php

namespace phpSpotify\Service;

abstract class Base {
    
    protected $params;
    protected $method;

    public function __get($varname) {
        if(isset($this->$varname)) {
            return $this->$varname;
        }
        return null;
    }

}