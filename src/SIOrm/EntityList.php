<?php
namespace SIOrm;

class EntityList implements \Iterator{

  private $manager;
  private $pointer;
  private $internalArray;

  public function __construct($manager, $classname, $internalArray){
    $this->manager = $manager;
    $this->classname = $classname;
    $this->internalArray = $internalArray;
  }

  public function current (){
      $o = $this->manager->get($this->classname);
      foreach ($o->getColumns() as $c => $colinfo){
        $o->$c = $this->internalArray[$this->pointer][$c];
      }
      return $o;
  }
  public function key (){
    return $this->pointer;
  }
  public function next (){
    $this->pointer++;
  }
  public function rewind (){
    $this->pointer = 0;
  }
  public function valid (){
    return $this->pointer < count($this->internalArray);
  }
}