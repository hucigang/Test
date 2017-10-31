<!-- 此为web界面显示SQL操作结果表单的一个测试 -->

WEB UI SQL TEST<br>

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
			echo "<tr><td>".$eachRow['id']."</td><td>".$eachRow['key']."</td><td>".$eachRow['value']."</td></tr>";
		}
	?>
</table>
