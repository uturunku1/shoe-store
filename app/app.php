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
            array('stores' => Store::getAll(), 'edit_store_id' => 0));
    });
    $app->post('/post/store', function() use ($app){
      $store= new Store ($_POST['name']);
      $store->save();
      // var_dump(Store::getAll());
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
    //brand routes:
    $app->get('/brand', function() use($app){
      return $app['twig']->render('brand.html.twig', array('brands'=>Brand::getAll(),'edit_brand_id'=>0));
    });
    $app->post('post/brand', function() use($app){
      $new_brand= new Brand($_POST['name']);
      $new_brand->save();
      return $app['twig']->render('brand.html.twig', array('brands' => Brand::getAll(), 'edit_brand_id'=>0 ));
    });
    return $app;
?>
