<?php
	function  fibonacci($n){
	
		$last = 0;
		$curr = 1;
		
		for ($i = 1; $i <= $n; ++$i) {
		  echo $last . ", ";
		  
		  $tmp = $last + $curr;
		  $last = $curr;
		  $curr = $tmp;
		}
	}
	
	fibonacci(10);