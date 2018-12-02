<?php

error_reporting( -1 );

$GETid = $_GET[ 'id' ] ?? null;

if ( !$GETid ) {
	http_response_code( 400 );
	die();
}

require_once( 'common/connection.php' );

$id = $mysqli->real_escape_string( $GETid );
$res = $mysqli->query( "SELECT `id`, `data` FROM `compositions` WHERE `iduser`='$id'" );

if ( $res ) {
	$arr = array();
	while ( $row = $res->fetch_row() ) {
		$arr[] = $row;
	}
	$res->free();
	$mysqli->close();
	header( 'Content-Type: application/json' );
	echo json_encode( $arr );
} else {
	http_response_code( 500 );
	die( $mysqli->error );
}