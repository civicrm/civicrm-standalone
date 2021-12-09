<?php

require_once '../vendor/autoload.php';
require_once '../civicrm.settings.php';

function invoke() {
  if (!empty($_SERVER['REQUEST_URI'])) {
    // Add CSS, JS, etc. that is required for this page.
    \CRM_Core_Resources::singleton()->addCoreResources();

    $parts = explode('?', $_SERVER['REQUEST_URI']);
    $args = explode('/', $parts[0]);
    // Remove empty values
    $args = array_values(array_filter($args));
    // Set this for compatibility
    $_GET['q'] = implode('/', $args);
    // And finally render the page
    print CRM_Core_Invoke::invoke($args);
  }
  else {
    $config = CRM_Core_Config::singleton();
    $urlVar = $config->userFrameworkURLVar;
    print CRM_Core_Invoke::invoke(explode('/', $_GET[$urlVar]));
  }
}

invoke();
