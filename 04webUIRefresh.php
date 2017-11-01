
<!-- 这个页面至此已经实现了用js让页面定时刷新的功能，页面内容为数据库中的传感器数值 -->

<html>
<head>
	<title>WEB UI REFRESH TEST</title>
	<meta charset="utf-8">
</head>
<body>
	WEB UI REFRESH TEST<br>

	<!-- <hr width="300" align="left">
	<table border="1" width="300">
		<tr>
			<td>id</td>
			<td>key</td>
			<td>val</td>
		</tr>
		<?php
			$DB_NAME = "test01.db";
			$dbObj = new SQLite3($DB_NAME);
			$queObj = $dbObj->query("select * from test1");
			while ($eachRow = $queObj->fetchArray(SQLITE3_ASSOC)) {
				echo "<tr>
						<td>".$eachRow['id']."</td>
						<td>".$eachRow['key']."</td>
						<td>".$eachRow['value']."</td>
					</tr>";
			}
			$dbObj->close();
		?>
	</table>
	 -->
	<br>
	传感器数据
	<hr width="300" align="left">
	<table border="1" width="300">
		<tr>
		<td>id</td>
		<td>温度</td>
		<td>湿度</td>
		<td>水阀</td>
		<td>其他</td>
		
	</tr>
		<?php
			$DB_NAME = "test01.db";
			$dbObj = new SQLite3($DB_NAME);
			$queObj = $dbObj->query("select * from chuanGanQi");
			while ($eachRow = $queObj->fetchArray(SQLITE3_ASSOC)) {
				echo "<tr>
					<td>".$eachRow['id']."</td>
					<td>".$eachRow['wendu']."</td>
					<td>".$eachRow['shidu']."</td>
					<td>".$eachRow['shuifa']."</td>
					<td>".$eachRow['qita']."</td>
				</tr>";
			}
			$dbObj->close();
		?>
	</table>

	<script language="JavaScript">
		function myrefresh(){
		window.location.reload();
		}
		setTimeout('myrefresh()',1000); //指定1秒刷新一次
	</script>
</body>
</html>
