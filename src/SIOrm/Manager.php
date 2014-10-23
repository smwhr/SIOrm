<?php
namespace SIOrm;


class Manager{

  public function __construct($db){
    $this->db = $db;
  }

  public function get($classname){
    $o = new $classname($this);
    return $o;
  }

}