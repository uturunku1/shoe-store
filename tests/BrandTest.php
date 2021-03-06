<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";
    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Store::deleteAll();
          Brand::deleteAll();
          // Store::deletefromJoinTable();
        }
        function test_setters_getters_constructor()
        {
          $brand= new Brand ('Jimmy Choo', 1);
          $result= $brand->getName() . $brand->getid();
          $this->assertEquals('Jimmy Choo1', $result);

        }
        function test_save_getall_deleteall()
        {
          $brand = new Brand('Jimmy');
          $brand2 = new Brand('Bata');
          $brand3 = new Brand('Fabulous');
          $brand->save();
          Brand::deleteAll();
          $brand2->save();
          $brand3->save();

          $result= Brand::getAll();

          $this->assertEquals([$brand2, $brand3] , $result);
        }
        function test_find()
        {
          $brand = new Brand('Jimmy');
          $brand2 = new Brand('Bata');

          $brand->save();
          $brand2->save();

          $result= Brand::findbyid($brand->getId());

          $this->assertEquals($brand, $result);
        }
        function test_update()
        {
          $brand = new Brand('Jimmy');
          $new_name = 'Manolo';
          $brand->save();

          $brand->update($new_name);

          $result= $brand->getName();

          $this->assertEquals('Manolo', $result);
        }
        function test_delete()
        {
          $brand = new Brand('Jimmy');
          $brand2 = new Brand('Bata');

          $brand->save();
          $brand2->save();
          $brand->delete();
          $all_brands= Brand::getAll();

          $this->assertEquals([$brand2], $all_brands);
        }
        function test_addstore_getstores()
        {
          $brand= new Brand('Jimmy choo');
          $store = new Store('Jimmy');
          $store2 = new Store('Louis');
          $brand->save();
          $store->save();
          $store2->save();

          $brand->addstore($store);
          $brand->addstore($store2);

          $this->assertEquals([$store, $store2], $brand->getstores());
        }

    }
?>
