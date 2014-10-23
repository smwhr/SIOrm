<?php
namespace Model;
use SIOrm\Entity;

class Poney extends Entity{
  const TABLE_NAME = "poney";

  public function getPrettyName(){
    return "ø¤º°`°º¤ø,¸,ø¤  ".ucfirst($this->name)."  º¤ø,¸¸,ø¤º°`°º¤ø";
  }

}