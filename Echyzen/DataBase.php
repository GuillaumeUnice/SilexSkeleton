<?php
 namespace Echyzen;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;
  
/**
*
*
* @package Echyzen
*/
class DataBase
{
	
	private $_db;
	
	public function __construct() {
	$this->_db = 1;
	phpinfo();
		/*try
		{
		  $this->_db = new PDO('mysql:host=localhost;dbname=echyzen', 'root', '');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}*/
	}
	
	public function getDB() {
		return $this->_db;
	}

}