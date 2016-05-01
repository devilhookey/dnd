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

//print_r(DNDConf::$DND_Fields);
//$floor = isset($_GET['floor']) ? intval($_GET['floor']):1;
if (isset($_GET['retry']) && $_GET['retry']==1) {
	unset($_SESSION['floor']);
	unset($_SESSION['dnd']);
	unset($_SESSION['hero']);
} else {
	# code...
}

if (!isset($_GET['floor']) && empty($_SESSION['floor'])) {
	$_SESSION['floor'] = 1;
	$floor = 1;
} else {
	if (!isset($_GET['floor']) && !empty($_SESSION['floor'])) {
		$floor = $_SESSION['floor'];
	}	else if ($_GET['floor']>$_SESSION['floor']) {
		exit( "<b>作弊是可耻的</b><br>" );
	} else {
		$floor = $_SESSION['floor'];
		//echo "<b>goon</b><br>";
	}
}
echo "
<!doctype html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Demo Floor ".$floor."</title>
<meta name='author' content='DH'>
<script type='text/javascript' src='./js/jquery-1.11.3.min.js'></script>
<script type='text/javascript' src='./js/jquery-dnd.js'></script>
<link href='./css/base.css' rel='stylesheet'>
</head>
<body>
"; 
if (!empty($_SESSION['dnd'][$floor])) {
	$showFields = $_SESSION['dnd'][$floor];
} else {
	$fieldsInfo = Fields::initFields();
	$showFields = $fieldsInfo['realFields'];
	//print_r($fieldsInfo);

/*
	$trapInfo = Trap::setTrap($fieldsInfo['wallFields'],$floor);
	//print_r($trapInfo);
	$showFields = FunctionLib::mergeDyadicArrayByKey($showFields,$trapInfo['setFields']);
*/

	$monsterInfo = Monster::setMonster($fieldsInfo['wallFields'],$floor);
	//print_r($trapInfo);
	$showFields = FunctionLib::mergeDyadicArrayByKey($showFields,$monsterInfo['setFields']);

	$itemInfo = Item::setItem($monsterInfo['wallFields'],$floor);
	$showFields = FunctionLib::mergeDyadicArrayByKey($showFields,$itemInfo['setFields']);
	
	$_SESSION['dnd'][$floor] = $showFields;
}

if (empty($_SESSION['hero'])) {
	Hero::setHero();
}else{
	//todo
}

//$_SESSION['hero'] = $hero;

//print_r($_SESSION);

echo "<center><table>";
foreach ($showFields as $row => $rowValue) {//生成地牢
	echo "<tr>";
	foreach ($rowValue as $key => $value) {
		echo "<td class='' id='".$row."_".$key."' onclick=\"dig('".$row."_".$key."')\">";
		if ($value['state'] == "undig" ) {
			echo "<div class='wall'>wall</div>";
		} else {
			switch ($value['type']) {
				case 'wall':
					echo "<div class='floor'>floor</div>";
					break;
				case 'monster':
					echo '<div class="monster">';
					echo 'type:'.$value['type'].'<br>';
					echo 'name:'.$value['info']['name'].'<br>';
					echo 'attack:'.$value['attack'].'<br>';
					echo 'blood:'.$value['blood'].'<br>';
					echo 'shield:'.$value['shield'].'<br>';
					echo 'hasKey:'.$value['hasKey'].'<br>';
					echo 'state:'.$value['state'].'<br>';
					echo '</div>';
					break;
				case 'item':
					echo "item";
					echo 'name:'.$value['info'].'<br>';
					break;
				case 'trap':
					echo 'type:'.$value['type'].'<br>';
					echo 'name:'.$value['info']['name'].'<br>';
					echo 'state:'.$value['state'].'<br>';
					break;
				case 'door':
					echo "<div class='door'>這是門</div>";
					break;

				default:
# code...
					break;
			}
		}
		echo "</td>";
	}
	echo "<tr>";
}
echo "</table></center>";
echo "<br>";
echo "<center>角色信息<br><div id='hero'>";
print_r($_SESSION['hero']);
echo "</div></center>";
echo "
</body>
</html>
";
