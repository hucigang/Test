<?php
	// php API 作用：任务上传接口
	
	//PHP job upload API test!

	header("Content-Type:text/html;   charset=utf-8"); 
	$jsonStr	= $_POST['jsonStr'];
	$jsonData	= json_decode($jsonStr, true);

	if (!empty($jsonData)){
			$DB_NAME	= "test01.db";
			$dbObj		= new SQLite3($DB_NAME);
			if (!$dbObj) {
				echo $dbObj->lastErrorMsg();
			}
			// 注意！！下面的任务后期需用数据库事务机制实现，这里只是Demo！！
			// 任务计数器+1
			$sql 		= "
				UPDATE sys_stat
				SET VALUE = VALUE + 1
				WHERE KEY = 'jobcount'";
			echo $sql;
			if (!$dbObj->exec($sql)) {
				echo $dbObj->lastErrorMsg();
			}else{
				echo $dbObj->changes();
			};
			// 添加任务
			//->获取任务总数
			$sql 		= "
				SELECT * FROM sys_stat
				WHERE KEY = 'jobcount'";
			$row 		= 	$dbObj->query($sql)->
							fetchArray(SQLITE3_ASSOC);
			$jobcount	= $row[value];
			//->添加下一个任务
			$sql 		= "
				INSERT INTO jobstates VALUES(
				".$jobcount."
				,".$jsonData['clientid']."
				,'".$jsonStr."'
				,'NEW')";
			echo $sql;
			if (!$dbObj->exec($sql)) {
				echo $dbObj->lastErrorMsg();
			}else{
				echo $dbObj->changes();
			};
			$dbObj->close();
		}
?>