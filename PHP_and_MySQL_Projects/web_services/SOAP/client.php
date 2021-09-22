<?php
  ini_set("default_socket_timeout",10);

  $soap_options = array("trace"=>1,"exceptions"=>1);
  $wsdl = "http://serenity.ist.rit.edu/~dl2224/341/SOAPLab/server.php?wsdl";

  try{
    $client = new SoapClient($wsdl,$soap_options);

    $response = $client->getMethods();
    var_dump($response);
    echo "<br/><b>List of methods:</b>  ";
    echo implode(", ",$response);
    echo "<hr>";

    // $response = "<b>Price of Apples:</b> " . $client->getPrice("Apples");      //IT WORKS
    $response = "<b>Price of Peaches:</b> " . $client->getPrice("Peaches");       //IT WORKS
    // $response = "<b>Price of Pumpkin:</b> " . $client->getPrice("Pumpkin");    //IT WORKS
    // $response = "<b>Price of Pie:</b> " . $client->getPrice("Pie");            //IT WORKS
    var_dump($response);
    echo "$response<br />";
    echo "<hr>";

    $response = $client->getProducts();
    var_dump($response);
    echo "<br/><b>List of products:</b>  ";
    echo implode(", ",$response);
    echo "<hr>";

    $response = $client->getCheapest();
    var_dump($response);
    echo "<br/><b>Cheapest product:</b> ";
    echo implode(" ",$response);
    echo "<hr>";

    $response = $client->getCostliest();
    var_dump($response);
    echo "<br/><b>Costliest product:</b> ";
    echo implode(" ",$response);

  } catch (SoapFault $e) {
    var_dump($e);
  }
?>
