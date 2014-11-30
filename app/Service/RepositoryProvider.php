<?php
 namespace App\Service;
 
use Silex\Application;
use Silex\ServiceProviderInterface;
use Echyzen\Model;

class RepositoryProvider implements ServiceProviderInterface
{

	private $db;

	function __construct($db)
	{
		$this->db = $db;

	}

    public function register(Application $app)
    {
        $app['repository'] = $app->share(function() use ($app) {
        	return $this;
        });
    }
	
	public function getModel($name) {
		$model = simplexml_load_file(__DIR__."/../Config/model.xml");
		//die($model->$name);
		if(!isset($model->$name)) {
			throw new \Exception("Erreur ce modele n'existe pas!", 1);
			
		} else {
			$obj = '\\Echyzen\\Model\\' . $name;
			return new $obj($this->db);
		}
	}
	public function boot(Application $app) {
		
	}
}