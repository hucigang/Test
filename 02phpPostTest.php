<?php
	// php的参数POST测试
	
	echo 'PHP POST TEST<br>';
	
	foreach ($_POST as $key => $value) {
		echo $key . '=>' . $value . '<br>';
	}
?>