<?php

namespace Application\Models;

use Application\Classes\Db;
use Application\Classes\E404Exception;
use Application\Classes\validationException;

abstract class AbstractModel
{
	static protected $table;

	protected $data = [];

	public function __construct(){
		/*foreach(static::$required_data as $property => $value){
			$this->data[$property] = '';
		}*/
	}

	public function __set($k, $v){
		$this->data[$k] = $v;
	}

	public function __get($k){
		return isset($this->data[$k]) ? $this->data[$k] : '';
	}

	public function __isset($k){
		return isset($this->data[$k]);
	}

	public static function getTable(){
		return static::$table;
	}

	public static function findAll(){
		$class=get_called_class();
		$sql = 'SELECT * FROM '.static::$table;
		$db = new DB();
		$db->setClassName($class);
		return $db->query($sql);
	}

	public static function findOneByPK($id){
		$sql = 'SELECT * FROM '.static::$table.' WHERE id=:id';
		$db = new DB();
		$class=get_called_class();
		$db->setClassName($class);
		$res = $db->query($sql, [':id'=>$id]);
		if(!empty($res)){
			return $res[0];
		}
		//исключения не должны здесь выбрасываться
		$e = new E404Exception('Ничего не найдено');
		throw $e;
		return;
	}

	public static function  findOneByColumn($column, $value){
		$sql = 'SELECT * FROM '.static::$table.' WHERE '.$column.'=:'.$column;
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$res =  $db->query($sql, [':'.$column => $value]);
		
		if(!empty($res)){
			return $res[0];
		}
		return;
		
	}

	public static function  findByColumns($paramspairs = array()){
		$sql = 'SELECT * FROM '.static::$table;
		$params = array();
		if($paramspairs){
			$sql.=' WHERE ';
			foreach($paramspairs as $column => $value){
				$sql .= $column.'=:'.$column;
				$params[':'.$column] = $value;
			}		
		}
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$res =  $db->query($sql, $params);
		return $res;
	}

	protected function insert(){
		$cols = array_keys($this->data);
		$data=[];
		foreach($cols as $col){
			$data[':'.$col]= $this->data[$col];
		}
		$sql = 'INSERT INTO '.static::$table.
		'('.implode($cols, ',').') VALUES ('.implode(array_keys($data), ',').')';
		$db = new DB();
		if(false !== $db->execute($sql, $data)){
			return $this->id = $db->lastInsertId();
		}
		return;
	}

	protected function update(){
		$cols = array_keys($this->data);
		$data=[];
		$sql = 'UPDATE '.static::$table.' SET ';
		foreach($cols as $col){
			$data[':'.$col]= $this->data[$col];
			$sql .= $col.'=:'.$col.',';
		}
		$sql = substr($sql, 0, -1). ' WHERE id='.$this->id;
		var_dump($sql);
		$db = new DB();
		return $db->execute($sql, $data);

	}

	public function save(){
		if(isset($this->id) && $this->id > 0){
			return $this->update();
		}
		return $this->insert();
	}

	public function delete(){
		$sql = "DELETE FROM ".static::$table." WHERE id=".$this->id;
		$db = new DB();
		return $db->execute($sql);	
	}

	public static function validate($data){
		foreach(static::$required_data as $required_data_key => $required_data_value){
			if($required_data_value && empty($data[$required_data_key])){
				throw new validationException('Не заполнены обязательные поля модели'); //а имеет ли смысл?
				return;
			}
			return true;
		}
	}




}

?>