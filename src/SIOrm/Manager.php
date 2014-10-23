<?php
namespace SIOrm;


class Manager{

  public function __construct($db){
    $this->db = $db;
  }

  public function get($classname, $id = null){
    $o = new $classname($this);
    return $o;
  }

  public function getOne($classname, $id=null){
    $q = "SELECT * FROM ".$classname::TABLE_NAME." WHERE id = ".$id;
    $raw = $this->db->fetchAssoc($q);

    $o = new $classname($this);

    foreach ($o->getColumns() as $c => $colinfo){
      $o->$c = $raw[$c];
    }
    return $o;
  }

  public function getAll($classname){
    $rawdata = $this->db->fetchAssoc("SELECT * FROM ".$classname::TABLE_NAME);
    $l = new EntityList($this, $classname, $rawdata);
    return $l;
  }

}