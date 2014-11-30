<?php
namespace App;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\SecurityServiceProvider;

use App\Service\DataBaseProvider;
use App\Service\RepositoryProvider;
use App\Service\SecurityProvider;
use App\Service\UserProvider;

use App\Listener\CustomAuthenticationSuccessHandler;
use App\Listener\CustomAuthenticationFailureHandler;


use Echyzen\Controller\IndexController;

/**
* 
*/
class AppEchyzen extends Application
{

	function __construct()
	{
		parent::__construct();
		// Lien avec les controllers
		$this->appMount();
		// enregistrement de l'ensemble des services
		$this->appRegister();

	}

	private function appMount() {
		
		$this->mount('/', new IndexController());
	}

	private function appRegister() {
		// Chargement des services de Base de Données
		$this->dataBaseProvider();
		// Chargement du repository de Model
		// Permet de charger une class Model
		$this->register(new RepositoryProvider($this['pdo']));

		// Service pour macro Session de Silex
		$this->register(new SessionServiceProvider());
		// assoucier une route a un nom que l'on souhaite
		$this->register(new UrlGeneratorServiceProvider());
		// Service pour l'envoie de mail
		$this->register(new SwiftmailerServiceProvider());
		// Mise en place de twig
		$this->register(new TwigServiceProvider(), array(
			// Path ou sont l'ensemble des vues
		    'twig.path' => __DIR__.'/../Echyzen/view',
		));
		// Chargement du service de sécurité : firewall et connexion
		$this->securityProvider();
	}	

	private function dataBaseProvider() {
		// Chargement des confs de SQL
		$dbConf = simplexml_load_file(__DIR__."/Config/database.xml");
		//Mon service PDO
		$this->register(new DataBaseProvider($dbConf));
		
		// Service Doctrine\DBAL instance de doctrine minimale nécessaire pour le securityProvider
		$this->register(new \Silex\Provider\DoctrineServiceProvider(), array(
		    'db.options' => array(
		        'driver' => 'pdo_mysql',
		        'dbhost' => $dbConf->host,
		        'dbname' => $dbConf->dbname,
		        'user' => $dbConf->user,
		        'password' => $dbConf->password,
		    ),
		));
	}
	private function securityProvider() {
		$this->register(new \Silex\Provider\SecurityServiceProvider(), array(
			// Mise en place de firewall
			'security.firewalls' => array(
				//default nom du firewall
			    'default' => array(
			    	// Route protéger par le firewall ici ensemble de l'application
			        'pattern' => '^.*$',
			        // Indispensable car la zone de login se trouve dans la zone sécurisée
			        'anonymous' => true,
			        // Route pour ce logger et pour la connexion
			        'form' => array('login_path' => '/', 'check_path' => '/c'),
			        // route à appeler pour se déconnecter
			        'logout' => array('logout_path' => '/deconnexion'), 
			        'users' => $this->share(function() {
			            // La classe App\User\UserProvider est spécifique à l'application
			            // et c'est le provider du firewall décite plus bas
			            // c'est notre classe utilisateur
			            return new UserProvider($this['db']);
			        }),
			    ),
			),
			// Protection et autorisation de certaines routes
			'security.access_rules' => array(
			    array('^/admin', 'ROLE_ADMIN'), // accessible au admin
			    array('^/account',    'ROLE_USER'), // accessible au utilisateur
			    array('^/.+$', 'IS_AUTHENTICATED_ANONYMOUSLY'), // permettre l'acces au non authentifié

			    
			),
			// fournisseur d'utilisateur pour le firewall
			'security.providers' => array(
				// nom du fournisseur
			    'main' => array(
			        'entity' => array(
			        	// nom de la class/entité qui gère cela
			            'class'     => 'App\Service\UserProvider',
			            // propriété de l'entité sur lequel porte la connexion
			            // ici username donc le pseudo est pas l'email TODO éventuel
			            'property'  => 'username'
			        )
			    )
			)

		));
		// Mise en place de la hierarchie des roles
		$this['security.role_hierarchy'] = array(
	    	'ROLE_ADMIN' => array('ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
		);
		// Trigger/Listener en cas de succès à la connexion
	    $this['security.authentication.success_handler.default'] = $this->share(function () {
	        return new CustomAuthenticationSuccessHandler($this['security.http_utils'], array(), $this);
	    });
	    // Trigger/Listener en cas d'échec à la connexion
	    $this['security.authentication.failure_handler.default'] = $this->share(function () {
	        return new CustomAuthenticationFailureHandler($this, $this['security.http_utils'], array(), $this);
	    });
	}

}
	
