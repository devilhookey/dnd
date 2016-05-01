<?php
class DNDConf
{
const DND_MAX_FIELDS = 30;
const DND_BASE_FLOOR = 1;
public static $DND_Fields = array(
		'1' => array('1'=>'',	'2'=>'',	'3'=>'',	'4'=>'',	'5'=>'',),
		'2' => array('1'=>'',	'2'=>'',	'3'=>'',	'4'=>'',	'5'=>'',),
		'3' => array('1'=>'',	'2'=>'',	'3'=>'',	'4'=>'',	'5'=>'',),
		'4' => array('1'=>'',	'2'=>'',	'3'=>'',	'4'=>'',	'5'=>'',),
		'5' => array('1'=>'',	'2'=>'',	'3'=>'',	'4'=>'',	'5'=>'',),
		'6' => array('1'=>'',	'2'=>'',	'3'=>'',	'4'=>'',	'5'=>'',),
	);

const DND_TRAP_MIN = 0;
const DND_TRAP_MAX = 3;

public static $DND_Trap = array(
		'1' => array('name'=>'增益怪物攻击型',	'type'=>'a',	'blue'=>'3',),
		'2' => array('name'=>'增益怪物辅助型',	'type'=>'b',	'blue'=>'3',),
		'3' => array('name'=>'减益人物',	'type'=>'c',	'blue'=>'2',),
		'4' => array('name'=>'直接伤害人物',	'type'=>'d',	'blue'=>'0',),
	);

const DND_MONSTER_MIN = 4;
const DND_MONSTER_MAX = 6;

public static $DND_Monster = array(
		'1' => array('name'=>'护盾型',	'type'=>'a',	'blue'=>'0',),
		'2' => array('name'=>'攻击强化型',	'type'=>'b',	'blue'=>'0',),
		'3' => array('name'=>'普通',	'type'=>'c',	'blue'=>'0',),
		'4' => array('name'=>'普通',	'type'=>'c',	'blue'=>'0',),
		'5' => array('name'=>'普通',	'type'=>'c',	'blue'=>'0',),
		'6' => array('name'=>'普通',	'type'=>'c',	'blue'=>'0',),
		'7' => array('name'=>'普通',	'type'=>'c',	'blue'=>'0',),
	);

const DND_ITEM_MIN_BLOOD = 2;
const DND_ITEM_MAX_BLOOD = 5;

const DND_ITEM_MIN_BLUE = 1;
const DND_ITEM_MAX_BLUE = 3;

const DND_ITEM_MIN_SHIELD = 1;
const DND_ITEM_MAX_SHIELD = 2;

const DND_ITEM_MIN_EQUIPMENT = 0;
const DND_ITEM_MAX_EQUIPMENT = 3;

const DND_ITEM_MIN_GOLD = 0;
const DND_ITEM_MAX_GOLD = 3;

public static $DND_Item_Equipment = array(
		'1' => array('name'=>'护盾',	'type'=>'a',	'blue'=>'0',),
		'2' => array('name'=>'武器',	'type'=>'b',	'blue'=>'0',),
		'3' => array('name'=>'卷轴',	'type'=>'c',	'blue'=>'0',),
	);

const DND_HERO_BLOOD = 50;
const DND_HERO_BLUE = 10;
const DND_HERO_SHIELD = 50;
}