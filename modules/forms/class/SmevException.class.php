<?php
class SmevException extends Exception
{
	
	private $warning = false;
	/**
	 * @desc Конструктор
	 */
	public function __construct($message)
	{
		parent::__construct($message);
	}
	
	
	public function showAsWarning($warning){
	  $this->warning = $warning;	
	}
	
	public function isWarning(){
	  return $this->warning;	
	}
}
?>