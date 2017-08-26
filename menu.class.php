<?php
class Menu{
	public $arr;
	public $menu='[
			{"type_id":1,"name":"大菜","food":[
											{"food_id":1,"name":"鱼香肉丝","price":"10"},
											{"food_id":2,"name":"红烧肉","price":"11"},
											{"food_id":3,"name":"香辣粉","price":"12"}
											]},
			{"type_id":2,"name":"中菜","food":[
											{"food_id":4,"name":"小炒肉","price":"13"},
											{"food_id":5,"name":"云吞","price":"14"}
											]},
			{"type_id":3,"name":"小菜","food":[
											{"food_id":6,"name":"雪糕","price":"15"},
											{"food_id":7,"name":"黄瓜","price":"16"}
											]}	    
		]';
	public $sum;
	public $order;
	static $num;
	function __construct($order){
		$this->menu=json_decode($this->menu,true);
		$this->arr=$this->changeArr($this->menu);
		$this->sum=$this->calucate($this->order);
		$this->order=json_decode($order,true);
	}
	function changeArr(){
		/* $menu=json_decode($this->menu,true); */
		foreach ($this->menu as $key=>$value){
			foreach ($value['food'] as $k=>$j){
				$this->arr[$j['food_id']]["id"]=$j['food_id'];
				$this->arr[$j['food_id']]['name']=$j['name'];
				$this->arr[$j['food_id']]['price']=$j['price'];
				$this->arr[$j['food_id']]['type_id']=$value['type_id'];
				$this->arr[$j['food_id']]['tname']=$value['name'];
			}
		}
		return $this->arr;
	}
	function calucate(){
/* 		$orderr=json_decode($this->order,true); */
		if(is_array($this->order)){
			foreach ($this->order as $i){
				$this->sum+=$i['num']*$this->arr[$i['food_id']]['price'];
			}
		}
		self::$num++;
		echo $this->sum;
	}

	function discount($zk){
		return $this->sum*$zk;
	}
	static function counter(){
			return self::$num;
	}
}

$order = '[{"food_id":1,"num":2},{"food_id":3,"num":1},{"food_id":6,"num":2},{"food_id":7,"num":1}]';
$me=new Menu($order);
echo $me->calucate();
echo '<hr>';
 echo $me->discount(1);
echo '<hr>';
echo Menu::counter();
