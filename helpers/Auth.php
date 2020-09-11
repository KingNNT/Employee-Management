<?php
session_start();

class Auth
{
	public static function user()
	{
		if (Session::get('id')) {
			return Session::get('id')[0];
		}
		return false;
	}

	public static function customer()
	{
		if (Session::get('customer')) {
			return Session::get('customer')[0];
		}
		return false;
	}
}
