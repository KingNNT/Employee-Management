<?php

namespace EmployeeManagement\helpers;

session_start();

class Auth
{

	public static function user()
	{
		if (Session::get('user')) {
			return Session::get('user')[0];
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
