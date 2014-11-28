<?php
//mise en place de l'autoloader de Composer
require_once __DIR__.'/../vendor/autoload.php';

$app = new App\AppEchyzen();

/*$app->register(
    new Herrera\Pdo\PdoServiceProvider(),
    array(
        'pdo.dsn' => 'pdo_mysql:dbname=echyzen;host=127.0.0.1',
        'pdo.username' => 'root', // optional
        'pdo.password' => '', // optional
        'pdo.options' => array( // optional
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        )
    )
);*/

///////////////////////////////$app->register(new Echyzen\DataBaseProvider());

//$pdo = $app['pdo'];
/*
try
		{
		  $t = new PDO('mysql:host=localhost;dbname=echyzen', 'root', '');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}*/
	
	
/***********************************************************************************************************
	$req = $app['pdo']->query('SELECT COUNT(*) as NbMess FROM news') or die(print_r($bdd->errorInfo()));
    $donnee = $req->fetch();
	
		$req = $app['pdo']->query('SELECT COUNT(*) as NbMess FROM news') or die(print_r($bdd->errorInfo()));
    $d = $req->fetch();
    die($d['NbMess'] . $donnee['NbMess'] );

*/
	/*$req = $app['pdo'];
	$r = $app['pdo'];
	die($r . '\n' . $req);*/
	
	
// Please set to false in a production environment
$app['debug'] = true;

///////////////////////////////////////////////////////////////////////////$app->mount('/', new Echyzen\IndexController());

$app->run();