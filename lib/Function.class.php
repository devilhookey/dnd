<?php
class FunctionLib
{
	public function __construct()
	{
	}

	static function mergeDyadicArrayByKey($a = array(),$b = array()){
		foreach ($b as $row => $rowValue) {
			foreach ($rowValue as $key => $value) {
				$a[$row][$key] = $value;
			}
		}
		return $a;
	}

}
