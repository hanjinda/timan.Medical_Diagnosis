<?php
	session_start();
	//包含数据库连接文件
	include('conn.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title> </title>
	
	<!-- <link rel="shortcut icon" href="pic/ico.jpg"/>	icon -->
	<link rel="shortcut icon" href="images/icon.png"/>	
	<!-- <link href="http://www.dachuit.com/cssJS/dachuit_main.css" type="text/css" rel="stylesheet"/>     include CSS-->
	
	<meta http-equiv="content-type" content="text/html;charset=utf-8"> <!--    display Chinese -->
	
	<!-- <meta content="width=device-width, initial-scale=1" name="viewport" />    fit the Cellphone and tablet-->
	
	<!-- CSS Add in-->
	<style type="text/css">  
	#background{
		position:absolute; 
		top:0;
		left:0;
		z-index:-1; 
		width:100%; 
		height:100%;

	}	
	body {
		height:100%;
		margin:0;
		padding:0;
	}
	table {
    border-collapse: collapse;
}
	
	</style>
	
	
	

</head>

<!-- Website Main Part-->
<body>
	<!-- <img id="background" src="images/doctor.jpg"  title=""> Background Image -->	
	<center>
	</center>
	<div class="main">
	

<?php
	if($_REQUEST["input"] != ''){
        	$input = $_REQUEST["input"];
        	//echo $input.'haha!~~~';//验证input来的是disease的序列号
		$check = 1;
	}    
    	else{
		$input = '';
		$check = 0;
	}
	

	
	//echo 'Index Number is: '.$input.'<br>';
	
		$Temp=explode(" ", $input);
		//print_r($Temp);
		$handle=file_get_contents("./files/".$Temp[0]);
		//print_r($handle);
		//echo $Temp[0];
		$para = explode("\n", $handle);
		$title = explode(" ", $para[0]);//name of disease 的名字
	
	if(strpos($title[1], ",")){
		//echo 'My name real is '.$title[1];//输出原来的disease name，所以判定name是$title[1]，然是传入的还是需要input的
		$title[1] = substr($title[1], 0, -1);//如果有逗号‘，’， 显示从0开始到倒数第二个
	}
		
		//此地处理input query
		$search_query = $_POST["searchquery"];
				//echo $search_query.'hhahahhahahhahah';
				
		$inputquery_this = $_REQUEST["inputquery"];
	  	  
	  
	
	
		//origin
		echo '<br><a style= "text-decoration:none " href="files/'.$Temp[0].'"><font face="Verdana" size="6" color="orange"><b>'.$title[1].'</b></font></a><br><br/>';		
		
		echo '<a target="_blank" href="http://en.wikipedia.org/wiki/'.$title[1].'">Wikipedia: '.$title[1].' </a> ';
		
		
		//echo "<a href='disease.php?saveit=true'>[Save it]</a><br/>";
		
		
		//echo "<a href='disease.php?inaccuracy=true'>[Inaccuracy]</a><br/>";
	
		
		echo '<br><br>';
		
		//echo '<a  target="search_helper" href="search_helper.php?input='.$Temp[0].'"><font face="Verdana"><b>'.$indexnum.'. '.$title[1].'</b></font></a><br>';
		$para1 = explode(":", $para[1]);
		$para2 = explode(":", $para[2]);
		$para3 = explode(":", $para[3]);
		$para4 = explode(":", $para[4]);
		//每一次验证一下第一个单词，
		//根据form input的value选取目录和文件，用php search吧
	
	 	//echo "把所有的爱";//此处以下为print 所有这个病症的信息
		echo "<font color='black' face='Verdana'><b>".$para3[0]."</b></font><br>".$para3[1]."<br><br> 
		<font color='black' face='Verdana'><b>".$para2[0]."</b></font><br>".$para2[1]."<br><br> 
		<font color='black' face='Verdana'><b>".$para4[0]."</b></font><br>".$para4[1]."<br><br>     
		<font color='black' face='Verdana'><b>".$para1[0]."</b></font><br>".$para1[1]."<br> ";
		echo "<br>";
		
		//adding comment 留言板
		$dis =  $title[1];
		$username = $_SESSION['username'];
		$regdate = date("Y/m/d h:i:s a");
		
		
		if($_POST['submit']){//？？？？？？？？？？？？这个数据库有问题，前面query传入之后，数据库需要增加query选项，然后更改

			$sql="INSERT INTO disease_comment(username,disease,comment,date) VALUES('$username','$title[1]','$_POST[content]','$regdate' )";
									
			if(mysql_query($sql)){
				echo '<font color="red">Comments Send Successfull!</font><br>';
				//echo $title[1];
				//echo "<script> window.location.replace('index.php') </script>";//another way to forward
			}
			else{
				echo "Please login";
				//echo "<script> window.location.replace('index.php') </script>";//another way to forward

			}
		}

					
		if($_POST['saveit']){
			//echo 'saveit';
			$sql="INSERT INTO disease_save(username,disease,date) VALUES('$username','$title[1]','$regdate' )";
									
			if(mysql_query($sql)){
				echo '<font color="red">Save to list Successfull!</font><br>';
				//echo $title[1];
				//echo "<script> window.location.replace('index.php') </script>";//another way to forward
			}
			else{
				echo "Please login";
				//echo "<script> window.location.replace('index.php') </script>";//another way to forward
			}
		}	
		
		
		
		if($_POST['inaccuracy']){
			//echo 'saveit';
			$sql="INSERT INTO disease_match(username,disease,date) VALUES('$username','$title[1]','$regdate' )";
									
			if(mysql_query($sql)){
				echo '<font color="red">Save to list Successfull!</font><br>';
				//echo $title[1];
				//echo "<script> window.location.replace('index.php') </script>";//another way to forward				
			}
			else{
				echo "Please login";
				//echo "<script> window.location.replace('index.php') </script>";//another way to forward
			}
		}	
				
		
		
		
			
		//display comment
		$num = 1;
		$comments_usr = mysql_query("SELECT username FROM disease_comment WHERE disease = '$title[1]'");
		$comments = mysql_query("SELECT comment FROM disease_comment WHERE disease = '$title[1]'");
		$comments_date = mysql_query("SELECT date FROM disease_comment WHERE disease = '$title[1]'");
		$first = 1;
				
		while ($row_comments_usr = mysql_fetch_row($comments_usr, MYSQL_NUM)){
		
			if($first==1){//如果是第一次
				//echo 'input query is:'.$inputquery_this.'</br>';//此地显示inputquery 作为test用
				echo '<font color="black" face="Verdana"><b>Comments</b></font>';
				echo '<table border="1" >';
				echo '<tr><td bgcolor="#FFCC80">Username</td>   <td bgcolor="#FFCC80">Comments</td>  <td bgcolor="#FFCC80">Input Query</td>  
				<td bgcolor="#FFCC80">Date</td></tr> <tr>';
				$first =2;	
			}
			else//if first = 2，其他行
				echo '<tr>';
			
			echo '<td align="left"  width="200" height="10"><p>
			<a href="#" target="_blank" style= "text-decoration:none "></a>'.$row_comments_usr[0].'<a href="home.php" target="_blank" style= "text-decoration:none "><font color="blue"> [Contact]</font></a></p></td>';
						
			$row_comments = mysql_fetch_row($comments);
			echo '<td align="left"  width="250" height="10"><p>
			<a href="#" target="_blank" style= "text-decoration:none "></a>'.$row_comments[0].'<a href="#" style= "text-decoration:none "><font color="blue">  [reply]</font></a></p></td>';

			//以后是input query，现在先这样
			$row_comments = mysql_fetch_row($comments);
			echo '<td align="left"  width="200" height="10"><p>
			<a href="#" target="_blank" style= "text-decoration:none "></a> temp </p></td>';


			$row_comments_date = mysql_fetch_row($comments_date);
			echo '<td align="left"  width="150" height="10"><p>
			<a href="#" target="_blank" style= "text-decoration:none "></a>'.$row_comments_date[0].'</p></td>';
						
																		
			$num ++;
			echo'</tr>';
		}
		echo '</table>';
		
		echo "<br/><font  color='black' face='Verdana'><b>Leave Message</b></font>";
		echo "";
?>
	</div>
	
	<div class="rest">
	
	<form action="disease.php?input=<?php echo $input; ?>&submit=<?php echo $title[1];  ?>" method="post">
		<textarea name="content" rows="6" cols="60" autofocus ></textarea><br />
		<input type="submit" name="submit" value="Post Comments" />
	
	</form> 
	
	
	<form  action="disease.php?input=<?php echo $input; ?>&saveit=<?php echo $title[1];  ?>" method="post">
		<input type="submit" name="saveit" value="Save Disease" />
	</form> 
	
	<form  action="disease.php?input=<?php echo $input; ?>&inaccuracy=<?php echo $title[1];  ?>" method="post">
		<input type="submit" name="inaccuracy" value="I think Result is inaccuracy!" />
	</form> 	
	
	
	
	
	
	</div>
	
	
	
</body>


<!-- JavaScript Add in-->
<script type="text/javascript"> 
	function InputCheck(LoginForm)
	{
	  if (LoginForm.username.value == "")
	  {
	    alert("Please type user name!");
	    LoginForm.username.focus();
	    return (false);
	  }
	  if (LoginForm.password.value == "")
	  {
	    alert("Plase type the password!");
	    LoginForm.password.focus();
	    return (false);
	  }
	}
</script> 





</html>