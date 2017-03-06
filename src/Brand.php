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
    function setName($name)
    {
      $this->name = (string) $name;
    }
    function setId($id)
    {
      $this->id = (int) $id;
    }
    function getName()
    {
      return $this->name;
    }
    function getId()
    {
      return $this->id;
    }
    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
      $this->setId($GLOBALS['DB']->lastInsertId());
    }
    static function getAll()
    {
      $returned_brands= $GLOBALS['DB']->query("SELECT * FROM brands;");
      $brands = array();
      foreach($returned_brands as $brand) {
        $name= $brand['name'];
        $id = $brand['id'];
        $new_brand = new Brand($name, $id);
        array_push($brands, $new_brand);
      }
      return $brands;
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
    function addstore($store)
    {
      $GLOBALS['DB']->exec("INSERT INTO stores_brands(store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
    }
    function getstores()
    {
      $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands JOIN stores_brands ON (stores_brands.brand_id= brands.id) JOIN stores ON(stores_brands.store_id=stores.id) WHERE brands.id= {$this->getId()}; ");
      $getstores= array();
      foreach ($returned_stores as $store) {
        $name = $store['name'];
        $id = $store['id'];
        $getstore= new Store($name, $id);
        array_push($getstores, $getstore);
      }
      return $getstores;
    }
}

 ?>
