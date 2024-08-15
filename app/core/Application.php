<?php

namespace app\core;

class Application
{
  protected $controller = 'home';
  protected $method = 'index';
  protected $page404 = FALSE;
  protected $params = [];

  public function __construct()
  {
    $URL_ARRAY = $this->parseUrl();

    $this->getControllerFromUrl($URL_ARRAY);
    $this->getMethodFromUrl($URL_ARRAY);
    $this->getParamsFromUrl($URL_ARRAY);
    
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  private function parseUrl()
  {
    $REQUEST_URI = explode('/', substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1));
    return $REQUEST_URI;
  }

  private function getControllerFromUrl($url)
  {
    $idx = 1;
    if (!empty($url[$idx]) && isset($url[$idx])) {
      if (file_exists('app/controllers/' . ucfirst($url[$idx])  . '.php')) {
        $this->controller = ucfirst($url[$idx]);
      } else {
        $this->page404 = TRUE;
      }
    }
    
    require 'app/controllers/' . $this->controller . '.php';

    $class_name = ucwords(str_replace('_', ' ', $this->controller));
    $class_name = str_replace(' ', '', $class_name);

    $this->controller = new $class_name;
  }

  private function getMethodFromUrl($url)
  {
    $idx = 2;
    if (!empty($url[$idx]) && isset($url[$idx])) {
      if (method_exists($this->controller, $url[$idx]) && !$this->page404) {
        $this->method = $url[$idx];
      } else {
        $this->method = 'pageNotFound';
      }
    }
  }

  private function getParamsFromUrl($url)
  {
    if (count($url) > 3) {
      $this->params = array_slice($url, 3);
    }
  }
}
