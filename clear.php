<?php
define('ACCESS', TRUE);
ini_set('memory_limit','-1');
if (! defined ( 'ROOT' ))
{
	define ( 'ROOT', dirname ( __FILE__ ) );
	define ( 'CONF_ROOT', ROOT . '/conf' );
	define ( 'MOD_ROOT', ROOT . '/mod' );
	define ( 'LIB_ROOT', ROOT . '/lib' );
}
session_start();
if(function_exists('date_default_timezone_set')) {
	@date_default_timezone_set('Asia/Shanghai');
}
ini_set('display_errors','On');
error_reporting(E_ALL ^ E_NOTICE);
header("Content-type: text/html; charset=utf-8");
session_unset();
session_destroy();