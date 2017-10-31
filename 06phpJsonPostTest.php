<?php
	// 这个php对收到的json字符串做解析，并显示在web界面，下面为一个POST数据示例
	
	// jsonStr=[{"id":0,"key":"url","value":"http:\/\/baidu.com"},{"id":1,"key":"URL","value":"http:\/\/bilibili.com"},{"id":3,"key":"text","value":"this is a text record."},{"id":4,"key":"URL","value":"http:\/\/google.com"},{"id":5,"key":"text","value":"test 5"}] 
	header("Content-Type:text/html;   charset=utf-8"); 

	$jsonStr 	= $_POST[jsonStr];
	echo 'POST方法接收到的原始数据：<br>' . $jsonStr . '<br><br>';
	echo 'Json数据本地解析取得的变量结果：<br>';
	$jsonData	= json_decode($jsonStr, true);
?>
<table border="1" width="300">
	<tr>
		<td>id</td>
		<td>key</td>
		<td>val</td>
	</tr>
	<?php
		if (!empty($jsonData)){		// 空json不做处理
			foreach ($jsonData as $eachRow) {
				echo "<tr><td>".$eachRow['id']."</td><td>".$eachRow['key']."</td><td>".$eachRow['value']."</td></tr>";
			}
		}
		
	?>
</table>