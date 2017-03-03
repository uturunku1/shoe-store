<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    // require_once "src/Brand.php";
    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StoreTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //   Store::deleteAll();
        //   Brand::deleteAll();
        //   Store::deletefromJoinTable();
        // }
        function test_Book_setters_getters_constructor()
        {
          $store= new Store ('Jimmy', 1);
          $result= $store->getName() . $store->getid();
          $this->assertEquals('Jimmy1', $result);

        }

  
    }
?>
