<?php
 namespace App\Service;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ServiceProviderInterface;
use PDO;
use App\Config\DatabaseConfig;
class DataBaseProvider implements ServiceProviderInterface
{

	private $dbConf;

	function __construct($dbConf)
	{
		if(empty($dbConf)) {
			$this->dbConf->host = 'localhost';
			$this->dbConf->dbname = null;
			$this->dbConf->host = 'root';
			$this->dbConf->host = null;
		} else {
			$this->dbConf = $dbConf;
		}

	}

    public function register(Application $app)
    {
        		
        $app['pdo'] = $app->share(function() use ($app) {
			try
			{
				return new PDO('mysql:host=' . $this->dbConf->host . ';dbname=' . $this->dbConf->dbname,
				 $this->dbConf->user, $this->dbConf->password);
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