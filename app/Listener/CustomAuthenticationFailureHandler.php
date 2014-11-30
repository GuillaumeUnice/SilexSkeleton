<?php
namespace App\Listener;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Silex\Application;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CustomAuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
{
  protected $app = null;

  public function __construct(HttpKernelInterface $httpKernel, HttpUtils $httpUtils, array $options, Application $app)
  {
    parent::__construct($httpKernel, $httpUtils, $options);
    $this->app = $app;
  }

  public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
  {
               $referer = $request->headers->get('referer');       
                $request->getSession()->getFlashBag()->add('error', 'erreur de connexion');

                return new RedirectResponse($referer);
  }
}