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
      
  }
  public function key (){
      

  }
  public function next (){

  }
  public function rewind (){

  }
  public function valid (){
    
  }
}