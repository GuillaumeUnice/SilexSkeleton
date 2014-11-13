<?php
 namespace Echyzen;
 
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
			 'Echyzen\IndexController::indexAction'
		 );     

		 return $factory;
	 }
	 
	 public function indexAction() {
		return 'Hello world';

	 }

}