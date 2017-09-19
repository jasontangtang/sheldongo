<!DOCTYPE HTML>
<html>
	<head>
		<title>发表文章</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/style-desktop.css" rel="stylesheet">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
	
	<nav id="nav">
		<ul>
			<li><a href="#">发表文章</a></li>
		</ul>
	</nav>
	
	<div class="wrapper-article">
		<form action="" method="post">
			标题: <input type="text" size="100" name="title" /><br/>
			时间: <input type="text" size="50" name="dotime" /><br/>
			分类: <select name="catelogid" id="catelogid" />
				<option value="1">行.游</option>
				<option value="2">42.195</option>
				<option value="3">玩物志</option>
			</select><br/>
			图片: <input type="text" size="20" name="topimage" /><br/>
			简介: <textarea cols="50" rows="3" name="summary"/></textarea><br/>
			内容: <textarea cols="50" rows="18" name="content"/></textarea><br/>
			<span style="display:block; text-align:center"><input type="submit" name="submit" value="提交" /></span>
		</form>
	
<?php
	if(isset($_POST['submit']))
    {
		if(empty($_POST['title'])) die("请输入标题 ...");
		if(empty($_POST['dotime'])) die("请输入时间 ...");
		if(empty($_POST['topimage'])) die("请输入图片 ...");
		if(empty($_POST['summary'])) die("请输入简介 ...");
		if(empty($_POST['content'])) die("请输入内容 ...");
		
		include("../php/core.php");
		$connect = getConnect();
		
		mysql_real_escape_string($_POST['title']);
		mysql_real_escape_string($_POST['dotime']);
		mysql_real_escape_string($_POST['topimage']);
		mysql_real_escape_string($_POST['summary']);
		mysql_real_escape_string($_POST['content']);
		
		date_default_timezone_set('Asia/Shanghai');
		$datetime = date('Y-m-d H:i:s');
		
		
        $query = "insert into article(catelogid,title,dotime,createtime,topimage,summary,content,ispublished) value('" 
			. $_POST['catelogid'] . "','"
			. $_POST['title'] . "','"
			. $_POST['dotime'] . "','"
			. $datetime . "','"
			. $_POST['topimage'] . "','"
			. $_POST['summary'] . "','"
			. $_POST['content'] . "','1')";

        $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());

		
		echo '发布文章成功！<br>';
		echo 'Article ID: <a href="../article.php?id=' . mysql_insert_id() .'" target="_blank">' . mysql_insert_id() . '</a>';
		
        mysql_close($connect);
	}	
?>

	</div>

	<div id="footer">
		&copy; Copyright &copy; 2015. All rights reserved.
	</div>
		
	</body>
</html>