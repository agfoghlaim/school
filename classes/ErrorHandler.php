<?php

class ErrorHandler{

	protected $errors = [];

	//pass in an error msg and specify key to group error
	public function addError($error, $key=null){

		if($key){
			$this->errors[$key][] = $error;//ie protected array above
		}else{
			//if key not provided
			$this->errors[] = $error;

		}

	}


	public function all($key=null){
		//if key is specificed, return relevent errors
		//else return all errors

	return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
	}

	public function hasErrors(){
		return count($this->all()) ? true : false;
	}

	public function first($key){
		return isset($this->all()[$key][0]) ? $this->all()[$key][0]: '';
	}

}
