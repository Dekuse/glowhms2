<?php

  require_once 'config/config.php';

  require_once 'helpers/session_Controller.php';
  require_once 'helpers/url_helper.php';
  require_once 'helpers/ip_helper.php';


  spl_autoload_register(function ($className) {
      require_once 'libraries/'. $className . '.php';
  });
