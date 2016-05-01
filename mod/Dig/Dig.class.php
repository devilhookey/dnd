<?php
class Dig
{
	public function __construct()
	{
	}

	static function Dig($row,$rKey)
	{
		$floor = $_SESSION['floor'];
		$fields = $_SESSION['dnd'][$floor];
		$target = $fields[$row][$rKey];
		$showArray = array(
			'msg' =>'',//other
			'hero' =>'',//other
			'returnCode' =>'0',//other
		);
		if (Hero::getState()=='dead') {
			$showArray['msg'] = 'game over<br><a href="?retry=1">retry</a>';
			$showArray['hero'] = print_r($_SESSION['hero'],true);
			return $showArray;
		} else {
			# code...
		}
		if ($target['state']=='undig') {//todo 附加周围情况判断是否可以开启
			$digCheck = array(
				array($row-1,$rKey),
				array($row,$rKey-1),
				array($row,$rKey+1),
				array($row+1,$rKey),
			);
			foreach ($digCheck as $checkRow => $checkRowKey) {
				if ($_SESSION['dnd'][$floor][$checkRowKey[0]][$checkRowKey[1]]['state'] == 'dug' || $_SESSION['dnd'][$floor][$checkRowKey[0]][$checkRowKey[1]]['state'] == 'used') {
					if ($_SESSION['dnd'][$floor][$checkRowKey[0]][$checkRowKey[1]]['type']=='monster') {
						$canDig = false;
					} else {
						$canDig = true;
					}
				} else {
					if ($_SESSION['dnd'][$floor][$checkRowKey[0]][$checkRowKey[1]]['type']=='door') {
						$canDig = true;
					} else if ($_SESSION['dnd'][$floor][$checkRowKey[0]][$checkRowKey[1]]['type']=='monster' && $_SESSION['dnd'][$floor][$checkRowKey[0]][$checkRowKey[1]]['state']=='dead') {
						$canDig = true;
					} else {
						# code...
					}
				}
			}

			if (isset($canDig) && $canDig) {
				$_SESSION['dnd'][$floor][$row][$rKey]['state'] = 'dug';
			} else {
				$showArray['returnCode'] = '1001';
				$showArray['msg'] = 'can not dig';
				$showArray['hero'] = print_r($_SESSION['hero'],true);
				return $showArray;
			}
		} else {
			// todo
		}
		//monster attack
		foreach ($_SESSION['dnd'][$floor] as $srKey => $srValue) {
			foreach ($srValue as $slKey => $slValue) {
				if ($slValue['type']=='monster' && $slValue['state']=='dug') {
					//echo $slValue['attack'];
					Hero::hitHero($slValue['attack']);
				} else {
					# code...
				}
			}
		}
		switch ($target['type']) {
			case 'wall':
				$showArray['msg'] = 'wall dug';
				break;
			case 'monster'://print_r($target,true);
				$showArray['msg'] = 'type:'.$target['type'].'<br>';
				$showArray['msg'] .= 'name:'.$target['info']['name'].'<br>';
				$showArray['msg'] .= 'attack:'.$target['attack'].'<br>';
				$showArray['msg'] .= 'blood:'.$target['blood'].'<br>';
				$showArray['msg'] .= 'shield:'.$target['shield'].'<br>';
				$showArray['msg'] .= 'hasKey:'.$target['hasKey'].'<br>';
				$showArray['msg'] .= 'state:'.$target['state'].'<br>';
				if ($target['state']!='dead' && $target['state']=='dug') {
					list($returnMonsterShield,$returnMonsterBlood) = Monster::hitMonster($target);
					$_SESSION['dnd'][$floor][$row][$rKey]['shield'] = $returnMonsterShield;
					$_SESSION['dnd'][$floor][$row][$rKey]['blood'] = $returnMonsterBlood;
					if ($returnMonsterShield==0 && $returnMonsterBlood==0) {
						$_SESSION['dnd'][$floor][$row][$rKey]['state'] = 'dead';
					} else {
						# code...
					}
				} else {
					# code...
				}
				
				break;
			case 'item':
				if ($_SESSION['dnd'][$floor][$row][$rKey]['state'] != 'used') {
					switch ($target['info']) {
						case 'blood':
							Hero::modifyHeroProperty($target['info'],$target['num']);
							break;
						case 'blue':
							Hero::modifyHeroProperty($target['info'],$target['num']);
							break;
						case 'shield':
							Hero::modifyHeroProperty($target['info'],$target['num']);
							break;
						case 'gold':
							Hero::modifyHeroProperty($target['info'],$target['num']);
							break;
						
						default:
							# code...
							break;
					}
					$_SESSION['dnd'][$floor][$row][$rKey]['state'] = 'used';
				} else {
					# code...
				}			
				$showArray['msg'] = 'type:'.$target['type'].'<br>';
				$showArray['msg'] .= 'name:'.$target['info'].'<br>';
				$showArray['msg'] .= 'num:'.$target['num'].'<br>';
				break;
			case 'trap':
				$showArray['msg'] = 'type:'.$target['type'].'<br>';
				$showArray['msg'] .= 'name:'.$target['info']['name'].'<br>';
				$showArray['msg'] .= 'state:'.$target['state'].'<br>';
				break;
			case 'door'://do open go next floor
				foreach ($fields as $fRow => $fRowValue) {
					foreach ($fRowValue as $fKey => $fValue) {
						if ($fValue['type']=='monster' && $fValue['hasKey']==1 && $fValue['state']=='dead') {
							Hero::floorOverCheck($_SESSION['floor']);
							$_SESSION['floor']++;
							$goNextFloor = true;
						} else {
							$showArray['msg'] = '+U';
						}
					}
				}
				if (isset($goNextFloor) && $goNextFloor) {
					$showArray['msg'] = "<a href='?floor=".$_SESSION['floor']."'>= next floor =</a>";
				} else {
					$showArray['msg'] = '+U';
				}
				
				break;
			default:
				# code...
				break;
		}
		$showArray['hero'] = print_r($_SESSION['hero'],true);
		return $showArray;
	}
}