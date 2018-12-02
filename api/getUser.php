<?php

error_reporting( -1 );

if ( !isset( $_GET[ 'id' ] ) ) {
	http_response_code( 400 );
	die();
}

require_once( 'common/connection.php' );

$id = $mysqli->real_escape_string( $_GET[ 'id' ] );
$res = $mysqli->query( "SELECT `id`, `email`, `firstname`, `lastname`, `username`
	FROM `users` WHERE `id`='$id'" );

if ( $res ) {
	$ret = $res->fetch_assoc();
	$res->free();
	$mysqli->close();
	header( 'Content-Type: application/json' );
	echo json_encode( $ret );
} else {
	http_response_code( 500 );
	die( $mysqli->error );
}
