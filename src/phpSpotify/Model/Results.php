<?php

namespace phpSpotify\Model;

use phpSpotify\SpotifyException;

class Results {
	
	protected $rawresults;
	
	public function parseRaw($rawresults) {
		$this->rawresults=$rawresults;
		return true;
	}
	
	public function getRawresults() {
		return $this->rawresults;
	}
	
	public function getInfo() {
		return (isset($this->rawresults->info)?$this->rawresults->info:false);
	}
	
	public function getType() {
		return (isset($this->rawresults->info->type)?$this->rawresults->info->type:false);
	}
	
	public function getCount() {
		if($this->getInfo()) {
			return (isset($this->rawresults->info->num_results)?$this->rawresults->info->num_results:1);
		}else{
			return false;
		}
	}
	
	public function getLimit() {
		return (isset($this->rawresults->info->limit)?$this->rawresults->info->limit:false);
	}
	
	public function getOffset() {
		return (isset($this->rawresults->info->offset)?$this->rawresults->info->offset:false);
	}
	
	public function getPage() {
		return (isset($this->rawresults->info->page)?$this->rawresults->info->page:false);
	}
	
	public function getQuery() {
		return (isset($this->rawresults->info->query)?$this->rawresults->info->query:false);
	}
	
    public function __call($name, $arguments) {
    	$call=preg_split('/(?<=\\w)(?=[A-Z])/', $name);
    	$function=(isset($call[0])?$call[0]:null);
    	$type=strtolower(isset($call[1])?$call[1]:null);
    	$resultsisarray=($this->getCount()>1?true:false);
		switch ($type) {
		    case 'album':
		    	$modelname='Album';
		    	$requestisarray=false;
		        break;
		    case 'albums':
		    	$modelname='Album';
		    	$requestisarray=true;
		        break;
		    case 'artist':
		    	$modelname='Artist';
		    	$requestisarray=false;
		        break;
		    case 'artists':
		    	$modelname='Artist';
		    	$requestisarray=true;
		        break;
		    case 'track':
		    	$modelname='Track';
		    	$requestisarray=false;
		        break;
		    case 'tracks':
		    	$modelname='Track';
		    	$requestisarray=true;
		        break;
		    default:
		    	throw new SpotifyException('Function "'.$name.'" Not Found.');
		    	return false;
		}
		if($this->rawresults->info->type!==strtolower($modelname)) {
			throw new SpotifyException('Results contain "'.ucfirst($this->rawresults->info->type).'" not "'.ucfirst($type).'".');
	    	return false;
		}else{
			if($resultsisarray!==$requestisarray) {
				throw new SpotifyException('Results contain "'.ucfirst($this->rawresults->info->type).'" not "'.ucfirst($type).'".');
				return false;
			}else{
		    	$modelfilename=dirname(__FILE__).'/'.$modelname.'.php';
		    	$modelclassname='phpSpotify\Model\\'.$modelname;
		    	if(is_readable($modelfilename)) {
		    		require_once($modelfilename);
		    	}else{
		    		throw new SpotifyException('Function "'.$name.'" Not Found.');
		    		return false;
		    	}
		    	if(class_exists($modelclassname)) {
		    		if($resultsisarray) {
		    			$models=array();
		    			foreach($this->rawresults->$type as $result) {
			    			$models[]=new $modelclassname($result);
		    			}
			    		return $models;
		    		}else{
			    		$model=new $modelclassname($this->rawresults->$type);
			    		return $model;
		    		}
		    	}else{
		    		throw new SpotifyException('Function "'.$name.'" Not Found.');
		    		return false;
		    	}
			}
		}
    }
}