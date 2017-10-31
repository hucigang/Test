<?php
	// php API 作用：下载任务的接口

	// PHP SQL JSON TEST
	// header('content-type:application/json;charset=utf8');

	$clientid	= $_GET[cid];		// 要下载的任务筛选（根据客户端id）

	$DB_NAME	= 'test01.db';
	$dbObj		= new SQLite3($DB_NAME);
	// echo $clientid;
	$queObj		= $dbObj->query("	select * from jobstates 
									where clientid=".$clientid." and jobstate != 'DONE'");
	$results	= array();
	while ($eachRow = $queObj->fetcharray(SQLITE3_ASSOC)) {
		$results[]	= $eachRow;
	}
	echo json_encode($results)
?>