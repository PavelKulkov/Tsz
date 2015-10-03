<?php
class HttpSession
{
	protected $started;
	private $session_name;

	public function __construct($session_name)
	{
		$this->session_name = $session_name;
		$this->start();
	}

	public function start()
	{
		if ($this->started) return false;
		@session_name($this->session_name);
		@session_start();
		$this->started = true;
		return true;
	}

	public function close()
	{
		@session_write_close();
	}

	public function getValue($name)
	{
		if (isset($_SESSION[$name]))
		{
			$value = $_SESSION[$name];
			return $value;
		}
		else
		{
			return null;
		}
	}

	public function setValue($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function hasValue($name)
	{
		return isset($_SESSION[$name]);
	}

	public function removeValue($name)
	{
		if (isset($_SESSION[$name]))
		{
			$_SESSION[$name]='';
			unset($_SESSION[$name]);
		}
	}


}
?>