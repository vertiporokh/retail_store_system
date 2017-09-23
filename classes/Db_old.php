<?php
namespace Application\Classes;

//use Application\Classes\Config;

class Db{
	protected $className = 'stdClass';
	protected $result = array();

	public function __construct(){
		$this->dbh = new \PDO(Config::DSN(), Config::DB_USER, Config::DB_PASS);
		$this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public function setClassName($className){
		$this->className = $className;
	}

	public function query($sql, $params=[]){
			$sth = $this->dbh->prepare($sql);
			$sth->execute($params);
			$res = $sth->fetchAll(\PDO::FETCH_CLASS, $this->className);
			return $res;	
	}

	public function execute($sql, $params=[]){
		$sth = $this->dbh->prepare($sql);
		return $sth->execute($params);
	}

	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}

}

?>