<?php

function invoke() {
  // Redirect to the dashboard for discoverability
  // but in the future we may want a login page or something else.
  if ($_SERVER['REQUEST_URI'] == '/') {
    CRM_Utils_System::redirect('/civicrm');
  }

  if (!empty($_SERVER['REQUEST_URI'])) {
    // Required so that the userID is set before generating the menu
    \CRM_Core_Session::singleton()->initialize();
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
    // @todo Is it necessary to support this?
    // Apache has not been tested yet, but presumably not required.
    $config = CRM_Core_Config::singleton();
    $urlVar = $config->userFrameworkURLVar;
    print CRM_Core_Invoke::invoke(explode('/', $_GET[$urlVar]));
  }
}

if (file_exists('../civicrm.settings.php')) {
  require_once '../vendor/autoload.php';
  require_once '../civicrm.settings.php';
  invoke();
}
else {
  $coreUrl = '/assets/civicrm/core';
  $root = dirname(__DIR__);
  $civiroot = implode(DIRECTORY_SEPARATOR, [$root, 'vendor', 'civicrm', 'civicrm-core']);
  $classLoader = implode(DIRECTORY_SEPARATOR, [$civiroot, 'CRM', 'Core', 'ClassLoader.php']);

  if (file_exists($classLoader)) {
    require_once $classLoader;
    CRM_Core_ClassLoader::singleton()->register();
    \Civi\Setup::assertProtocolCompatibility(1.0);
    \Civi\Setup::init([
      // This is just enough information to get going. Drupal.civi-setup.php does more scanning.
      'cms' => 'Standalone',
      'webroot' => $root,
      'srcPath' => $civiroot,
    ]);
    $ctrl = \Civi\Setup::instance()->createController()->getCtrl();
    $ctrl->setUrls([
      'ctrl' => 'civicrm', // @todo this had url('civicrm')
      'res' => $coreUrl . '/setup/res/',
      'jquery.js' => $coreUrl . '/bower_components/jquery/dist/jquery.min.js',
      'font-awesome.css' => $coreUrl . '/bower_components/font-awesome/css/font-awesome.min.css',
    ]);
    \Civi\Setup\BasicRunner::run($ctrl);
    exit();
  }
}
