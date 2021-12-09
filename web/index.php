<?php

require_once '../vendor/autoload.php';
require_once '../civicrm.settings.php';

function invoke() {
  $session = CRM_Core_Session::singleton();
  $config = CRM_Core_Config::singleton();

  $urlVar = $config->userFrameworkURLVar;
  
  if (!empty($_GET[$urlVar])) {
    print CRM_Core_Invoke::invoke(explode('/', $_GET[$urlVar]));
  }
  elseif (!empty($_SERVER['REQUEST_URI'])) {
    $parts = explode('/', $_SERVER['REQUEST_URI']);
    $parts = array_values(array_filter($parts));
    print CRM_Core_Invoke::invoke($parts);
  }
  else {
    print CRM_Core_Invoke::invoke(explode('/', $_GET[$urlVar]));
  }
}

invoke();
