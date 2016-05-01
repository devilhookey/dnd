<?php
class Fields
{
	public function __construct()
	{
		$this->realFields = DNDConf::$DND_Fields;
		/*
		$this->maxFields = DNDConf::DND_MAX_FIELDS;
		$this->baseFloor = DNDConf::DND_BASE_FLOOR;
		$this->monster = new Monster();
		$this->item = new Item();
		$this->trap = new Trap();
		*/
	}

	static function initFields(){
		$realFields = DNDConf::$DND_Fields;
		foreach ($realFields as $row => $rowValue) {
			foreach ($rowValue as $key => $value) {
				$realFields[$row][$key] = array(
					'type'=>'wall',
					'state'=>'undig',
				);
			}
		}
		$setDoorArr = self::setDoor($realFields);
		//print_r($setDoorArr);
		$realFields = FunctionLib::mergeDyadicArrayByKey($realFields,$setDoorArr['setFields']);
		return array('realFields'=>$realFields,'wallFields'=>$setDoorArr['wallFields']);
	}

	static function setDoor($fields)
	{
		$setFields = array();
		$doorFieldsRow = array_rand($fields,1);
		$doorKey = array_rand($fields[$doorFieldsRow],1);
		$setFields[$doorFieldsRow][$doorKey] = array(
				'type'=>'door',
				'state'=>'cloes',
			);
		unset($fields[$doorFieldsRow][$doorKey]);
		return array('setFields'=>$setFields,'wallFields'=>$fields);
	}



}