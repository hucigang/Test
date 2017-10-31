<?php
	// 接口执行清除任务列表的动作，这个php的执行过程应该要进行执行授权验证
	$DB_NAME	= "test01.db";
	$dbObj		= new SQLite3($DB_NAME);
	if (!$dbObj) {
		echo $dbObj->lastErrorMsg();
	}
	$sql 		= "
		UPDATE sys_stat
		SET VALUE = 0
		WHERE KEY='jobcount';
		DELETE FROM jobstates";
	// echo $sql;
	if (!$dbObj->exec($sql)) {
		echo $dbObj->lastErrorMsg();
	}else{
		echo $dbObj->changes();
	};
?>