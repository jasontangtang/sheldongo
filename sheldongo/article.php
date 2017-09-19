<!DOCTYPE HTML>
<html>
	<head>
		<?php
			include("php/core.php");
			$connect = getConnect();
			if( isset($_GET['id']) )
			{
				$sql = "select title from article where id=" . $_GET['id']; 
				$result = mysql_query($sql,$connect); 
				if(mysql_num_rows($result)==0)
				{
					echo '<title>Oops, 404....</title>';
				}
				else
				{
					$row = mysql_fetch_row($result);
					echo '<title>'.$row[0].'</title>';
				}
			}
			else
			{
				echo '<title>Oops, 404....</title>';
			}
		
		?>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-desktop.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
	
		<nav id="nav">
			<ul>
				<li><a href="index.php">首页</a></li>
				<li><a target="_blank" href="navigate.php?type=1">行.游</a></li>
				<li><a target="_blank" href="navigate.php?type=2">42.195</a></li>
				<li><a target="_blank" href="navigate.php?type=3">玩物志</a></li>
			</ul>
		</nav>
		
		<div class="wrapper-article">
		
			<?php
			if( isset($_GET['id']) )
			{
				$sql = "select title, dotime, content, ispublished from article where id=" . $_GET['id']; 
				$result = mysql_query($sql,$connect); 
				$row = mysql_fetch_row($result);
				if($row)
				{
					echo '<table><tr><td><div class="article-title">';
					echo 	'<h3>'.$row[0].'</h3></td</tr>';
					echo 	'<tr><td><div class="article-date">';
					echo 		$row[1];
					echo 	'</div></td</tr>';
					echo 	'<div class="article-dash"></div>';
					echo '</div>';
					echo '<tr><td><div class="article-body">';
					echo 	str_replace("#articleid#","images/article/".$_GET['id'],$row[2]);
					echo '</div></td</tr></table>';
					$HeaderInfo['Title'] = "dsfa";
				}
				else
				{
					echo '<div class="article-noarticle">';
					echo 	'<p>Oops, 404 is what I can offer ... :(  </p>';
					echo '</div>';
					echo '</div><div id="footer">&copy; Copyright &copy; 2015. All rights reserved.</div>';
					die();
				}
			}
			else
			{
				echo '<div class="article-noarticle">';
				echo 	'<p>Oops, 404 is what I can offer ... :(  </p>';
				echo '</div>';
				echo '</div><div id="footer">&copy; Copyright &copy; 2015. All rights reserved.</div>';
				die();
			}
			?>
			
			<div class="article-dash"/></div>
		
			<?php
			if( isset($_GET['id']) )
			{
				$sql = "select id, username, commenttime, message from comment where articleid=".$_GET['id']." and fatherid=0"; 
				$result = mysql_query($sql,$connect); 
				$level = 0;
				if(mysql_num_rows($result)==0)
				{
					echo '<div class="message-nomessage">';
					echo 	'沙发，虚位以待...';
					echo '</div>';
				}
				else
				{
					echo '<div  class="wrapper-message"><table>';
					while($row = mysql_fetch_row($result))
					{
						$level++;
						echo '<tr style="color:#885500"><td>['.$level.'楼] 发表人：'.$row[1].'</td>';
						echo '<td>&nbsp&nbsp&nbsp&nbsp&nbsp发表时间：'.date('Y-m-d H:i',strtotime($row[2])).'</td></tr>';
						echo '<tr style="color:#000000"><td colspan="2">'.$row[3].'</td></tr>';
						$sql = "select id, username, message from comment where articleid=".$_GET['id']." and fatherid=".$row[0]; 
						$subresult = mysql_query($sql,$connect);
						while($subrow = mysql_fetch_row($subresult))
						{
							echo '<tr><td style="color:#00aa55">&nbsp&nbsp'.$subrow[1].'：'.$subrow[2].'</td></tr>';
						}
						echo '<tr><td>&nbsp</td></tr>';
					}
					echo '</table></div>';
				}
			}
		
			mysql_close($connect);
			?>
		
			<div class="article-dash"/></div>
			
			<div>
				<form method="post">
					<input type="text" name="name" placeholder="姓名" />
					<textarea rows="5" name="message" placeholder="留言"></textarea>
					<span style="display:block; text-align:center"><input type="submit" name="submit" value="提交"/>
				</form>
			</div>
			
		</div>			
			
		<?php
		if(isset($_POST['submit']))
		{
			$connect = getConnect();
			
			if(empty($_POST['name'])) die();
			if(empty($_POST['message'])) die();
			
			mysql_real_escape_string($_POST['name']);
			mysql_real_escape_string($_POST['message']);
			
			date_default_timezone_set('Asia/Shanghai');
			$datetime = date('Y-m-d H:i:s');
			
			$query = "insert into comment(articleid,username,commenttime,message) value('" 
				.$_GET['id']."','"
				.$_POST['name']."','"
				.$datetime."','"
				.$_POST['message']."')";

			$result = mysql_query($query) or die("Error in query: $query. ".mysql_error());

			mysql_close($connect);
			
			echo '<script language=JavaScript>location.replace(location.href);</script>';
		}	
		?>
		
		<?php include("include/bottom.php");?>
		
	</body>
</html>