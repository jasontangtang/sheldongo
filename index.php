<!DOCTYPE HTML>
<html>
	<head>
		<title>Jason [首页]</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-desktop.css" />
		<link rel="stylesheet" href="css/photopile.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	</head>
	<body>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<li><a href="#top">首页</a></li>
				<li><a href="#travel">行.游</a></li>
				<li><a href="#marathon">42.195</a></li>
				<li><a href="#stuff">玩物志</a></li>
			</ul>
		</nav>

		<!-- top -->
		<div class="wrapper wrapper-style3 wrapper-first">
			<article class="container" id="top">
				
				<div class="photopile-wrapper">
					<ul class="photopile">
					
					<?php
						include("php/core.php");
						$connect = getConnect();
						$sql = "select id, topimage from article"; 
						$result = mysql_query($sql,$connect); 
						while($row = mysql_fetch_row($result))
						{
							echo '<li>';
							echo '<a href="images/article/'.$row[0].'/'.$row[1].'" class="image image-top">';
							echo '<img src="images/article/'.$row[0].'/'.$row[1].'"/>';
							echo '</a></li>';
						}
					?>
					</ul>
				</div>
				
				<div class="row">
					<h1>Hi. I'm <strong>Jason</strong>.This is my Life</h1>
				</div>
				
			</article>
		</div>

		<!-- travel -->
		<div class="wrapper wrapper-style3">
			<article id="travel">
				<header>
					<h2>你问我要去向何方，我指着大海的方向。</h2>
				</header>
				<div class="container">
					<div class="row">
						<div class="12u">
						</div>
					</div>
					<div class="row">
					<?php
						$sql = "select id, title, topimage from article where catelogid=1 limit 8"; 
						$result = mysql_query($sql,$connect); 
						$resultNo = 8-mysql_num_rows($result);
						while($row = mysql_fetch_row($result))
						{
							echo '<div class="3u"><article class="box">';
							echo '<a href="article.php?id='.$row[0].'" target="_blank" class="image image-full"><img src="images/article/'.$row[0].'/'.$row[2].'"/></a>';
							echo $row[1];
							echo '</article></div>';
						}
						
						if($resultNo > 0)
						{
							for($i = 0; $i < $resultNo; $i++)
							{
								echo '<div class="3u"><article class="box">';
								echo '<a class="image image-full"><img src="images/travel.jpg"/></a>';
								echo '敬请期待...';
								echo '</article></div>';
							}
						}
					?>
					</div>
				</div>
			</article>
		</div>

		<!-- marathon -->
		<div class="wrapper wrapper-style3">
			<article id="marathon">
				<header>
					<h2>那些年，我们跑过的马。</h2>
				</header>
				<div class="container">
					<div class="row">
						<div class="12u">
						</div>
					</div>
					<div class="row">
					<?php
						$sql = "select id, title, topimage from article where catelogid=2 limit 8"; 
						$result = mysql_query($sql,$connect); 
						$resultNo = 8-mysql_num_rows($result);
						while($row = mysql_fetch_row($result))
						{
							echo '<div class="3u"><article class="box">';
							echo '<a href="article.php?id='.$row[0].'" target="_blank" class="image image-full"><img src="images/article/'.$row[0].'/'.$row[2].'"/></a>';
							echo $row[1];
							echo '</article></div>';
						}
						
						if($resultNo > 0)
						{
							for($i = 0; $i < $resultNo; $i++)
							{
								echo '<div class="3u"><article class="box">';
								echo '<a class="image image-full"><img src="images/42.195.jpg"/></a>';
								echo '敬请期待...';
								echo '</article></div>';
							}
						}
					?>
					</div>
				</div>
			</article>
		</div>
		
		<!-- stuff -->
		<div class="wrapper wrapper-style3">
			<article id="stuff">
				<header>
					<h2>玩物，不丧志。</h2>
				</header>
				<div class="container">
					<div class="row">
						<div class="12u">
						</div>
					</div>
					<div class="row">
					<?php
						$sql = "select id, title, topimage from article where catelogid=3 limit 8"; 
						$result = mysql_query($sql,$connect); 
						$resultNo = 8 - mysql_num_rows($result);
						while($row = mysql_fetch_row($result))
						{
							echo '<div class="3u"><article class="box">';
							echo '<a href="article.php?id='.$row[0].'" target="_blank" class="image image-full"><img src="images/article/'.$row[0].'/'.$row[2].'"/></a>';
							echo $row[1];
							echo '</article></div>';
						}
						
						if($resultNo > 0)
						{
							for($i = 0; $i < $resultNo; $i++)
							{
								echo '<div class="3u"><article class="box">';
								echo '<a class="image image-full"><img src="images/stuff.jpg"/></a>';
								echo '敬请期待';
								echo '</article></div>';
							}
						}
						mysql_close($connect);
					?>
					</div>
				</div>
			</article>
		</div>
	<?php include("include/bottom.php");?>
		
	<script src="js/jquery-ui-1.10.4.min.js"></script>
	<script src="js/photopile.js"></script>
	
</body>
</html>