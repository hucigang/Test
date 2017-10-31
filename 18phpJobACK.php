<?php
	// php API 作用：任务完成后的上报接口
	
	$jobid	= $_GET['jobid'];
	$jobSta	= $_GET['jobSta'];

	if (!empty($jobid)){
		$DB_NAME	= "test01.db";
		$dbObj		= new SQLite3($DB_NAME);
		if (!$dbObj) {
			echo $dbObj->lastErrorMsg();
		}
		$sql 		= "
			update jobstates set
			jobstate='".$jobSta."' 
			where jobid=".$jobid;
		echo $sql;
		if (!$dbObj->exec($sql)) {
			echo $dbObj->lastErrorMsg();
		}else{
			echo $dbObj->changes();
		};
		$dbObj->close();
	}
?>			