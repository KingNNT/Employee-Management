<?php
session_start();

class Auth
{
	public static function user()
	{
		if (Session::get('id')) {
			return Session::get('id');
		}
		return false;
	}

	public static function admin()
	{
		if (Session::get('id')) {
			return Session::get('id');
		}
		return false;
	}
	public static function isLogin()
	{
		if (Session::get('id')) {
			return Session::get('id');
		}
		return false;
	}
}
