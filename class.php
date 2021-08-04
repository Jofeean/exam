<?php
	class Cons{
		private $numArray = array();
		
		public function __construct($array) {
			$this->numArray = $array;
		}
		
		public function bubble(){
			$newList = $this->numArray;
			
			for($i = 1; $i < count($newList); $i++){
				for($j = 0; $j < count($newList)-$i; $j++){
					if($newList[$j+1] < $newList[$j]){
						$tmp = $newList[$j+1];
						$newList[$j+1] = $newList[$j];
						$newList[$j] = $tmp;
					}
				}
			}
			
			return $newList[count($newList)-1];
		}
	}
	
	$cons = new Cons([1,3,2,10,5,7,4,0]);
	echo $cons->bubble();
	