<?php
namespace App;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use App\Service\DataBaseProvider;
use App\Service\SecurityProvider;
use App\Service\UserProvider;
use Echyzen\Controller\IndexController;
use \Silex\Provider\DoctrineServiceProvider;
use \Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
/**
* 
*/
class AppEchyzen extends Application
{

	function __construct()
	{
		parent::__construct();
		$this->appMount();
		$this->appRegister();

	}

	private function appMount() {
		
		$this->mount('/', new IndexController());
	}

	private function appRegister() {

		$dbConf = simplexml_load_file(__DIR__."/Config/database.xml");
		$this->register(new DataBaseProvider($dbConf));
		$this->register(new \Silex\Provider\DoctrineServiceProvider(), array(
		    'db.options' => array(
		        'driver' => 'pdo_mysql',
		        'dbhost' => $dbConf->host,
		        'dbname' => $dbConf->dbname,
		        'user' => $dbConf->user,
		        'password' => $dbConf->password,
		    ),
		));

		$this->register(new SessionServiceProvider());
		$this->register(new UrlGeneratorServiceProvider());
		$this->register(new SwiftmailerServiceProvider());
		$this->register(new TwigServiceProvider(), array(
		    'twig.path' => __DIR__.'/../Echyzen/view',
		));


		$this->register(new \Silex\Provider\SecurityServiceProvider(), array(
		 'security.firewalls' => array(
		        'foo' => array('pattern' => '^/foo'), // Exemple d'une url accessible en mode non connecté
		        'default' => array(
		            'pattern' => '^.*$',
		            'anonymous' => true, // Indispensable car la zone de login se trouve dans la zone sécurisée (tout le front-office)
		            'form' => array('login_path' => '/', 'check_path' => '/connexion'),
		            'logout' => array('logout_path' => '/deconnexion'), // url à appeler pour se déconnecter
		            'users' => $this->share(function() {
		                // La classe App\User\UserProvider est spécifique à notre application et est décrite plus bas
		                return new \App\Service\UserProvider($this['db']);
		            }),
		        ),
		    ),
		    'security.access_rules' => array(
		        // ROLE_USER est défini arbitrairement, vous pouvez le remplacer par le nom que vous voulez
		        array('^/.+$', 'ROLE_USER'),
		        array('^/foo$', ''), // Cette url est accessible en mode non connecté
		    ),
		    'security.providers' => array(
		        'main' => array(
		            'entity' => array(
		                'class'     => 'App\Service\UserProvider',
		                'property'  => 'username'
		            )
		        )
		    )
				));
	}	


}
	
