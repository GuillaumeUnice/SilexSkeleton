<?php
 namespace App\Service;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ServiceProviderInterface;
use PDO;
use App\Config\DatabaseConfig;
class DataBaseProvider extends DataBaseConfig implements ServiceProviderInterface
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