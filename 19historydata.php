<?php
	// php API 调用显示历史数据


	header("Content-Type:text/html;   charset=utf-8"); 
	header("Access-Control-Allow-Origin: *");

	$clientids 	= $_REQUEST[id];
	$limit 		= $_REQUEST[limit];
	$type 		= $_REQUEST[type];
	$DB_NAME	= 'test01.db';
	$dbObj		= new SQLite3($DB_NAME);

	function queryHistory($dbObj, $id1, $id2, $id3, $type, $limit)
	{
		// 从数据库检索历史数据
		$sql 	= "
				SELECT * FROM historyData WHERE (单位编码=".$id1.
				" AND 二级编码=".$id2.
				" AND 从机编码=".$id3.
				" AND 类型代码=".$type.
				")
				ORDER BY 采集时间 DESC
				LIMIT 0,".$limit;

		// echo $sql;
		$results	= array();
		$queObj		= $dbObj->query($sql);
		while ($eachRow = $queObj->fetcharray(SQLITE3_ASSOC)) {
			$results[]	= array(	"value" => $eachRow["数据"],
									"time"=>$eachRow["采集时间"]);
		}
		return $results;
	}

	$returnData = array();

	$clientidArry = explode(",", $clientids);
	// echo var_dump($clientidArry);
	while ($clientid = each($clientidArry)) 
	{
		// echo $clientid[1];
		$res = queryHistory($dbObj, 0, 0, $clientid[1], $type, $limit);
		$returnData["id".$clientid[1]] = $res;
	}

	echo json_encode($returnData);
?>