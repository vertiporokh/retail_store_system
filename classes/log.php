<?php
namespace Application\Classes;

class Log
{
	private static $logfile = '';
	private $filedesc = '';

	public function __construct(){
		self::$logfile = __DIR__.'/../log/log.txt';
		$this->filedesc = fopen(static::$logfile, 'a+');
	}

	public function write(\Exception $e){
		fwrite($this->filedesc, date('d:m:Y H:i').' [Место]:'.$e->getFile().' [Сообщение об ошибке]'.$e->getMessage()."\r\n");
		fclose($this->filedesc);
		return;
	}

	public static function readlog(){
		if($logfile = file(static::$logfile))
			return $logfile;
		return array();
	}
}



?>