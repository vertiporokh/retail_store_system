<?php
namespace Application\Classes;

final Class EmptyObject extends SimpleXMLElement
{
  public function __call($name, $args) {
    return false;
  }

  public static function __callStatic($name, $args) {
    return false;
  }

  public function __get($name) {
    return false;
  }

  public function __set($name, $value) {
    return false;
  }
}

?>