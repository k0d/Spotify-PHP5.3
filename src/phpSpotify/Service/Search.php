<?php

namespace phpSpotify\Service;

class Search extends Base {
    
    protected $name = 'search';
    protected $methods = array(
        'album'=>array(
            'q'=>TRUE,
            'page'=>FALSE
        ),
        'artist'=>array(
            'q'=>TRUE,
            'page'=>FALSE
        ),
    	'track'=>array(
            'q'=>TRUE,
            'page'=>FALSE
        )
    );

    public function __construct($method, $params) {
        $this->method = $method;
        $this->params = array(
            'q'=>$params[0],
            'page'=>(isset($params[1]) ? $params[1] : 1)
        );
    }

}