<?php

//including the required files
require_once 'restServices/restAPI.php';
require 'vendor/autoload.php';

//Creating a slim instance
$app = new Slim\App();

$app->get( '/getBooks', function () use ( $app ) {
	$response = array();
	$db       = new RestAPI();
	$res      = $db->getBooks();
	if ( $res == 0 ) {
		$response["error"]   = false;
		$response["message"] = "You are successfully registered";
		echoResponse( 201, $response );
	} else {
		echoResponse( $res );
	}
} );

$app->post( '/userLogin', function ( $request ) use ( $app ) {
	$response = array();
	$username = $request->getParam( 'username' );
	$password = $request->getParam( 'password' );
	$db       = new RestAPI();
	$res      = $db->userLogin( $username, $password );
	if ( $res == true ) {
		$response["status"]  = $res;
		$response["error"]   = false;
		$response["message"] = "You are successfully logged in";
	} else {
		$response["status"]  = $res;
		$response["error"]   = true;
		$response["message"] = "You are not successfully logged in";
	}
	echoResponse( $response );
} );

$app->put( '/createBooks', function ( $request ) use ( $app ) {
	$response = array();
	$username = $request->getParam( 'username' );
	$password = $request->getParam( 'password' );
	$db       = new RestAPI();
	$res      = $db->userLogin( $username, $password );
	if ( $res == true ) {
		$response["status"]  = $res;
		$response["error"]   = false;
		$response["message"] = "You are successfully logged in";
	} else {
		$response["status"]  = $res;
		$response["error"]   = true;
		$response["message"] = "You are not successfully logged in";
	}
	echoResponse( $response );
} );

function echoResponse( $response ) {
	echo json_encode( $response );
}


$app->run();
