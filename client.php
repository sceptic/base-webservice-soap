<?php 
require_once "lib/nusoap.php";

$cliente = new nusoap_client("http://localhost/webs/nusoap/soap.php?wsdl", "wsdl");

$planetas = $cliente->call("func2", array("a1", "2"));


echo var_export($planetas, 1);
