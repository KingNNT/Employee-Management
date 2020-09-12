<?php

class Session
{
	public function __construct()
	{
		session_start();
	}

	public static function get($name)
	{
		return $_SESSION[$name] ?? false;
	}

	public static function set($name, $data)
	{
		$_SESSION[$name] = $data;
	}

	public static function forget($name)
	{
		unset($_SESSION[$name]);
	}

	public static function destroy()
	{
		session_destroy();
	}
}
