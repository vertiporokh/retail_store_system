<?php
namespace Application\Classes;

class DefaultConfig{

	const DB_DRIVER = 'mysql';
	const DB_HOST = 'localhost';
	const DB_NAME = 'store_system';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_CHARSET = 'UTF8';
	const DB_TIMEZONE = 'Asia/Yekaterinburg';

	public static function DSN(){
		return static::DB_DRIVER.':host='.static::DB_HOST.';dbname='.static::DB_NAME.';charset='.static::DB_CHARSET;
	}
}




?>