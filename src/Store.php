<?php

Class Store

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
      $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function getAll()
    {
      $returned_stores= $GLOBALS['DB']->query("SELECT * FROM stores;");
      $all_stores = array();
      foreach ($returned_stores as $store) {
        $name= $store['name'];
        $id = $store['id'];
        $new_store = new Store ($name, $id);
        array_push($all_stores, $new_store);
      }
      return $all_stores;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM stores;");
    }
    static function findbyid($input_id)
    {
      $found_store = null;
      $stores = Store::getAll();
      foreach ($stores as $store) {
        if ($store->getId()==$input_id) {
          $found_store= $store;
        }
      }
      return $found_store;
    }
    function update($new_name)
    {
      $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id= {$this->getId()};");
      $this->setName($new_name);
    }
    function delete()
    {
      $GLOBALS['DB']->exec("DELETE FROM stores WHERE id={$this->getId()};");
      $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id={$this->getid()};");
    }
    function addbrand($brand)
    {
      $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES({$this->getId()},{$brand->getId()});");
    }
    function getbrands()
    {
      $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores_brands.store_id= stores.id) JOIN brands ON(stores_brands.brand_id= brands.id) WHERE stores.id={$this->getId()};");
      $getbrands= array();
      foreach ($returned_brands as $brand) {
        $name = $brand['name'];
        $id = $brand['id'];
        $getbrand= new Brand($name, $id);
        array_push($getbrands, $getbrand);
      }
      return $getbrands;
    }

  }

 ?>
