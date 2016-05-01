<?php
class Item
{
	public function __construct()
	{
		/*
		   const DND_ITEM_MIN_EQUIPMENT = 0;
		   const DND_ITEM_MAX_EQUIPMENT = 3;
		 */
	}

	static function setItem($fields,$floor = 1)
	{
		$setFields = array();
		//blood
		$num = rand(DNDConf::DND_ITEM_MIN_BLOOD,DNDConf::DND_ITEM_MAX_BLOOD);
		if ($num==0) {
# code
		}else{
			for ($i=0; $i < $num; $i++) { 
				$setFieldsRow = array_rand($fields,1);
				if(!empty($fields[$setFieldsRow])){
					$setKey = array_rand($fields[$setFieldsRow],1);
					$setFields[$setFieldsRow][$setKey] = array(
							'type'=>'item',
							'state'=>'undig',
							'info'=>'blood',
							'num'=>rand(ceil(1+($floor/30)) , ceil(1+($floor/20))),
							);
					unset($fields[$setFieldsRow][$setKey]);
				}
			}
		}
		//blue
		$num = rand(DNDConf::DND_ITEM_MIN_BLUE,DNDConf::DND_ITEM_MAX_BLUE);
		if ($num==0) {
# code
		}else{
			for ($i=0; $i < $num; $i++) { 
				$setFieldsRow = array_rand($fields,1);
				if(!empty($fields[$setFieldsRow])){
					$setKey = array_rand($fields[$setFieldsRow],1);
					$setFields[$setFieldsRow][$setKey] = array(
							'type'=>'item',
							'state'=>'undig',
							'info'=>'blue',
							'num'=>rand(ceil(1+($floor/30)) , ceil(1+($floor/20))),
							);
					unset($fields[$setFieldsRow][$setKey]);
				}
			}
		}
		//shield
		$num = rand(DNDConf::DND_ITEM_MIN_SHIELD,DNDConf::DND_ITEM_MAX_SHIELD);
		if ($num==0) {
# code
		}else{
			for ($i=0; $i < $num; $i++) { 
				$setFieldsRow = array_rand($fields,1);
				if(!empty($fields[$setFieldsRow])){
					$setKey = array_rand($fields[$setFieldsRow],1);
					$setFields[$setFieldsRow][$setKey] = array(
							'type'=>'item',
							'state'=>'undig',
							'info'=>'shield',
							'num'=>rand(ceil(1+($floor/30)) , ceil(1+($floor/20))),
							);
					unset($fields[$setFieldsRow][$setKey]);
				}
			}
		}
		//glod
		$num = rand(DNDConf::DND_ITEM_MIN_GOLD,DNDConf::DND_ITEM_MAX_GOLD);
		if ($num==0) {
# code
		}else{
			for ($i=0; $i < $num; $i++) { 
				$setFieldsRow = array_rand($fields,1);
				if(!empty($fields[$setFieldsRow])){
					$setKey = array_rand($fields[$setFieldsRow],1);
					$setFields[$setFieldsRow][$setKey] = array(
							'type'=>'item',
							'state'=>'undig',
							'info'=>'gold',
							'num'=>3*(floor($floor/10))+1,
							);
					unset($fields[$setFieldsRow][$setKey]);
				}
			}
		}
		return array('setFields'=>$setFields,'wallFields'=>$fields);
	}
}
