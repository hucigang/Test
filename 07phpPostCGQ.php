<?php
	// php API 实现接受传感器的数据（json格式），显示在web界面上，并将数据更新到数据库中，下面为一个json示例
	// 注：数据库操作部分还未使用存储过程

	// jsonStr={"id":1,"wendu":27,"shidu":123,"shuifa":1,"fengshan":1,"co2":133,"qita":""}

	header("Content-Type:text/html;   charset=utf-8"); 
	echo "PHP 传感器数据上传测试" . '<br>';

	$jsonStr 	= $_POST[jsonStr];
	echo 'POST方法接收到的原始数据：<br>' . $jsonStr . '<br><br>';
	echo 'Json数据本地解析取得的变量结果：<br>';
	$jsonData	= json_decode($jsonStr, true);
?>
<table border="1" width="300">
	<tr>
		<td>id</td>
		<td>温度</td>
		<td>湿度</td>
		<td>CO2</td>
		<td>水阀</td>
		<td>风扇</td>
		<td>其他</td>
		
	</tr>
	<?php
		if (!empty($jsonData)){
			echo "<tr>
					<td>".$jsonData['id']."</td>
					<td>".$jsonData['wendu']."</td>
					<td>".$jsonData['shidu']."</td>
					<td>".$jsonData['co2']."</td>
					<td>".$jsonData['shuifa']."</td>
					<td>".$jsonData['fengshan']."</td>
					<td>".$jsonData['qita']."</td>
				</tr>";

			$DB_NAME	= "test01.db";
			$dbObj		= new SQLite3($DB_NAME);
			if (!$dbObj) {
				echo $dbObj->lastErrorMsg();
			}

			// 这里的数据库操作在使用MySQL时应该使用高级技术
			$sql 		= "
				update chuanGanQi set
				wendu = '".$jsonData['wendu']. "',"."
				shidu = '".$jsonData['shidu']. "',"."
				co2 = '".$jsonData['co2']. "',"."
				shuifa = '".$jsonData['shuifa']. "',"."
				fengshan = '".$jsonData['fengshan']. "',"."
				qita = '".$jsonData['qita']."'
				where id=".$jsonData['id'];
			echo $sql;
			if (!$dbObj->exec($sql)) {
				echo $dbObj->lastErrorMsg();
			}else{
				echo $dbObj->changes();
			};

			// 处理历史数据表
			date_default_timezone_set('PRC');	// 设置时区
			$dataAndTime = intval(date("YmdHis"));		// 时间戳

			function dealHistoryTable($dbObj, $type, $value, $time, $id1, $id2, $id3)
			{
				// 处理历史数据的函数
				$sql 		= "
					INSERT INTO historyData(类型代码,数据,采集时间,单位编码,二级编码,从机编码) VALUES (".
						$type.",".
						$value.",".
						$time.",".
						$id1.",".
						$id2.",".
						$id3.")";
				echo $sql;
				if (!$dbObj->exec($sql)) {
					echo $dbObj->lastErrorMsg();
				}else{
					echo $dbObj->changes();
				};
			}

			// 温度
			dealHistoryTable($dbObj, 1, $jsonData[wendu], $dataAndTime, 0, 0, $jsonData[id]);
			// 湿度
			dealHistoryTable($dbObj, 2, $jsonData[shidu], $dataAndTime, 0, 0, $jsonData[id]);
			// 二氧化碳
			dealHistoryTable($dbObj, 3, $jsonData[co2], $dataAndTime, 0, 0, $jsonData[id]);
			// 水阀
			dealHistoryTable($dbObj, 4, $jsonData[shuifa], $dataAndTime, 0, 0, $jsonData[id]);
			// 风扇
			dealHistoryTable($dbObj, 5, $jsonData[fengshan], $dataAndTime, 0, 0, $jsonData[id]);

			$dbObj->close();
		}
	?>
</table>