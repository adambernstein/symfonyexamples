<?php
/**
 * Simple script to read/print test cookies using Symfony framework
 * 
 * @author Adam Bernstein <abernstein@pih.org>
 * 
 */
require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//Would be \Drupal::$request() in Drupal
$request = Request::createFromGlobals();
$current_host = $request->server->get('SERVER_NAME');
$name = "CookieName";
$value = "CookieValue";

/**
 * Get current cookies.
 */
function getTestCookie(Request $request, $name) {
  $cookies = $request->cookies;
  if ($cookies->has($name)) {
    return($cookies->get($name));
  }
  //Returns false if not found or expired.
  else {
    return false;
  }
}

/**
 * Sets cookies.  
 */
function setTestCookie($name, $value, $exp, $current_host) {
  // Define cookie values (name, value, expires, path, domain, secure, httponly)
  $cookie = new Cookie($name, $value, strtotime($exp), "/", $current_host, false, true);
  $response = new Response();
  // Load into response
  $response->headers->setCookie($cookie);
  $response->send();
}

/**
 * Read and print to page
 */
$cookie_string = getTestCookie($request, $name);
if ($cookie_string) {
  echo "<p>Cookie: " . $cookie_string . "</p>";
}
else {
  echo "<p>No Cookie Set.</p>";
  setTestCookie($name, $value, 'now + 2 minutes', $current_host);
}
