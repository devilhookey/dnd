<?php
class Hero
{
	public function __construct()
	{
	}

	static function setHero()
	{
		$_SESSION['hero'] = array(
				'type'=>'hero',
				'attack'=>1,
				'blood'=>DNDConf::DND_HERO_BLOOD,
				'blue'=>DNDConf::DND_HERO_BLUE,
				'dodge'=>1,
				'shield'=>DNDConf::DND_HERO_SHIELD,
				'gold'=>0,
				'state'=>'alive',
			);
		//print_r($_SESSION['hero']);
		//$_SESSION['hero'] = $hero;
		//return $_SESSION['hero'];
	}

	static function floorOverCheck($floor = 1)
	{
		$_SESSION['hero']['attack'] = $_SESSION['hero']['attack']+(floor($floor/10)*2);
		$_SESSION['hero']['blood'] = $_SESSION['hero']['blood']+(rand(ceil(1+($floor/10)) , ceil(1+($floor/5))));
		$_SESSION['hero']['dodge'] = 1+($floor/20);
		//return $hero;
	}

	static function getHeroAttack()
	{
		return $_SESSION['hero']['attack'];
	}

	static function getState()
	{
		return $_SESSION['hero']['state'];
	}

	static function modifyHeroProperty($property, $num)
	{
		$_SESSION['hero'][$property] = $_SESSION['hero'][$property] + $num;
	}

	static function hitHero($damage = 0)
	{
		$isHit = rand(0,100);
		if ($isHit<$_SESSION['hero']['dodge']) {//MISS
			# code...
			//echo "miss";
		} else {
			//echo "hit";
			if ($_SESSION['hero']['shield']>0) {
				$overDamage = $damage - $_SESSION['hero']['shield'];
				if ($overDamage>0) {
					$_SESSION['hero']['shield'] = 0;
					$_SESSION['hero']['blood'] = $_SESSION['hero']['blood'] - $overDamage;
				} else {
					$_SESSION['hero']['shield'] = $_SESSION['hero']['shield']-$damage;
				}
			} else {
				$_SESSION['hero']['blood'] = $_SESSION['hero']['blood'] - $damage;
			}
		}
		if ($_SESSION['hero']['blood']<1) {
			//hero die game over
			$_SESSION['hero']['state'] = 'dead';
		} else {
			# code...
		}
		
	}
}