<?php
 namespace Echyzen;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ServiceProviderInterface;
use PDO;

class DataBaseProvider implements ServiceProviderInterface
{

	

    public function register(Application $app)
    {

        $app['pdo'] = $app->share(function() use ($app) {
			try
			{
				return new PDO('mysql:host=localhost;dbname=echyzen', 'root', '');
			}
			catch (PDOException $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
            
        });
    }
	
	public function boot(Application $app) {
		
	}
}