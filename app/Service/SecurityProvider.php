<?php
 namespace App\Service;
 
use Silex\Provider\SecurityServiceProvider;

class SecurityProvider extends SecurityServiceProvider
{

	

    public function register(Application $app)
    {
    	parent::register($app);
    	
    	$app['security.firewalls'] =  array(
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
		    );

		    $app['security.access_rules'] = array(
		        // ROLE_USER est défini arbitrairement, vous pouvez le remplacer par le nom que vous voulez
		        array('^/.+$', 'ROLE_USER'),
		        array('^/foo$', ''), // Cette url est accessible en mode non connecté
		    );
		    $app['security.providers'] = array(
			        'main' => array(
			            'entity' => array(
			                'class'     => 'App\Service\UserProvider',
			                'property'  => 'username'
			            )
			        )
			    );
			
    	return $listener;

	}
		
	public function boot(Application $app) {
	
	}
}