<?php

/**
 * @desc Генерирует исключения, возникшие в результате неправильной работы БД
 */
class DbException extends Exception
{
	/**
	 * @desc Конструктор
	 */
	public function __construct($message)
	{
		parent::__construct($message);
	}
}

?>