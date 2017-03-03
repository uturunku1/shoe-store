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
      $GLOBALS['DB']->exec("INSERT INTO stores(name) VALUES('{$this->getName()}');");
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
    // static function find($search_id)
    //    {
    //        $found_student = null;
    //        $students = Student::getAll();
    //        foreach($students as $student) {
    //            $student_id = $student->getId();
    //            if ($student_id == $search_id) {
    //              $found_student = $student;
    //            }
    //        }
    //        return $found_student;
    //    }
}

 ?>
