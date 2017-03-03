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
        // function test_save_getall_deleteall()
        // {
        //   $brand = new Store('Jimmy');
        //   $store2 = new Store('Bata');
        //   $store3 = new Store('Fabulous');
        //   $store->save();
        //   Store::deleteAll();
        //   $store2->save();
        //   $store3->save();
        //
        //   $result= Store::getAll();
        //
        //   $this->assertEquals([$store2, $store3] , $result);
        // }
        // function test_find()
        // {
        //   $store = new Store('Jimmy');
        //   $store2 = new Store('Bata');
        //
        //   $store->save();
        //   $store2->save();
        //
        //   $result= Store::findbyid($store->getId());
        //
        //   $this->assertEquals($store, $result);
        // }
        // function test_update()
        // {
        //   $store = new Store('Jimmy');
        //   $new_name = 'Joseph';
        //   $store->save();
        //
        //   $store->update($new_name);
        //
        //   $result= $store->getName();
        //
        //   $this->assertEquals('Joseph', $result);
        // }
        // function test_delete()
        // {
        //   $store = new Store('Jimmy');
        //   $store2 = new Store('Bata');
        //
        //   $store->save();
        //   $store2->save();
        //   $store->delete();
        //   $all_stores= Store::getAll();
        //
        //   $this->assertEquals([$store2], $all_stores);
        // }
        // function test_addbrand()
        //
        // {
        //     $name = "Work stuff";
        //     $id = 1;
        //     $store = new Store($name, $id);
        //     $store->save();
        //
        //     $name = "File reports";
        //     $id = 1;
        //     $brand = new Brand($name, $id);
        //     $brand->save();
        //     var_dump($brand->getName());
        //
        //     //Act
        //     $store->addbrand($brand);
        //
        //     //Assert
        //     $this->assertEquals([$brand],$store->getbrands());
        // }


        // function test_addbrand_getbrands()
        // {
        //   $store= new Store('Jimmy');
        //   $brand = new Brand('Jimmy Choo');
        //   $brand2 = new Brand('Louis Vuitton');
        //   $store->save();
        //   $brand->save();
        //   $brand2->save();
        //
        //   $store->addbrand($brand->getId());
        //   $store->addbrand($brand->getId());
        //
        //   $this->assertEquals([$brand, $brand2], $store->getbrands());
        // }

    }
?>
