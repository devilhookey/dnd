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
require_once CONF_ROOT.'/index.cfg.php';
require_once LIB_ROOT.'/Function.class.php';
require_once MOD_ROOT.'/Fields/Fields.class.php';
require_once MOD_ROOT.'/Trap/Trap.class.php';
require_once MOD_ROOT.'/Monster/Monster.class.php';
require_once MOD_ROOT.'/Item/Item.class.php';
require_once MOD_ROOT.'/Hero/Hero.class.php';
require_once MOD_ROOT.'/Dig/Dig.class.php';

switch ($_GET['act']) {
  case 'dig':
    list($row,$rKey) = explode('_', $_GET['position']);
    echo json_encode(Dig::dig($row,$rKey));
    break;
  
  default:
    echo json_encode(array());
    break;
}

