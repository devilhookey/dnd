<?php
class Monster
{
	public function __construct()
	{
	}

	static function setMonster($fields, $floor = 1)
	{
		$setFields = array();
		$num = rand(DNDConf::DND_MONSTER_MIN,DNDConf::DND_MONSTER_MAX);
		$hasKey = rand(1,$num);
		if ($num==0) {
			return array('setFields'=>$setFields,'wallFields'=>$fields);
		}else{
			for ($i=0; $i < $num; $i++) { 
				$setFieldsRow = array_rand($fields,1);
				$setKey = array_rand($fields[$setFieldsRow],1);
				$monsterType = array_rand(DNDConf::$DND_Monster,1);
				$setFields[$setFieldsRow][$setKey] = array(
						'type'=>'monster',
						'state'=>'undig',
						'info'=>DNDConf::$DND_Monster[$monsterType],
						'attack'=>self::setMonsterAttack($floor,DNDConf::$DND_Monster[$monsterType]['type']),
						'blood'=>self::setMonsterBlood($floor),
						'dodge'=>self::setMonsterDodge($floor),
						'shield'=>DNDConf::$DND_Monster[$monsterType]['type']=='a'?1:0,
						'hasKey'=>($i+1)==$hasKey?1:0,
					);
				unset($fields[$setFieldsRow][$setKey]);
			}
			return array('setFields'=>$setFields,'wallFields'=>$fields);
		}
	}

	static function setMonsterAttack($floor = 1, $add = 0)//攻击力计算
	{
		if ($add=='b') {//攻击强化型
			return rand(ceil((1*$floor)-($floor*0.8))+ceil((1*$floor)-($floor*0.8)) , ceil((1*$floor)-($floor*0.4))+ceil((1*$floor)-($floor*0.8)));
		} else {//普通型
			return rand(ceil((1*$floor)-($floor*0.8)) , ceil((1*$floor)-($floor*0.4)));
		}
	}

	static function setMonsterBlood($floor = 1)//血量计算
	{
		return rand(ceil((1*$floor)-($floor*0.6)) , ceil((1*$floor)-($floor*0.3)));
	}

	static function setMonsterDodge($floor = 1)//闪避几率计算
	{
		return rand(ceil(1+($floor/30)) , ceil(1+($floor/10)));
	}

	static function hitMonster($monster)//
	{
		$heroAttack = Hero::getHeroAttack();
		$isHit = rand(0,100);
		if ($isHit<$monster['dodge']) {//MISS
			# code...
			//echo "miss";
		} else {
			//echo "hit";
			if ($monster['shield']>0) {
				$returnMonsterShield = $monster['shield']-1;
			} else {
				$returnMonsterBlood = $monster['blood'] - $heroAttack;
			}
		}
		return array($returnMonsterShield,$returnMonsterBlood);
		//return rand(ceil(1+($floor/30)) , ceil(1+($floor/10)))/100;
	}
}