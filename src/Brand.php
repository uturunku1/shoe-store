<?php

Class Brand

{
    private $name;
    private $id;

    function __construct($name='', $id=null)
    {
      $this->setName($name);
      $this->setId($id);
    }

    function getName(){
      return $this->name;
    }

    function setName($name){
      $this->name = (string)$name;
    }

    function getId(){
      return $this->id;
    }

    function setId($id){
      $this->id = (int)$id;
    }

    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO brands(name) VALUES('{$this->getName()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function getAll()
    {
      $returned_brands= $GLOBALS['DB']->query("SELECT * FROM brands;");
      $all_brands = array();
      foreach ($returned_brands as $brand) {
        $name= $brand['name'];
        $id = $brand['id'];
        $new_brand = new Brand ($name, $id);
        array_push($all_brands, $new_brand);
      }
      return $all_brands;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM brands;");
    }

}

 ?>
