<?php
class Trap
{
	public function __construct()
	{
	}

	static function setTrap($fields,$floor = 1)
	{
		$setFields = array();
		$num = rand(DNDConf::DND_TRAP_MIN,DNDConf::DND_TRAP_MAX);
		if ($num==0) {
			return array('setFields'=>$setFields,'wallFields'=>$fields);
		}else{
			for ($i=0; $i < $num; $i++) { 
				$setFieldsRow = array_rand($fields,1);
				$setKey = array_rand($fields[$setFieldsRow],1);
				$trapType = array_rand(DNDConf::$DND_Trap,1);
				$setFields[$setFieldsRow][$setKey] = array(
						'type'=>'trap',
						'state'=>'undig',
						'info'=>DNDConf::$DND_Trap[$trapType],
					);
				unset($fields[$setFieldsRow][$setKey]);
			}
			return array('setFields'=>$setFields,'wallFields'=>$fields);
		}
	}
}