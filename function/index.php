<?php

 function numbers_only($value)
{
    return preg_match('/^([0-9]*)$/', $value);
}
function getTopGuild($top)
{
	$sum = 0;
	$query = mssql_query("SELECT Top $top *FROM Guild ORDER BY G_Score DESC");
	echo "<table style='color:#fff;' align=center width=350px>
	<tr valign=top>
	<td><center>ניצחונות</td>
	<td><center>שחקנים</td>
	<td><center>מנהל</td>
	<td><center>כינוי</td>
	<td><center>#</td>";
	while($row = mssql_fetch_array($query))
	{
		$sum++;
		echo "<tr valign=top><td><center>",$row['G_Score'],"</td><td><center>",$row['G_Count'],"</td><td><center>",$row['G_Master'],"</td><td><center>",$row['G_Name'],"</td><td><center>",$sum,"</td></tr>";
	}
	echo "</table>";
}
function GuildBox($top)
{
	$sum = 0;
	$query = mssql_query("SELECT Top $top *FROM Guild ORDER BY G_Score DESC");
	echo "
	<tr valign=top>
	<td><center>ניצחונות</td>
	<td><center>כינוי</td>
	<td><center>#</td>";
	while($row = mssql_fetch_array($query))
	{
		$sum++;
		echo "<tr valign=top><td><center>",$row['G_Score'],"</td><td><center>",$row['G_Name'],"</td><td><center>.",$sum,"</td></tr>";
	}
	echo "</table>";
}

function CheckSessionMenu($username,$password)
{
	if($username == null or $password == null)
	{
		return 0;
	}
	if($md5 ==1)
	{
$check1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and  memb__pwd = dbo.fn_md5('$password','$username')");
$check1 = mssql_num_rows($check1);
if($check1 ==1)
{
return 1;
}
}
else
{
	$check1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and memb__pwd='$password'");
$check1 = mssql_num_rows($check1);
if($check1 ==1)
{
return 1;
}
}
}

