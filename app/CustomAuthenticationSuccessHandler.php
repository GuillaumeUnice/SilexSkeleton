<?php
namespace App;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Silex\Application;

class CustomAuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
  protected $app = null;

  public function __construct(HttpUtils $httpUtils, array $options, Application $app)
  {
    parent::__construct($httpUtils, $options);
    $this->app = $app;
  }

  public function onAuthenticationSuccess(Request $request, TokenInterface $token)
  {
    		$usr = $token->getUser();
        //die(var_dump( $usr));
        $session = $request->getSession();

    		$session->set('user', $usr);

    return $this->httpUtils->createRedirectResponse($request, $this->determineTargetUrl($request));
  }
}