<?php

class Validator{

	protected $errorHandler;
	protected $items; //for access to email value for 'match' rule
	protected $rules = ['required', 'minlength', 'maxlength', 'email','alnum', 'match', 'numOnly']; //*1
	protected $messages = [
		'required' => 'The :field field is required',
		'minlength' => 'The :field field shoud be more than :satisifer',
		'maxlength' => 'The :field field shoud be less than :satisifer',
		'email' =>'not valid email',
		'alnum'=>'numbers and letters only in :field', 
		'match'=>'emails should match',
		'numOnly'=>'The :field field should contain numbers only.'
	]; 
	public function __construct(ErrorHandler $errorHandler){

		$this->errorHandler = $errorHandler;
	}

	
	public function check($items,$rules){
		$this->items = $items;
		foreach($items as $item =>$value){
			//echo $item . ' '.$value;
			//check if in rules array
			if(in_array($item, array_keys($rules))){

				$this->validate([
					'field' => $item,//*here
					'value'=> $value,
					'rules'=> $rules[$item]
					]);

			}
		}
		return $this;
	}

	public function fails(){
		return $this->errorHandler->hasErrors();
	}

	public function errors(){
		return $this->errorHandler;
	}

	protected function validate($item){
		$field = $item['field'];//*here

		foreach ($item['rules'] as $rule => $satisifer) {
			//if this rule exists
			if(in_array($rule, $this->rules)){//*1
				//echo $rule. '<br>';
				//each method rule returns true or false
				//$this validatior class

				//there is an error if function required, minlenthh etc below return false
				//if there is an error, we store error
				if(!call_user_func_array([$this, $rule], [$field, $item['value'],$satisifer])){
					$this->errorHandler->addError(
						//see list of errors above public $messages
						//str_replace(needle, changeNeedleTo, haystack)
						str_replace([':field', ':satisifer'],[$field, $satisifer], $this->messages[$rule]),
						$field);
				}

			}
		}
	}
	//each rule takes field name, value and satisifer
	//each method rule returns true or false
	protected function required($field, $value, $satisifer){
		return !empty(trim($value));
	}

	protected function minlength($field, $value, $satisifer){
		return mb_strlen($value) >= $satisifer;
	}

	protected function maxlength($field, $value, $satisifer){
		return mb_strlen($value) <= $satisifer;
	}

	protected function email($field, $value, $satisifer){
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	protected function alnum($field, $value, $satisifer){
		return ctype_alnum($value);
	}

	protected function match($field, $value, $satisifer){
		// echo $satisifer, ' ', $value;
		// die();
		return $value === $this->items[$satisifer];

	}
	protected function numOnly($field, $value, $satisifer){
		return is_numeric($value);
	}
}