<?php
 
namespace Gonzalo123;
 
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
 
use Symfony\Component\HttpFoundation\JsonResponse;
 
class ApiController
{
    public function initAction(Request $request, Application $app)
    {
        return new JsonResponse(array(1, 1, $request->get('id')));
    }
}