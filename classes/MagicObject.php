<?php
namespace Application\Classes;

final Class MagicObject
{
  private $_table, $_db;

  public function __construct($mysqli, $table, $properties) {
    if (!$mysqli) {
      throw new Exception('DB - has no MySQLi connect');
    }
    if (!$table || !is_string($table)) {
      throw new Exception('DB - first parameter - table - must be string');
    }
    if (!is_array($properties)) {
      throw new Exception('DB - second paramenter - properties - must be array');
    }

    $this->_table = $table;
    $this->_db    = new DB($mysqli);

    foreach ($properties as $key => $value) {
      $this->{$key} = $value;
    }
  }

  function __call($name, $args) {
    if ($name == '__toArray') {
      unset($this->_table, $this->_db);
      return (array)$this;
    }

    if (!count($args)) {
      return null;
    }

    if (!isset($this->{$name})) {
      if (preg_match("/\_id$/", $name)) {
        throw new Exception('DB - object has no property '.$name);
      }

      $name .= '_id';
      if (!isset($this->{$name})) {
        throw new Exception('DB - object has no property '.$name);
      }
    }

    $id = (isset($args[1]) && $args[1] ? $args[1] : 'id');
    return $this->_db->{$args[0]}->one([
      $id => $this->{$name}
    ]);
  }

  public function save($params, $old = false) {
    if (!$this->id) {
      throw new Exception('DB - object has no property ID - it cannot be save');
    }

    $result = $this->_db->update($this->_table)->set($params)->where('id', $this->id)->doit();

    if ($old) {
      return $result;
    }

    foreach ($params as $key => $value) {
      $this->{$key} = $value;
    }

    return $result;
  }

  public function delete() {
    if (!$this->id) {
      throw new Exception('DB - object has no property ID - it cannot be delete');
    }

    return $this->_db->delete()->from($this->_table)->where('id', $this->id)->doit();
  }

  public function date($field, $format) {
    if (!property_exists($this, $field) || !exists($this->field)) {
      throw new Exception("Field {$field} have no in the object");
    }

    $time = strtotime($this->{$field});
    if ($time === false) {
      throw new Exception('DB - wrong date format');
    }

    return date($format, $time);
  }
}



?>