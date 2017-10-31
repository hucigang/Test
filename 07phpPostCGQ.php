<?php
	// php API 实现接受传感器的数据（json格式），显示在web界面上，并将数据更新到数据库中，下面为一个json示例
	// 注：数据库操作部分还未使用存储过程

	// jsonStr={"id":1,"wendu":27,"shidu":123,"shuifa":1,"qita":""}

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
		<td>水阀</td>
		<td>其他</td>
		
	</tr>
	<?php
		if (!empty($jsonData)){
			echo "<tr>
					<td>".$jsonData['id']."</td>
					<td>".$jsonData['wendu']."</td>
					<td>".$jsonData['shidu']."</td>
					<td>".$jsonData['shuifa']."</td>
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
				shuifa = '".$jsonData['shuifa']. "',"."
				qita = '".$jsonData['qita']."'
				where id=".$jsonData['id'];
			echo $sql;
			if (!$dbObj->exec($sql)) {
				echo $dbObj->lastErrorMsg();
			}else{
				echo $dbObj->changes();
			};
			$dbObj->close();
		}
	?>
</table>