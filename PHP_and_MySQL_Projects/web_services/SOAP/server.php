<?php
  require("ProductService.php"); //Require the handler class
  require_once("../wsdl/php-wsdl/class.phpwsdl.php");

  $soap = PhpWsdl::CreateInstance(
    null,
    null,
    "../wsdl/php-wsdl/cache",
    Array("ProductService.php"),
    null,
    null,
    null,
    false,
    false
  );

  //modifying the .ini. file
  ini_set('soap.wsdl_cache_enabled',0);  //disable wsdl cache
  ini_set('soap.wsdl_cache',0);

  PhpWsdl::$CacheTime = 0; //from class
  PhpWsdl::DisableCache(); //from PHP
  if( $soap->IsWsdlRequested() ){
    $soap->Optimize = false;
  }
  $soap->RunServer();
?>
