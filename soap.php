<?php 
require_once "lib/nusoap.php";

if(!isset($HTTP_RAW_POST_DATA))
	$HTTP_RAW_POST_DATA = file_get_contents('php://input');

// Funciones:
// ==========

function func1()
{
	return "respuesta func1";
}

function func2($param1, $param2)
{
	return "Respuesta func2 " . $param1. "-". $param2 ;
}


$server = new soap_server();
$server->configureWSDL("titulo Web service", "urn:tituloWebService");


// Registrar funciones:
// ====================

$server->register(
	"func1",						// metodo
	array(),						// parametros
	array("return"=>"xsd:string"), 	// respuesta
	"urn:tituloWebService", 		// namespace
	"urn:tituloWebService#func1", 	// accion
	"rpc", 							// estilo
	"encoded", 						// uso
	"descripcion de la función 1"	// descripcion
);

$server->register(
	"func2",						// metodo
	array(
		"param1"=> "xsd:string", 
		"param2"=> "xsd:string"
	),								// parametros
	array("return"=>"xsd:string"), 	// respuesta
	"urn:tituloWebService", 		// namespace
	"urn:tituloWebService#func2", 	// accion
	"rpc", 							// estilo
	"encoded", 						// uso
	"descripcion de la función 2"	// descripcion
);

$server->service($HTTP_RAW_POST_DATA);