<?php
 namespace Echyzen;
 

/**
*
* @package Echyzen
*/
class BaseModel
{
  
	protected $db;
    
    public function __construct($app)
    {
        $this->db = $app;

    }

}