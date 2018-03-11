<?php
/**
 * Simple script to read/print test cookies using Symfony framework
 * 
 * @author Adam Bernstein <abernstein@pih.org>
 * 
 */
namespace AdamB\symfonyexamples;

require_once 'vendor/autoload.php';
include 'src/SplashCookie.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AdamB\symfonyexamples\SplashCookie;
use AdamB\symfonyexamples\Redirect;


//Would be \Drupal::$request() in Drupal
$request = Request::createFromGlobals();
$current_host = $request->server->get('SERVER_NAME');
$name = "CookieName";
$value = "CookieValue";


/**
 * Read and print to page
 */
$cookie_string = SplashCookie::getTestCookie($request, $name);
$response = new Response();
if ($cookie_string) {
    //echo "<p>Cookie: " . $cookie_string . "</p>";    
    $response->prepare($request);
    $response->send();
}
else {
    SplashCookie::setTestCookie($request, $name, $current_host);
    $redir_response = new RedirectResponse('https://adambernste.in', 302);
    //$redir_response->setTargetUrl();
    $redir_response->send();
}


$html = "<!DOCTYPE html>";
$html.= "<html>";
$html.= "<head></head>";
$html.= "<body>";
$html.= "    <h1>Cookie: " . $cookie_string . "</h1>";
$html.= "</body>";
$html.= "</html>";

echo $html;