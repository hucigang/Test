<!-- 演示用 -->
<!-- web界面的可视核心部分 -->

<html>
<head>
	<title>WEB UI REFRESH TEST</title>
	<meta charset="utf-8">
	<script type="text/javascript">
	// js功能部分，作用：对本页面的所有按钮的动作做出定义
	function ajaxSend(op, clientid, shuifa)
	{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
	    }
	  }
	// 判断按钮的用途
	if (op == 'clearjob') {
		// 清除任务队列
		xmlhttp.open("POST","./14phpClearJobList.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send();
	}
	else
	if (op == 'jobSend') {
		// 上传新任务
		controData={'clientid':clientid, 'shuifa':shuifa};
		jsonStr='jsonStr='+JSON.stringify(controData);
		// alert(jsonStr);
		xmlhttp.open("POST","./12phpJobUploadTest.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(jsonStr);
	};
	}
	</script>
</head>
<body>
	WEB UI REFRESH TEST<br><div id="myDiv"></div>

	<br>
	传感器数据
	<hr width="400" align="left">
	<table border="1" width="400">
		<tr>
		<td>id</td>
		<td>温度</td>
		<td>湿度</td>
		<td>CO2</td>
		<td>水阀</td>
		<td>风扇</td>
		<td>其他</td>
		<td>水阀控制</td>
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
					<td>".$eachRow['co2']."</td>
					<td>".$eachRow['shuifa']."</td>
					<td>".$eachRow['fengshan']."</td>
					<td>".$eachRow['qita']."</td>
					<td><button onclick=\"ajaxSend('jobSend',".$eachRow['id'].",'1')\">ON</button>
						<button onclick=\"ajaxSend('jobSend',".$eachRow['id'].",'0')\">OFF</button></td>
				</tr>";
			}
			$dbObj->close();
		?>
	</table>

	<br>
	任务队列信息
	<button onclick="ajaxSend('clearjob')">清除</button>
	<br>任务总数：
	<?php 	$DB_NAME = "test01.db";
		$dbObj = new SQLite3($DB_NAME);
		$row =  $dbObj->query("select * from sys_stat where key='jobcount'")->
				fetchArray(SQLITE3_ASSOC);
		echo $row["value"];?>
	<hr width="400" align="left">
	<table border="1" width="400">
		<tr>
		<td>任务ID</td>
		<td>传感器ID</td>
		<td>任务Json</td>
		<td>任务状态</td>
	</tr>
		<?php
			$queObj = $dbObj->query("select * from jobstates");
			while ($eachRow = $queObj->fetchArray(SQLITE3_ASSOC)) {
				echo "<tr>
					<td>".$eachRow['jobid']."</td>
					<td>".$eachRow['clientid']."</td>
					<td>".$eachRow['jobJson']."</td>
					<td>".$eachRow['jobstate']."</td>
				</tr>";
			}
			$dbObj->close();
		?>
	</table>

	<script language="JavaScript">
		function myrefresh(){
		window.location.reload();
		}
		setTimeout('myrefresh()',5000); //指定1秒刷新一次
	</script>
</body>
</html>
