<?php
	// 此处为php语言下的SQLite数据库操作测试，后期不会使用SQLite，此处只是为了单机环境下的测试，为了性能还是应该使用MySQL之类的数据库，
	// 考虑到后面可以使用到的特性（访问控制，存储过程）
        // kkjkj

	print "hello <br>";
	$dbname = "test01.db";
	echo "dbname: " . $dbname . '<br>';
	$db = new SQLite3($dbname);							// 连接数据库
	$res = $db->query("select * from test1");
	// fetch result
	while ($row = $res->fetchArray(SQLITE3_ASSOC)) {	// 迭代查询结果并显示在表格里
		if ( strtolower($row['key']) == 'url' ) {
			echo "URL: <a href=" . $row['value'] . ">" . $row['value'] . "</a><br>";
		} elseif (strtolower($row['key'] == 'text')) {
			echo "TEXT: <b>" . $row['value'] . "</b><br>";
		} else {
			var_dump($row);
		}
	}
?>
