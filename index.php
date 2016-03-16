<?php
	session_start();
	//包含数据库连接文件
	include('conn.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Medical Diagnosis System --- X Search Project</title>	
	<link rel="shortcut icon" href="images/icon.png"/>	
	
	<!-- <link href="http://www.dachuit.com/cssJS/dachuit_main.css" type="text/css" rel="stylesheet"/>     include CSS-->
	
	<meta http-equiv="content-type" content="text/html;charset=utf-8"> <!--    display Chinese -->
	
	 <meta content="width=device-width, initial-scale=1" name="viewport" />   <!-- fit the Cellphone and tablet-->
	
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
	//全局字体在CSS body{}里加入font-family: Verdana;
	body {
		font-family: Verdana;
		height:100%;
		margin:0;
		padding:0;
	}

	.header {
	  border: 0px dotted;  
	  text-align: left;
	  width: 900px;
	  height: 20px;
	  float: center;
	  opacity:1;
	  padding: 10px;
	}
	.header_right {
	  border: 0px dotted;  
	  text-align: center;
	  width: 300px;
	  height: 20px;
	  float: right;
	  color: black;
	}
	.header_right a:visited {
	    color: black;
	}
	.header_right a:link {
	    color: black;
	}
	.mainlogo {
	  border: 0px dotted;  
	  text-align: center;
	  width: 900px;
	  height: 200px;
	  float: center;
	  opacity:1;
	  padding: 10px;
	
	}
	
	.selection {
	  border: 0px dotted;  
	  text-align: center;
	  width: 900px;
	  height: 30px;
	  float: center;
	  opacity:1;
	  padding: 10px;
	
	}
	
	.searchbar {
	  border: 0px dotted;  
	  text-align: center;
	  width: 900px;
	  height: 60px;
	  float: center;
	  opacity:1;
	  padding: 10px;
	
	}
	
	.recommendation {
	  border: 0px dotted;  
	  text-align: center;
	  width: 900px;
	  height: 60px;
	  float: center;
	  opacity:1;
	  padding: 10px;
	
	}
	
	.result{
	  border: 0px dotted;  
	  text-align: center;
	  width: 900px;
	 overflow:hidden;

	  float: center;
	  opacity:1;
	  	  padding: 10px;

	}
	.result:after
	{
		content:".";
		display:block;
		clear:both;
		visibility:hidden;
	}
	.result_left{
	  border: 0px dotted;  
	  text-align: left;
	  width: 35%;
	  float: right;
	  opacity:1;
	
	}
	.result_right{
	  border: 0px dotted;  
	  text-align: left;
	  width: 64%;
	  float: right;
	  opacity:1;
	  height: auto;
	}
	
	
	
	.footer{
	  border: 0px dotted;  
	  text-align: center;
	  width: 900px;
	  height: 30px;
	  float: center;
	  color: black;
	  opacity:1;
	  padding: 10px;
	}
	.footer a:visited {
	    color:black;
	}
	.footer a:link {
	    color:black;
	}
	
	
	input[type="text"] {
	  display: block;
	  margin: 0;
	  width: 100%;
	  height:30px;
	  font-family: sans-serif;
	  font-size: 18px;
	
	}
	
	</style>
	
	<!--处理iframe 自动变换高度-->
	<script language="javascript" type="text/javascript">
	  function resizeIframe(obj) {
	    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	  }
</script>
	
</head>

<!-- Website Main Part-->
<body>
	<img id="background" src="images/doctor.jpg"  title=""> <!-- Background Image -->
	
	<center>
	
		<div class="header">
			<div class="header_right">
				<?php
					if(!isset($_SESSION['username'])){
					    echo 'Welcome, please <a href="login.php">Login</a> or <a href="reg.php">Register</a>';				
					}
					else{
						$username = $_SESSION['username'];
						echo '<a href="home.php" style= "text-decoration:none "><b>',$username, '</b></a>, welcome back <a href="home.php" style= "text-decoration:none "><b><u>Profile</u></a></a> or <a href="login.php?action=logout">Logout</a>'; 
					}   
				?>
				
			</div>
		</div>
		
		<div class="mainlogo"> <a href="index.php"><img src="images/mainlogo.png" width="460px"></img></a></div>
		
		<div class="selection">
		
			<form name="search" method="post" action="index.php" onSubmit="return InputCheck(this)">

				Result: <select name="resultlist" size="1"> 
				<option value="brief" selected>Brief Info
				<option value="listonly">List Only
				</select>
			
				Gender: <select name="gender" size="1"> 
				<option value="none" selected>N/A
				<option value="Male">Male
				<option value="Female">Female
				</select>
				
				Age: <select name="age" size="1"> 
				<option value="none" selected>N/A
				<option value="0_2">0-2
				<option value="3_6">3-6
				<option value="7_12">7-12
				<option value="13_17">13-17
				<option value="18_24">18-24
				<option value="25_34">25-34
				<option value="35_44">35-44
				<option value="45_54">45-54
				<option value="55_64">55-64
				<option value="65_65">Over 65
				</select>
				
				
				Race: <select name="race" size="1"> 
				<option value="N/A"  selected>N/A
				<option value="asian">Asian
				<option value="American">American
				<option value="African">African American
				<option value="Indians">Indians
				<option value="Latino">Hispanic&Latino
				<option value="other">Others
				</select>
				
				
				Position: <select name="position" size="1"> 
				<option value="All" selected>N/A
				
				<!--Abdomen-->
				<option value="Lower_Abdomen">Abdomen-Lower
				<option value="Upper_Abdomen">Abdomen-Upper
				
				<!--Arm-->
				<option value="Armpit">Arm-Armpit
				<option value="Elbow">Arm-Elbow
				<option value="Fingers">Arm-Fingers
				<option value="Forearm">Arm-Forearm
				<option value="Palm">Arm-Palm
				<option value="Shoulder">Arm-Shoulder
				<option value="Upper_arm">Arm-Upper Arm
				<option value="Wrist">Arm-Wrist
				
				<!--Back-->
				<option value="Back">Back
				<option value="Lower_Spine">Back-Lower Spine
				<option value="Upper_Spine">Back-Upper Spine
				
				<!--Buttock-->
				<option value="Buttock">Buttock
				<option value="Hip">Buttock-Hip
				
				<!--Chest-->
				<option value="Chest">Chest
				<option value="Lateral_Chest">Chest-Lateral
				<option value="Sternum">Chest-Sternum
				
				<!--Head-->
				<option value="Head">Head
				<option value="Ear">Head-Ear
				<option value="Eye">Head-Eye
				<option value="Face">Head-Face
				<option value="Jaw">Head-Jaw
				<option value="Mouth">Head-Mouth
				<option value="Nose">Head-Nose
				<option value="Scalp">Head-Scalp
				
				<!--Legs-->
				<option value="Ankle">Legs-Ankle
				<option value="Foot">Legs-Foot
				<option value="Knee">Legs-Knee
				<option value="Shin">Legs-Shin
				<option value="Thigh">Legs-Thigh
				<option value="Toes">Legs-Toes
				
				<!--Neck-->
				<option value="Neck">Neck
				
				
				<!--Pelvis-->
				<option value="Pelvis">Pelvis
				<option value="Genitals">Pelvis-Genitals
				<option value="Groin">Pelvis-Groin
				<option value="Hip">Pelvis-Hip			
				</select>
	
		</div>
		
		<div class="searchbar">
		
				<input type="text" name="input" autocomplete="off">
				<!--<input  name="submit" type="submit" value ="Search" />-->
			</form>
		</div>
		

		<div class="recommendation">
		
		
		<!--&gender=none&age=none&position=All-->
		
		Popular Search：
		   <a href="index.php?input=hard to eat&<?php $outlist= $_REQUEST["resultlist"]; echo "resultlist=".$outlist;   ?>"  style= "text-decoration:none ">hard to eat, </a>
		   <a href="index.php?input=cough"  style= "text-decoration:none ">cough, </a>
		   <a href="index.php?input=headache"  style= "text-decoration:none ">headache, </a>
		   <a href="index.php?input=can not see clearly" style= "text-decoration:none ">can not see clearly, </a>
		   <a href="index.php?input=fever"  style= "text-decoration:none ">fever, </a>
		   <a href="index.php?input=sleepy"  style= "text-decoration:none ">sleepy</a>
		<p>Note: input a query to describe your illness symptoms.</p>
		</div>
		
		<div class="result">


		<!--right first-->
		
		
			<div class="result_right">
<?php
	if(!isset($_POST['submit']) && ($_REQUEST["input"] == '')){
	exit('</div></div><div class="footer">
	[<a href="home.php" "><b>User Center</b></a>]
	[<a href="http://web.engr.illinois.edu/~jhan51/mdxsearch/crawler/" "><b>Health Forum Crawler</b></a>]  
	[<a href="https://github.com/imskyhan/MDXSearch/" "><b>GitHub</b></a>]  
	[<a href="BMI_Check.html" "><b>Health BMI Checker</b></a>] <br/>
	Advisor: <a href="http://web.engr.illinois.edu/~czhai/"  target="_blank" style= "text-decoration:none ">Professor Chengxiang Zhai</a>. <br/> 
	Copyright 2013-2015 Jinda Han @ TIMAN Group Version 0.7.0@May 28. All rights reserved. <a href="https://web.engr.illinois.edu/" target="_blank"  style= "text-decoration:none ">System. </a><a href="https://web.engr.illinois.edu/index.pl?jhan51" target="_blank"  style= "text-decoration:none ">Login</a></div></center></body>');
	}
	if($_REQUEST["input"] != ''){
        	$input = $_REQUEST["input"];
		$check = 1;
	}    
    	else{
		$input = '';
		$check = 0;
	}		
	$input1 = $_REQUEST["gender"];//gender
	if($input1 == "")
		$input1 = "N/A";
		
   	$input2 = $_REQUEST["age"];//age range
   	if($input2 == "")
		$input2 = "N/A";
		
   	$input3 = $_REQUEST["race"];// race
   	if($input3 == "")
		$input3 = "N/A";
		
   	$input4 = $_REQUEST["position"];//position
   	if($input4 == "")
		$input4 = "N/A";
		
   	$input5 = $_REQUEST["resultlist"];//Result list way simple or brief
								
	echo "<b>Gender: <font color='red' face='Verdana'><i>".$input1." </i></font>
    	Age range: <font color='red' face='Verdana'><i>".$input2." </i></font>
    	Diagnose position is: <font color='red' face='Verdana'><i>".$input4." </i></font></b><br/>";
    	echo "<b>The Query you ernter is: <font color='red' face='Verdana'><i>".$input." </i></font></b> <br/>";
?>
				<iframe src="blank.php" width="100%"   frameborder="0"  name="disease" onload='javascript:resizeIframe(this);'></iframe>
				
			</div>			
		
			<div class="result_left">
<?php
//list left
	if($input1 != '' || $input2 != '' || $input3 != '' || $input4 != ''){
		//echo "<b>Note: input a query to describe your illness symptoms.</b><br>";
	}
   	$username = $_SESSION['username'];
	$searchquery = $input;
	$time = date("Y/m/d h:i:s a");	
   		
   	//enter db
   	$sql = "INSERT INTO history (username, searchquery, gender,age, position,date ) VALUES ('$username', '$input', '$input1','$input2','$input4','$time')";
				if(mysql_query($sql,$conn)){
				    //exit('Register Successful! Click here to <a href="login.php">Login</a>');
				} else {
				    echo 'Sorry, add data error:line:34',mysql_error(),'<br />';
				    echo 'Click here <a href="javascript:history.back(-1);">Go back</a> Try again';
				}						
   		
   	 /*This is the search output shows what you input
   	 echo "<b>Gender: <font color='red' face='Verdana'><i>".$input1
    ."</i></font> <br/>Age range: <font color='red' face='Verdana'><i>".$input2."</i></font> <br/>Diagnose position is: <font color='red' face='Verdana'><i>".$input4."</i></font>.</b><br>";
    	echo "<b>The Query you ernter is: <font color='red' face='Verdana'><i>".$input."</i></font>.</b> <br>Note: The following results are filtered by WebMD disease Database.<br>";*/
	 if($input1==null && $input2==null && $input3==null && $input4==null && $input == null){
	   	echo "<br>None input</br>"; 
	  }
	 if($input4 == "All"){
	    	$input4 == "toallcondition";
	 }
			
	//replace input space to "_" !!! important !!!
    	$input = str_replace(' ', '_', $input);		
	//input value to java file #1
	exec("java -jar backend.jar '$input' 0",$output);	 
	 
	if($output[0]== null){
		echo "<br> Oops! We cannot diagnose your problem~";
	}
	
	
	$indexnum = 0;
	$haha = 0;
	
foreach($output as $item)
{
	
	$Temp=explode(" ", $item);
	//print_r($Temp);
	$handle=file_get_contents("./files/".$Temp[0]);
	//print_r($handle);
	//echo $Temp[0];
	$para = explode("\n", $handle);
	$title = explode(" ", $para[0]);//name of disease
	
	//判断是否有逗号（去file查一查如果有逗号看看后面是什么）
	if(strpos($title[1], ",")){
		//echo 'My name is '.$title[1];
		$title[1] = substr($title[1], 0, -1);//如果有，， 显示从0开始到倒数第二个
		//$title[1] ＝ str_replace(",", "", "$title[1]" );//如果有，， 替换为空，在$title[1]里
	}
		
	//*****very useful veribale checker*****
	//echo "<center>---------------<b><i> " ;
	//echo "<i>".$title[1]."</i> is filtering";//yeahhhhhh this is the one i am looking for
	//echo " </b></i>----------------<br></center>" ;
	
	$TF = 1;//initial a check condition, can be get the return of a jar
	//here check condition either using jar search or php search the txt file
	
	/* $file = 'webmd/test.txt';
	//$searchfor = '$title[1]';
	
	$searchfor = strtolower($title[1]);
	
	// get the file contents, assuming the file to be readable (and exist)
	$contents = file_get_contents($file);
	echo $contects;
	// escape special characters in the query
	$pattern = preg_quote($searchfor, '/');
	// finalise the regular expression, matching the whole line
	$pattern = "/^.*$pattern.*\$/m";
	// search, and store all matching occurences in $matches
	if(preg_match_all($pattern, $contents, $matches)){
  	 echo "Found matches:\n";
   	echo implode("\n", $matches[0]);
   	$TF = 1;
	}
	else{
  	 echo "No matches found";
  	 $TF = 0;
	}
	//location adjustment for 2nd variable
	*/
	
	//------------using jar
	
	//echo "The name of disease in filtering is: ".$title[1]."<br>";

	unset($filterout);
	exec("java -jar filter.jar $title[1] $input4",$filterout,$returncode);
	
	
	//*****!!!very useful test******
	//echo "Output is: ".$filterout[0]."<br>".$filterout[1]."<br>".$filterout[3]."<br>".$filterout[4]."<br>";
	
	
	//exec("java -jar hello.jar ",$filterout1);
	//echo "Output is: ".$filterout1[0];

	//$TF = $output;
	//if($output == 0)
	//	echo "No matches found";
	
	//-----------------
	
	//readfrom existoutput.txt
	//$TF = 
	
	$booleanout = " ";
	$handle = fopen("existoutput.txt", "r");
	$Data = fread($handle, filesize("existoutput.txt"));
	if($Data==0)
		{$booleanout = "Not Matched!";	}	
	else
		{$booleanout = "Matched!";}
		
	//********very useful boolean checker********	
	//echo "Boolean Condition: Disease ".$booleanout;//可以读取jar出来的existoutput.txt了
	//echo "<br>";
	//echo $hong;

	//-------------
	$TF = $Data;
	if($TF == 1){
		$indexnum++;//output标号
		//strpos可以判断input是否存在“，”＊＊＊＊＊＊＊＊＊＊＊＊＊＊
		
		//echo '<a href="files/'.$Temp[0].'"><font face="Verdana"><b>'.$indexnum.'. '.$title[1].'</b></font></a><br>';
		echo '<a  style= "text-decoration:none " target="disease" href="disease.php?inputquery ='.$input.'&input='.$Temp[0].'&searchquery='.$searchquery.'"><font face="Verdana"><b>'.$indexnum.'. '.$title[1].'</b></font></a>';
		
		$para1 = explode(":", $para[1]);//Definition
		$para2 = explode(":", $para[2]);//diag
		$para3 = explode(":", $para[3]);//Symptoms and Signs
		$para4 = explode(":", $para[4]);//Causes
		//每一次验证一下第一个单词，
		//根据form input的value选取目录和文件，用php search吧
	//php search txt file?
		
		//echo $input5."这是什么？";
		
		if($input5 != "listonly"){//此判断区分biref info 还是 list only
			if($para1[0] == "Symptoms and Signs"){
				echo "<br/><font color='red' face='Verdana'><b></b></font>".$para1[1]." ";
			}
			else if($para2[0] == "Symptoms and Signs"){
				echo "<br/><font color='red' face='Verdana'><b></b></font>".$para2[1]." ";
			}
			else if($para3[0] == "Symptoms and Signs"){
				echo "<br/><font color='red' face='Verdana'><b></b></font>".$para3[1]." ";
			
			}
			else if($para4[0] == "Symptoms and Signs"){
				echo "<br/><font color='red' face='Verdana'><b></b></font>".$para4[1]." ";
			}
			
			
			/*echo "<font color='red' face='Verdana'><b>".$para1[0]."</b></font>".$para1[1]."<br>
			<font color='red' face='Verdana'><b>".$para2[0]."</b></font>".$para2[1]."<br>
			<font color='red' face='Verdana'><b>".$para3[0]."</b></font>".$para3[1]."<br>
			<font color='red' face='Verdana'><b>".$para4[0]."</b></font>".$para4[1]."<br>";
			*/
			//echo '<font face="Verdana">'.$handle.'</font>';
			else{
				echo "<br/><font color='red' face='Verdana'><b></b></font>".$para1[1]." ";//什么都没有，空集 还是print第一个呢？
			}
			echo '<a  style= "text-decoration:none " target="disease" href="disease.php?inputquery='.$input.'&input='.$Temp[0].'&searchquery='.$searchquery.'"><font color="red" > (Learn more→)</font></a><br/><br/>';				
		}
		
		else{
			echo '<a  style= "text-decoration:none " target="disease" href="disease.php?inputquery='.$input.'&input='.$Temp[0].'&searchquery='.$searchquery.'"><font color="red" > </font></a><br/>';	
		}
	}
	
	
	else{
		echo '<a  style= "text-decoration:none " target="disease" href="disease.php?inputquery='.$input.'&input='.$Temp[0].'&searchquery='.$searchquery.'"><font color="orange"><b><i>',$title[1],'</font></a> is not matched.</i></b><br>';
	}
	
}
			
?>
			</div>
			

		</div>
	
		<div class="footer">Advisor: <a href="http://web.engr.illinois.edu/~czhai/"  target="_blank" style= "text-decoration:none ">Professor Chengxiang Zhai</a>. <br/> 
		Copyright 2013-2015 Jinda Han @ TIMAN Group Version 0.7.0@May 28. All rights reserved. <a href="https://web.engr.illinois.edu/"  target="_blank" style= "text-decoration:none ">System. </a><a href="https://web.engr.illinois.edu/index.pl?jhan51"  target="_blank" style= "text-decoration:none ">Login</a></div>

	</center>
	
	
</body>
</html>