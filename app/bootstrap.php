<?php
 
 //load config file
  require_once  'config/config.php';


  //AUTO LOADER
  spl_autoload_register(function($className){
    require_once  'libraries/'. $className .'.php';

  });
