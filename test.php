<?php

include_once('vendor/autoload.php');

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// set current active tab in cookie 
$cookie = new Cookie('TEST2', 'SOMETHINGELSE', strtotime('now + 60 minutes'));
$response = new Response();
$request = Request::createFromGlobals();
//$response->headers->setCookie($cookie);
$response->send();


// get current active tab from cookies
function readCookie(Request $request) {
  //$request = $this->getRequest();
  $cookies = $request->cookies;
  if ($cookies->has('TEST2')) {
    return($cookies->get('TEST2'));
  }
  else {
    return "NO COOKIE SET, ASSHOLE";
  }
}

$cookie_print = readCookie($request);
echo "Cookie: " . $cookie_print;
/*
$cookies = $response->headers->getCookies();
echo "<h1>test</h1>
        <p>" . $cookies->get('TEST') . "</p>";
//var_dump($cookies);
*/