function Register($memb___id,$pwd,$pwd1,$email,$code,$cap,$md5)
{
	$checkphone = numbers_only($code);
$a = mssql_query("Select *from MEMB_INFO WHERE memb___id = '$memb___id'");
$a = mssql_fetch_array($a);
$CheckName = mssql_query ("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$memb___id'");
	$CheckName = mssql_num_rows ($CheckName);
	$CheckName1 = mssql_query ("SELECT mail_addr FROM MEMB_INFO WHERE mail_addr='$email'");
	$CheckName1 = mssql_num_rows ($CheckName1);
if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { 

} 
else
{
echo "<text1><strong>הכתובת האלקטרונית אינה תקינה</strong></text1>";

return "";
}
    function secure($sec) 
        {return mysql_real_escape_string(htmlspecialchars($sec));}
if($CheckName ==1)
{
echo "<br><text1><strong>שם המשתמש שבחרת תפוס, אנא בחר אחד חדש</strong></text1>";
}

else if (empty($cap) || $_SESSION['captcha'] != $cap)
{
echo "הקוד שהקשת שגוי, אנא נסה שנית ";
 echo "<meta http-equiv='refresh' content='1'>";
}
else if (preg_match('/[^A-Za-z0-9]/', $memb___id)) // '/[^a-z\d]/i' should also work.
{
	echo "ציינת שם משתמש אינו תקין נסה שנית";
	}
	else if (preg_match('/[^A-Za-z0-9]/', $pwd)) // '/[^a-z\d]/i' should also work.
{
	echo "ציינת סיסמה שאינה חוקית נסה שנית";
	}
else if ($checkphone ==0)
{
echo "מספר הפלאפון שגוי נסה שוב";
}
else if($CheckName1 ==1)
{
echo "<br><text1>הכתובת האלקטרונית שבחרת כבר בשימוש, אנא בחר אחת אחרת </text1>";
}
elseif (strlen($memb___id) < 6)
{
echo "<br><text1>שם משתמש חייב להכיל מינימום 6 תווים</text1>";
	}
	elseif (strlen($pwd) < 6)
{
echo "<br><text1>הסיסמה חייבת להכיל יותר מ6 תווים</text1>";
	}
		elseif (strlen($email) > 35)
{
echo "<br><text1>הכתובת האלקטרונית יכולה להכיל עד כ35 תווים</text1>";
	}
		elseif ($pwd != $pwd1)
{
echo "<br><text1>הסיסמאות שהקשת אינן תואמות </text1>";
	}
	elseif (strlen($code) < 9)
{
echo "<br><text1>הטלפון הנייד שלך אינו תקין</text1>";
	}
	else
	{
if($md5==1)
{
$pass = md5($pwd);
	mssql_query("INSERT INTO MEMB_INFO(memb___id, memb__pwd, mail_addr, sno__numb, phon_numb, bloc_code, ctl1_code, memb_name)VALUES('$memb___id' ,'$pass', '$email', '$code', '$code', '0', '0', 'name')");
	echo " <meta http-equiv=refresh content=10>";
echo "<br><table align=center style='color:#fff;'>";
echo "<tr><td>",$memb___id," :שם משתמש</tr>";
echo "<tr><td>",$pwd," :סיסמה</tr>";
echo "<tr><td>",$email," :כתובת אלקטרונית</tr>";
echo "<tr><td>",$code," :טלפון נייד</tr></table></text1>";
}
else{

	//$Time = GetTime();
	mssql_query("INSERT INTO MEMB_INFO(memb___id, memb__pwd, mail_addr, sno__numb, phon_numb, bloc_code, ctl1_code, memb_name)VALUES('$memb___id', '$pwd', '$email', '$code', '$code', '0', '0', 'name')");echo " <meta http-equiv=refresh content=10>";
	echo "<br><table align=center style='color:#fff;'>";
	echo "<tr><td>",$memb___id," :שם משתמש</tr>";
	echo "<tr><td>",$pwd," :סיסמה</tr>";
	echo "<tr><td>",$email," :כתובת אלקטרונית</tr>";
	echo "<tr><td>",$code," :טלפון נייד</tr></table></text1>";
	}
	}
}

		function GMbox()
	{
			$queryGM = mssql_query("SELECT Top 10 *FROM  Character where CtlCode=32 ORDER BY Admin DESC ");
$num = 0;
while ($t = mssql_fetch_array ($queryGM)) 
{
		$num++;
	$check = mssql_query("SELECT *FROM Character where Name='$t[Name]'");
	$check = mssql_fetch_array($check);
	$check1 = mssql_query("SELECT *FROM MEMB_STAT where memb___id='$check[AccountID]'");
	$check1 = mssql_fetch_array($check1);
	if($check1['ConnectStat']==1)
	{
	echo "<tr valign=top><td><center><img src=images/online.gif></center></td><td><center>",$t['Name'],"</center></td></td><td><center>.",$num,"</center></td></tr>";

	}
	else
	{
	echo "<tr valign=top><td><center><img src=images/offline.gif></center></td><td><center>",$t['Name'],"</center></td></td><td><center>",$num,".</center></td></tr>";
	}
	}
	}
	
	function TopBox($Top,$ResetTable)
	{	
			$query = mssql_query("SELECT Top $Top *FROM  Character where CtlCode=0 ORDER BY $ResetTable DESC ");
$num = 0;
	echo "<tr valign=top><td><center>ריסט</center></td><td><center>כינוי</center></td></td><td><center>#</center></td></tr>";

while ($t = mssql_fetch_array ($query)) 
{
	$num++;
	echo "<tr valign=top><td><center>",$t[$ResetTable],"</center></td><td><center>",$t['Name'],"</center></td></td><td><center>.",$num,"</center></td></tr>";
}
		
	}
		function SetLostPassword($username,$phone,$email,$cap,$md5)
		{
			
		 if (empty($cap) || $_SESSION['captcha'] != $cap)
{
echo "<br>הקוד שהקשת שגוי, אנא נסה שנית ";
 echo "<meta http-equiv='refresh' content='2'>";
}
else{
			if($md5 ==0)
			{
				$time=date('d/m/Y H:i');
			$query = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and phon_numb='$phone' and mail_addr='$email'");
			$query = mssql_num_rows($query);
				if($query ==1)
				{
				$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$newpwd = substr(str_shuffle($chars),0,8);
			
			mssql_query("UPDATE MEMB_INFO SET last_pass='$time' where memb___id='$username'");
			mssql_query("UPDATE MEMB_INFO set memb__pwd = '$newpwd' where memb___id='$username'");
			echo "<br>",$newpwd,":סיסמתך החדשה היא";
			}
			else
			{
				echo "<br>הקשת פרטים שגויים";
			}
			}
			
			else
			{
			$time=date('d/m/Y H:i');
			$query = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and phon_numb='$phone' and mail_addr='$email'");
			$query = mssql_num_rows($query);
			if($query ==1)
			{
			$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$random = substr(str_shuffle($chars),0,8);
			$newpwd = md5($random);
			mssql_query("UPDATE MEMB_INFO SET last_pass='$time' where memb___id='$username'");
	mssql_query("UPDATE MEMB_INFO SET  memb__pwd='$newpwd' where memb___id='$username'");
	echo "<br>",$random,":סיסמתך החדשה היא";
			}
			else
			{
				echo "<br>הקשת פרטים שגויים";
			}
			}
}
		}
		function SetLostEmail($username,$phone,$pwd,$cap,$md5)
		{
			
		 if (empty($cap) || $_SESSION['captcha'] != $cap)
{
echo "<br>הקוד שהקשת שגוי, אנא נסה שנית ";
 echo "<meta http-equiv='refresh' content='2'>";
}
else{
			if($md5 ==0)
			{
				
			$query = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and phon_numb='$phone' and memb__pwd='$pwd'");
			$query = mssql_num_rows($query);
			
				if($query ==1)
				{
					$query = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and phon_numb='$phone' and memb__pwd='$pwd'");
			$query = mssql_fetch_array($query);
			echo "<br>",$query['mail_addr'], " :האמייל שלך הוא";
			}
			else
			{
				echo "<br>הקשת פרטים שגויים";
			}
			}
			else
			{
			$pwd = md5($pwd);
			$query =  mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and  memb__pwd = '$pwd' and phon_numb='$phone'");
			$query = mssql_num_rows($query);
			if($query ==1)
			{
				$query =  mssql_query("SELECT *FROM MEMB_INFO where memb___id='$username' and  memb__pwd = '$pwd' and phon_numb='$phone'");
			$query = mssql_fetch_array($query);
			echo "<br>",$query['mail_addr'], " :האמייל שלך הוא";
			}
			else
			{
				echo "<br>הקשת פרטים שגויים";
			}
			}
}
		}
	function InfoChar($Name,$ResetTable)
	{

		$checkname = mssql_query("SELECT *FROM Character where Name='$Name'");
		$checkname = mssql_num_rows($checkname);
		if($checkname ==0)
		{
			echo "!הניק אינו נמצא במערכת";
		}
		else
		{
		$info = mssql_query("SELECT *FROM Character where Name='$Name'");
		$info = mssql_fetch_array($info);

								
		$info1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$info[AccountID]'");
		$info1 = mssql_fetch_array($info1);
				$info2 = mssql_query("SELECT *FROM MEMB_STAT where memb___id='$info[AccountID]'");
		$info2 = mssql_fetch_array($info2);
			echo "<table align='center' width=230px border='0' style='text-align:center; background-color:#404040 ;color:#fff;border:solid 1px #000;-webkit-box-shadow: 3px 2px 15px 3px rgba(0,0,0,0.75);-moz-box-shadow: 3px 2px 15px 3px rgba(0,0,0,0.75);'><th></th><th></th>";
			echo "<tr valign=top class=infotr><td colspan=2><center><h3 style='color:#CC9933;'>כרטיס מידע על שחקן</h3></tr>";
						echo "<tr valign=top><td>",	$Name,"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> כינוי </strong></span></td></tr>";
			echo "<tr valign=top><td>",$info1['memb_guid'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> מס איידי </strong></span></td></tr>";
			echo "<tr valign=top><td>",	GetClass($Name),"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> דמות </strong></span></td></tr>";
			if($info['CtlCode'] ==1)
			{
					echo "<tr valign=top><td> Banned</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> פרופיל </strong></span></td></tr>";
						echo "<tr valign=top><td>",$info['BanBy'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> נחסם על ידי </strong></span></td></tr>";
			}
				elseif($info['CtlCode'] ==0)
			{
					echo "<tr valign=top><td> Player</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> פרופיל </strong></span></td></tr>";
			}
					elseif($info['CtlCode'] ==32)
			{
					echo "<tr valign=top><td><font color='red'><b> Game Master</b></font></td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> פרופיל </strong></span></td></tr>";
			}
		if($info2['ConnectStat']==1)
			echo "<tr valign=top><td>  <img src='/images/online.gif'></td> <td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> מצב </strong></span></td></tr>";	
			else
							echo "<tr valign=top><td>  <img src='/images/offline.gif'></td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> מצב </strong></span></td></tr>";	

		echo "<tr valign=top><td colspan=2></td></tr>";
				echo "<tr valign=top><td>",$info['cLevel'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> רמה </strong></span></td></tr>";
			echo "<tr valign=top><td>",$info[$ResetTable],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> ריסט </strong></span></td></tr>";
			echo "<tr valign=top><td>", $info1['Credits'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> קרדיטים </strong></span></td></tr>";
			echo "<tr valign=top><td>", GetMap($Name),"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> מפה אחרונה </strong></span></td></tr>";
			echo "<tr valign=top><td>",$info['Money'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> כסף </strong></span></td></tr>";
					echo "<tr valign=top><td colspan=2></td></tr>";
					
								echo "<tr valign=top><td>",$info['Strength'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> עוצמה </strong></span></td></tr>";
			echo "<tr valign=top><td>",$info['Energy'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> אנרגיה </strong></span></td></tr>";
			echo "<tr valign=top><td>", $info['Vitality'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> זריזות </strong></span></td></tr>";
			echo "<tr valign=top><td>", $info['Dexterity'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> חיים </strong></span></td></tr>";
			if($info['Class'] ==64)
			{
					echo "<tr valign=top><td>", $info['Leadership'],"</td><td><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong> פיקוד </strong></span></td></tr>";
			}
					echo "<tr valign=top><td colspan=2></td></tr>";
					
					echo "<tr valign=top><td colspan=2><center><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong>Date Register:</strong></span></td></tr><tr valign=top><td colspan=2><center>",$info1['addr_deta'],"</td></tr>";
			echo "<tr valign=top><td colspan=2><center><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong>Last Change Pass: </strong></span></td></tr><tr valign=top><td colspan=2><center>",$info1['last_pass'],"</td></tr>";
			echo "<tr valign=top><td colspan=2><center><span style='color: #fff; text-shadow: black 1px 1px 0px;'><strong>Last Change Email: </strong></span></td><tr valign=top><td colspan=2><center>",$info1['last_email'],"</td></tr></table>";
echo "<br><img width=230px src=images/info/",$info['Class'],".jpg>";
		
		}
	}
	function GetMode($Nick)
	{
		$query = mssql_query("SELECT *FROM Character where Name='$Nick'");
		$query = mssql_num_rows($query);
		if($query ==0)
		{echo "";}
		else
		{
			$Check = mssql_query("SELECT *FROM Character where Name='$Nick'");
			$Check = mssql_fetch_array($Check);
			$Check1 = mssql_query("SELECT *FROM MEMB_STAT WHERE memb___id='$Check[AccountID]'");
			$Check1 = mssql_fetch_array($Check1);
			if($Check1['ConnectStat']==1)
			{
				echo "<img src=images/online.gif>";
			}
			else
			{
				echo "<img src=images/offline.gif>";
			}
		}
	}

	
function InfoGuild($Name,$ResetTable)
{

		$checkname = mssql_query("SELECT *FROM Guild where G_Name='$Name'");
		$checkname = mssql_num_rows($checkname);
		if($checkname ==0)
		{
			echo "!הגילדה לא קיימת במערכת";
		}
		else
		{
					$info = mssql_query("SELECT *FROM Guild where G_Name='$Name'");
		$info = mssql_fetch_array($info);
			echo "<table style='color:#fff;' align=center><th width=100px><center></th><th = width100px><center></th>";
						echo "<tr valign=top><td>",	$Name,"</td><td> : גילדה</td></tr>";
						echo "<tr valign=top><td>",	$info['G_Master'],"</td><td>: מנהל הגילדה</td></tr>";
						echo "<tr valign=top><td>",	$info['G_Score'],"</td><td>: כבשה את הטירה</td></tr>";
							echo "<tr valign=top><td colspan=2></td></tr>";
						echo "</table>";
						echo "<table align=center style='color:#fff;'><th width=20px><center>#</th><th width=80px><center>כינוי</th><th width=100px><center>עבודה</th><th width=50px><center>רמה</th><th width=100px><center>דמות</th>";
						$query = mssql_query("SELECT *FROM GuildMember WHERE G_Name='$Name' ORDER BY G_Status DESC ");
					$num = 0;
					while($t = mssql_fetch_array($query))
						{$num++;
							$checkinfo = mssql_query("SELECT *FROM Character where Name='$t[Name]'");
							$checkinfo = mssql_fetch_array($checkinfo);
							echo "<tr valign=top><td><center>",$num,".</td><td><center>",$t['Name'],"</td><td><center>",GetJob($t['Name']),"</td><td><center>",$checkinfo['cLevel'],"(",$checkinfo[$ResetTable],")</td><td><CENTER>",GetClass($t['Name']),"</td></tr>";
						}
						echo "</table>";
		}
}
/////// GET SQL/////////
	function GetJob($Name)
	{
	$info = mssql_query("SELECT *FROM GuildMember where Name='$Name'");
		$info = mssql_fetch_array($info);
	
	if($info['G_Status'] ==0)
	{
	$class="Guild Member";echo $class;	
	}	
		elseif($info['G_Status'] ==128)
	{
	$class="Guild Master";echo $class;	
	}
		elseif($info['G_Status'] ==32)
	{
	$class="Battle Master";echo $class;	
	}
			elseif($info['G_Status'] ==64)
	{
	$class="Assistant Master";echo $class;	
	}
	}
	
function GetMap($Name)
	{
			$check = mssql_query("SELECT *FROM Character where Name='$Name'");
		$check = mssql_num_rows($check);
		if($check ==1)
		{
			$info = mssql_query("SELECT *FROM Character where Name='$Name'");
		$info = mssql_fetch_array($info);

	
	if($info['MapNumber'] ==0)
	{
	$Map="Lorencia";echo $Map;	
	}
	else if($info['MapNumber']==1)
	{
	$Map="Dungeon";echo $Map;
	}	
	else if($info['MapNumber']==2)
	{
    $Map="Devias";echo $Map;	
	}
    else if($info['MapNumber']==3)
	{    
$Map="Noria";echo $Map;	
	}
    else if($info['MapNumber']==4)
	{					$Map="Lost Tower";	echo $Map;	
	}
    else if($info['MapNumber']==6)
	{
		$Map="Arena";	echo $Map;	
	}		
    else if($info['MapNumber']==7)
	{
					$Map="Atlans";echo $Map;	
	}					
    else if($info['MapNumber']==8)
	{$Map="Tarkan";	
echo $Map;				
	}
	    else if($info['MapNumber']==10)
	{$Map="Icarus";	
echo $Map;				
	}
	    else if($info['MapNumber']>=11)
	{$Map="n\y";	
echo $Map;				
	}
		}
	}

	function GetClass($Name)
	{

			$info = mssql_query("SELECT *FROM Character where Name='$Name'");
		$info = mssql_fetch_array($info);
	
	if($info['Class'] ==0)
	{
	$class="Dark Wizrd";echo $class;	
	}
	else if($info['Class']==1)
	{
	$class="Soul Master";echo $class;
	}	
	else if($info['Class']==3)
	{
	$class="Grand Master";echo $class;
	}	
	else if($info['Class']==48)
	{
    $class="MagicGladiator";echo $class;	
	}
    else if($info['Class']==64)
	{    
$class="Dark Lord";echo $class;	
	}
    else if($info['Class']==16)
	{					$class="Dark Knight";	echo $class;	
	}
    else if($info['Class']==17)
	{
		$class="Blade Knight";	echo $class;	
	}	
	else if($info['Class']==18)
	{
		$class="Blade Master";	echo $class;	
	}	
    else if($info['Class']==19)
	{
		$class="Blade Master";	echo $class;	
	}	
    else if($info['Class']==32)
	{
					$class="Fairy Elf";echo $class;	
	}					
    else if($info['Class']==33)
	{$class="Muse Elf";	
echo $class;				
	}
	   else if($info['Class']==35)
	{$class="High Elf";	
echo $class;				
	}
	  else if($info['Class']==80)
	{$class="Summoner";	
echo $class;				
	}
		  else if($info['Class']==81)
	{$class="Summoner";	
echo $class;				
	}
	}
	
	function GetTime()
	{
		$time=date('H:i');
		echo $time;
	}
function GetUsers()
{
	$query = mssql_query("SELECT *FROM MEMB_INFO");
	$query =mssql_num_rows($query);
	return $query;
}
function GetGuilds()
{
	$query = mssql_query("SELECT *FROM Guild");
	$query =mssql_num_rows($query);
	return $query;
}
function GetOnline()
{
	$query = mssql_query("SELECT *FROM MEMB_STAT WHERE ConnectStat =1");
	$query =mssql_num_rows($query);
	return $query;
}
function GetCharacter()
{
	$query = mssql_query("SELECT *FROM Character");
		$query = mssql_num_rows($query);
		echo $query;
}

function GetTopRanking($ResetTable)
{
	$query = mssql_query("SELECT  *FROM  Character where CtlCode=0 ORDER BY $ResetTable DESC");
		$query = mssql_fetch_array($query);
		echo $query['Name'];
}
function GetWinCS()
{
	$query = mssql_query("SELECT *FROM MuCastle_DATA ");
		$query = mssql_fetch_array($query);
		if($query['OWNER_GUILD'] !='')
		echo "<u>",$query['OWNER_GUILD'],"</u>";
	else
		echo "N/Y";
}
function GetCredits($Name)
{
	$query = mssql_query("Select *FROM Character where Name='$Name'");
	$query = mssql_fetch_array($query);
	$GetCredits = mssql_query("SELECT Credits FROM MEMB_INFO WHERE memb___id='$query[AccountID]'");
	$GetCredits = mssql_fetch_array($GetCredits);
	if($GetCredits['Credits']==0)
		echo "0";else
	echo $GetCredits['Credits'];
}

/////////////////////// Get SQL///////
function Ranking($Top,$ResetTable,$Mode)
{$num =0;
if($Mode == 1){
	$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 AND Class=0 OR Class=1 OR Class=3 ORDER by $ResetTable DESC");
}
else if($Mode==2){$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 and Class=16 OR Class=17 OR Class=19 ORDER by $ResetTable DESC");}
else if($Mode==3){$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 and Class=32 OR Class=33 OR Class=35 ORDER by $ResetTable DESC");}
else if($Mode==4){$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 and Class=48 ORDER by $ResetTable DESC");}
else if($Mode==5){$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 and Class=64 ORDER by $ResetTable DESC");}
else if($Mode==6){$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 and Class=80 OR Class=81 ORDER by $ResetTable DESC");}
else
{
		$query = mssql_query("SELECT Top $Top *from Character where CtlCode=0 ORDER by $ResetTable  DESC");}

	echo "<table width=380px align=center style=color:#fff>";
	echo "<tr valign=top><td><center>#</td><td><center>כינוי</center></td><td><center>רמה</center></td><td><center>דמות</center></td><td><center>קרדיטים</center></td><td><center>מצב</center></td></tr>";
	while ($row = mssql_fetch_array($query))
	{$num++;
echo "<tr valign=top><td width=10px><center>",$num,".</td><td><center>",$row['Name'],"</td><td><center>",$row['cLevel'],"(",$row[$ResetTable],")","</td>","<td><center>",GetClass($row['Name']),"</td>","<td><center>",GetCredits($row['Name']),"</td><td><center>",GetMode($row['Name']),"</td></tr>";
		
	}
	echo "</table>";
}

function BanList($Sum,$ResetTable)
{$num =0;

	$query = mssql_query("SELECT Top $Sum *from Character where CtlCode=1");
	echo "<table width=380px align=center style=color:#fff>";
		echo "<tr valign=top><td><center>#</td><td><center>כינוי</center></td><td><center>רמה</center></td><td><center>דמות</center></td><td><center>על ידי</center></td><td><center>שחרור</center></td></tr>";
	while ($row = mssql_fetch_array($query))
	{$num++;
echo "<tr valign=top><td width=10px><center>",$num,".</td><td><center>",$row['Name'],"</td><td><center>(",$row[$ResetTable],")",$row['cLevel'],"</td>","<td><center>",GetClass($row['Name']),"</td>","<td><center>",$row['BanBy'],"</td><td><center>",$row['BanT'],"</td></tr>";
		
	}
	echo "</table>";
}

function GetGmList()
{
	$query = mssql_query("SELECT *FROM Character where CtlCode=32");
$num =0;
	echo "<table align=center style='color:#fff;'><th width=50px><center>#</th><th width=120px><center>כינוי</th><th width=40px><center>Mode</th>";
	while($row = mssql_fetch_array($query))
	{$num++;
		echo "<tr valign=top><td width=50px><center>",$num,"</td><td width=120px><center>",$row['Name'],"</td><td width=40px><center>",GetMode($row['Name']),"</td></tr>";
	}
	echo "</table>";
}
	?>
	