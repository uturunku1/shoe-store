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
    // use Symfony\Component\Debug\Debug;
    // Debug::enable();

    $app->register(
        new Silex\Provider\TwigServiceProvider(),
        array('twig.path' => __DIR__.'/../views')
    );
    // Store Routes
    $app->get("/", function() use ($app) {
        return $app['twig']->render(
            'index.html.twig',
            array('stores' => Store::getAll(), 'edit_store_id' => 0));
    });
    $app->post('/post/store', function() use ($app){
      $store= new Store (filter_var($_POST['name'], FILTER_SANITIZE_MAGIC_QUOTES));
      $store->save();
      return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0));
    });
    $app->get('/get/store/{id}/edit', function($id) use ($app){
      return $app['twig']->render('index.html.twig', array('stores'=>Store::getAll(),'edit_store_id'=>$id));
    });
    $app->patch('/patch/store', function() use ($app){
      $store= Store::findbyid($_POST['store_id']);
      $store->update($_POST['new_name']);
      return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0));
    });
    $app->delete('/delete/store/{id}', function($id) use ($app){
      $store= Store::findbyid($id);
      $store->delete();
      return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0));
    });
    $app->post('/deleteall/store', function() use ($app){
      Store::deleteAll();
      return $app['twig']->render('index.html.twig',array('stores' => Store::getAll(), 'edit_store_id' => 0));
    });
    //brand routes:
    $app->get('/brands/{id}', function($id) use($app){
      $store= Store::findbyid($id);
      return $app['twig']->render('brand.html.twig', array('stores'=>null,'store'=>$store,'brands'=>$store->getbrands()));
    });
    $app->post('post/brand/{id}', function($id) use($app){
      $new_brand= new Brand(filter_var($_POST['name'], FILTER_SANITIZE_MAGIC_QUOTES));
      $new_brand->save();
      $store= Store::findbyid($id);
      $new_brand->addstore($store);

      $store->addbrand($new_brand);
      $brands= $store->getbrands();
      return $app['twig']->render('brand.html.twig', array('stores'=>null,'store'=>$store,'brands'=>$brands));
    });
    $app->post('stores/{id}', function($id) use ($app){
      $store= Store::findbyid($id);
      $brand= Brand::findbyid($_POST['brand_id']);
      $stores= $brand->getstores();
      return $app['twig']->render('brand.html.twig', array('stores'=>$stores,'store'=>$store,'brands'=>$store->getbrands() ));
    });

    return $app;
?>
