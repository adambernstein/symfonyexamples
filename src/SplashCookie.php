<?php
/**
 * Simple script to read/print test cookies using Symfony framework
 * 
 * @author Adam Bernstein <abernstein@pih.org>
 * 
 */

namespace AdamB\symfonyexamples;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Gets and sets cookies.
 */
class SplashCookie {
  
  /**
   * Get current cookies.
   */
  static function getTestCookie(Request $request, $name) {
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
  static function setTestCookie(Request $request, $name, $current_host) {
    // Define cookie values (name, value, expires, path, domain, secure, httponly)
    $cookie = new Cookie($name, 'Somevalue', strtotime('now + 7 days'), "/", $current_host, false, true);
    $response = new Response();
    // Load into response
    $response->headers->setCookie($cookie);
    $response->send();
  }

  
}
