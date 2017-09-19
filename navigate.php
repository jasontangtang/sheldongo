<!DOCTYPE HTML>
<html>
	<head>
		<title>导航 [
		<?php
			switch ($_GET['type'])
			{
				case 1:
				  echo "行.游";
				  break;
				case 2:
				  echo "42.195";
				  break;
				case 3:
				  echo "玩物志";
				  break;
				default:
				  echo "导航";
			}
		?>
		]</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-desktop.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
	
		<nav id="nav">
			<ul>
				<li><a href="index.php">首页</a></li>
				<li><a href="navigate.php?type=1">行.游</a></li>
				<li><a href="navigate.php?type=2">42.195</a></li>
				<li><a href="navigate.php?type=3">玩物志</a></li>
			</ul>
		</nav>
		
		<div class="navigate-row">
		
		<?php
			include("php/core.php");
			$connect = getConnect();
			if( isset($_GET['type']) )
			{
				$sql = "select id, title, dotime, topimage, summary from article where catelogid=" . $_GET['type']; 
				$result = mysql_query($sql,$connect); 
				if(mysql_num_rows($result)==0)
				{
					echo '<div class="article-noarticle">';
					echo 	'<p>Oops, 404 is what I can offer ... :(  </p>';
					echo '</div>';
				}
				else
				{
					while($row = mysql_fetch_row($result))
					{
						echo '<table><tr><td>';
						echo '<a href="article.php?id='.$row[0].'" target="_blank"><img class="navigate-image" src="images/article/'.$row[0].'/'.$row[3].'"/></a>';
						echo '</td>';
						echo '<td valign=bottom><div class="navigate-title">';
						echo $row[1].'('.$row[2].')';
						echo '</div><div class="navigate-summary">';
						echo $row[4];
						echo '</div></td></tr></table><div class="navigate-dash"></div>';
					}
				}
			}
			else
			{
				echo '<div class="article-noarticle">';
				echo 	'<p>Oops, 404 is what I can offer ... :(  </p>';
				echo '</div>';
			}
			mysql_close($connect);
		?>
		</div>
		
		<?php include("include/bottom.php");?>
		
	</body>
</html>