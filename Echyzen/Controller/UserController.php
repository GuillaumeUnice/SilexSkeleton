<?php
namespace Echyzen\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;

  
/**
* The routes used for index
*
* @package Echyzen
*/
class IndexController implements ControllerProviderInterface
{
  
	 /**
	  * Connect function is used by Silex to mount the controller to the application.
	  *
	  * Please list all routes inside here.
	  *
	   * @param Application $app Silex Application Object.
	  *
	   * @return Response Silex Response Object.
	   */
	 public function connect(Application $app)
	 {
		 /**
		  * @var \Silex\ControllerCollection $factory
		   */
		  $factory = $app['controllers_factory'];


		 $factory->get(
			'/',
			 'Echyzen\Controller\IndexController::indexAction'
		 );     

		$factory->get(
			'/test',
			 'Echyzen\Controller\IndexController::testAction'
		 );     


		$factory->get(
			'/admin',
			 'Echyzen\Controller\IndexController::adminAction'
		 );     
		$factory->get(
			'/c',
			 'Echyzen\Controller\IndexController::connexionAction'
		 );     
		 
		 return $factory;

	 }
	 public function connexionAction(Application $app) {
		
	 	  return $app['twig']->render('index.twig', array(
	        'error' => $app['security.last_error']($r),
	        'last_username' => $app['session']->get('_security.last_username'),
	        'r' => 'lol'
	    ));
	 	
	 }
	 public function adminAction(Application $app) {
		return 'Page admin';
	 	
	 }
	 
	 public function testAction(Application $app) {
		return 'Page test';
	 	
	 }


	 public function indexAction(Application $app, Request $r) {
		/*
	 	$app['session']->set('user', array('username' => 'johann',
	 		'password' => 'password',
	 		'roles' => 'ROLE_USER'
	 		));
	 	return $app['twig']->render('layout.html.twig');*/

	 	  return $app['twig']->render('index.twig', array(
	        'error' => $app['security.last_error']($r),
	        'last_username' => $app['session']->get('_security.last_username'),
	        'r' => 'lil'
	    ));
	 }

}