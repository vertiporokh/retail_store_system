<?php //defined('CONTROL') or defined('CORE') or die();

namespace Application\Classes;
use Application\Classes\DBinsideExt;
use Application\Classes\Config;

final class Db
{
  private $_db, $_mysqli;
  private $className = 'stdClass';
  public  $cache = [];


  public function __construct($config = false) {
    if ($config instanceof mysqli) {
      $this->_mysqli = $config;
    } elseif (!$this->_mysqli) {
      $this->_connect($config);
    }

    $this->_db = new DBinsideExt($this->_mysqli, $this->className);
  }

  public function __get($table) {
    return $this->select()->from($table);
  }

  private function _connect($config) {
    if (!$config) {
      //include (defined('CONTROL') ? CONTROL : CORE).'/config/db.php';
      // берем настройки из конфигурационного класса
      //потом надо переделать
          $config['db_host'] = Config::DB_HOST;
          $config['db_user'] = Config::DB_USER;
          $config['db_pass'] =Config::DB_PASS;
          $config['db_name'] =Config::DB_NAME;
          $config['timezone'] =Config::DB_TIMEZONE;
    }

    if (!$config || !is_array($config)) {
      $this->_error('Неверно указаны данные в конфигурационном файле');
    }

    foreach (['db_host', 'db_user', 'db_pass', 'db_name'] as $param) {
      if (isset($config[$param])) {
        continue;
      }
      $this->_error('В конфигурационном файле не указан параметр '.$param);
    }

    $this->_mysqli = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    if (!$this->_mysqli || $this->_mysqli->connect_errno) {
      $this->_error('Нет доступа к базе данных');
    }
    $this->_mysqli->query('SET NAMES '.Config::DB_CHARSET);

    if (isset($config['timezone'])) {
      date_default_timezone_set((string)$config['timezone']);
    }
  }

  private function _error($error) {

    //переделать надо
    die("<div style=\"font-family:Trebuchet MS;font-size:12px;margin:20% auto 0 auto;text-align:center;\">Ошибка! {$error}.</div>");
  }

  private function _action($action, $params = null) {
    $this->_db = new DBinsideExt($this->_mysqli, $this->className);
    return $this->_db->{$action}($params);
  }

  public function select($what = '*') {
    return $this->_action('select', $what);
  }

  public function update($what)  {
    return $this->_action('update', $what);
  }

  public function insert() {
    return $this->_action('insert');
  }

  public function delete($params = []) {
    return $this->_action('delete', $params);
  }

  public function begin() {
    $this->_db->begin();
  }

  public function commit() {
    $this->_db->commit();
  }

  public function rollback() {
    $this->_db->rollback();
  }

  public function setClassName($className){
      $this->className = $className;
  }
}