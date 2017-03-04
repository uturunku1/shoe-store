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
    static function findbyid($search_id)
    {
      $found_brand= null;
      $brands= Brand::getAll();
      foreach ($brands as $brand) {
        if ($brand->getId()==$search_id) {
          $found_brand= $brand;
        }
      }
      return $found_brand;
    }
    function update($new_name)
    {
      $GLOBALS['DB']->exec("UPDATE brands SET name= '{$new_name}' WHERE id= {$this->getid()};");
      $this->setName($new_name);
    }
    function delete()
    {
      $GLOBALS['DB']->exec("DELETE FROM brands WHERE id={$this->getId()};");
      $GLOBALS['DB']->exec("DELETE FROM stores_brands where brand_id={$this->getId()};");
    }


    // function delete()
    // {
    //   $GLOBALS['DB']->exec("DELETE FROM stores WHERE id={$this->getId()};");
    //   $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id={$this->getid()};");
    // }
    // function addbrand($brand)
    // {
    //   $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES({$this->getId()},{$brand->getId()});");
    // }
    //
    // function getbrands()
    // {
    //   $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores_brands.store_id= stores.id) JOIN brands ON(stores_brands.brand_id= brands.id) WHERE stores.id={$this->getId()};");
    //   $getbrands= array();
    //   foreach ($returned_brands as $brand) {
    //     $name = $brand['name'];
    //     $id = $brand['id'];
    //     $getbrand= new Brand($name, $id);
    //     array_push($getbrands, $getbrand);
    //   }
    //   return $getbrands;
    // }

}

 ?>
