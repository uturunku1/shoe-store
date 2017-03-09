<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $app = new Silex\Application();
    $app['debug'] = true;
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app->register(
        new Silex\Provider\TwigServiceProvider(),
        array('twig.path' => __DIR__.'/../views')
    );
    // Store Routes
    $app->get("/", function() use ($app) {
        return $app['twig']->render(
            'index.html.twig',
            array('stores' => Store::getAll(), 'edit_store_id' => 0, 'brands'=>Brand::getAll()));
    });
    $app->post('/post/store', function() use ($app){
      $store= new Store (filter_var($_POST['name'], FILTER_SANITIZE_MAGIC_QUOTES));
      $store->save();
      return $app->redirect('/');
      // return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0, 'brands'=>Brand::getAll()));
    });
    $app->get('/get/{id}', function($id) use ($app){
      return $app['twig']->render('index.html.twig', array('stores'=>Store::getAll(),'edit_store_id'=>$id, 'brands'=>Brand::getAll()));
    });
    $app->patch('/patch/store', function() use ($app){
      $store= Store::findbyid($_POST['store_id']);
      $store->update($_POST['new_name']);
      return $app->redirect('/');
      // return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0, 'brands'=>Brand::getAll()));
    });
    $app->delete('/delete/store/{id}', function($id) use ($app){
      $store= Store::findbyid($id);
      $store->delete();
      return $app->redirect('/');
      // return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0, 'brands'=>Brand::getAll()));
    });
    $app->post('/deleteall/store', function() use ($app){
      Store::deleteAll();
      return $app->redirect('/');
      // return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0, 'brands'=>Brand::getAll()));
    });
    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::findbyid($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands'=> $store->getbrands(), 'all_brands' => Brand::getAll()));
     });


    //brand routes:
    $app->post('/post/brand', function() use ($app){
      $brand= new Brand (filter_var($_POST['name'], FILTER_SANITIZE_MAGIC_QUOTES));
      $brand->save();
      return $app->redirect('/');
      // return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0, 'brands'=>Brand::getAll()));
    });
    $app->post("/add_brands", function() use ($app) {
      $store = Store::findbyid($_POST['store_id']);
      $brand= Brand::findbyid($_POST['brand_id']);
      $store->addbrand($brand);
      return $app['twig']->render('store.html.twig', array('store' => $store, 'brands'=> $store->getbrands(), 'all_brands' => Brand::getAll()));
    });
    $app->delete('/delete/brand/{id}', function($id) use ($app){
      $brand= Brand::findbyid($id);
      $store = Store::findbyid($_POST['store_id']);
      $brand->delete();
      return $app['twig']->render('store.html.twig', array('store' => $store, 'brands'=> $store->getbrands(), 'all_brands' => Brand::getAll()));
    });
    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::findbyid($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores'=> $brand->getstores(), 'all_stores' => Store::getAll()));
     });
     $app->post('/add_stores', function() use ($app){
       $store = Store::findbyid($_POST['store_id']);
       $brand = Brand::findbyid($_POST['brand_id']);
       $brand->addstore($store);
       return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores'=> $brand->getstores(), 'all_stores' => Store::getAll()));
     });
     $app->delete('/delete/storeinbrand/{id}', function($id) use ($app){
       $store= Store::findbyid($id);
       $store->delete();
       $brand= Brand::findbyid($_POST['brand_id']);
       return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores'=> $brand->getstores(), 'all_stores' => Store::getAll()));
     });
    return $app;
?>
