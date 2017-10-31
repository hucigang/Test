<?php
	// 这个页面为php实现sql查询结果转换为json格式文本并回显在web界面上的测试
	
	// PHP SQL JSON TEST
	// header('content-type:application/json;charset=utf8');
	header("Access-Control-Allow-Origin: *");

	$DB_NAME	= 'test01.db';
	$dbObj		= new SQLite3($DB_NAME);
	$queObj		= $dbObj->query("select * from chuanganqi");
	$results	= array();
	while ($eachRow = $queObj->fetcharray(SQLITE3_ASSOC)) {
		$results[]	= $eachRow;
	}
	echo json_encode($results)
?>