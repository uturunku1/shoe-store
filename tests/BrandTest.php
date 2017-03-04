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
