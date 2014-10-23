<?php
namespace SIOrm;

abstract class Entity{

  private $_coldata = null;
  const TABLE_NAME = '';

  public function __construct(Manager $manager)
    {
        $this->manager = $manager;
        $this->db = $manager->db;
  }


  public function getColumns(){
    if($this->_coldata == null){
      $sm = $this->db->getSchemaManager();
      $this->_coldata = $sm->listTableColumns(static::TABLE_NAME);
      
    }      
    return $this->_coldata;
  }

  public function save(){
    $cols = $this->getColumns();
    $to_save = array();

    foreach($cols as $colname => $colinfo){
      if(!empty($this->{$colname})){
        $to_save[$colname] = $this->$colname;
      }
    }

    $this->db->insert(static::TABLE_NAME, $to_save);
    $this->id = $this->db->lastInsertId();
  }

  public function __get($p){
    $cols= $this->getColumns();

    if(!isset($cols[$p]) && !isset($cols[$p."_json"])){
      throw new \Exception("La propriété ".$p." n'existe pas !");
    }

    if(isset($cols[$p."_json"])){
      $v = json_decode( $this->{$p."_json"} , true);
      var_dump($v);
      return $v;
    }

    return $this->$p;
  }

  public function __set($p, $val){
    $this->$p = $val;
  }


}