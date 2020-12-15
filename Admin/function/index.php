<?php
function checkLogin()
{
$Login=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
$Login = mssql_num_rows($Login);
if($Login ==0)
{
		header('Location: index.php?Page=Home');
}
}
function Login($username,$password)
{
		$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$username' and Password='$password'");
		$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$_SESSION['Username'] = $username;
		$_SESSION['Password'] = $password;
		echo "<meta http-equiv='refresh' content='1'>";
	}
	else
	{
		echo "<br><br><center><font color=red><b>הזנת פרטים שגויים נסה שוב</font></b>";
	}
}
function getUser($username)
{
	$_POST['memb___id'] =$username;
	$_SESSION["editAccount"] = $_POST['memb___id'];
	echo "<meta http-equiv='refresh' content='1'>";

	
}
function editUser($username,$ResetTable,$md5)
{	$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['editAccount'] ==1)
		{
	$checkID = Mssql_query("SELECT *FROM MEMB_INFO WHERE memb___id='$_SESSION[editAccount]'");
	$checkID = mssql_num_rows($checkID);
	$_POST['memb___id'] =$username;
if($checkID ==1)
{
$memb___id = Mssql_query("SELECT *FROM MEMB_INFO WHERE memb___id='$_SESSION[editAccount]'");
$memb___id = mssql_fetch_array($memb___id);
$IP = Mssql_query("SELECT *FROM MEMB_STAT WHERE memb___id='$_SESSION[editAccount]'");
$IP = mssql_fetch_array($IP);

echo "<br><br><h3>",$_SESSION['editAccount'],"</h3><table align=center><form method=post>
<tr valign=top>
<td><center><input type=text name='memb__pwd'>
<td><center> :סיסמה</td>
</tr>
<tr valign=top>
<td><center><input type=text name='mail_addr' value=",$memb___id['mail_addr'],">
<td><center> :אמייל</td>
</tr><tr valign=top>
<td><center><input type=text name='sno__numb' value=",$memb___id['sno__numb'],">
<td><center> :טלפון</td>
</tr>
<tr valign=top>
<td><center><input type=text name='Credits' value=",$memb___id['Credits'],">
<td><center> :קרדיטים</td>
</tr>
<tr valign=top>
<td><center><input type=text name='memb___id' value=",$IP['IP'],">
<td><center> :אייפי</td>
</tr>
<tr valign=top>
<td><center>
<select name=banned>
<option>משוחרר</option>
<option>חסום</option></select>
<td><center> :פרופיל</td>
</tr></table>
<input type=submit name='save' value='שמור'></form>
";
echo "<br><h4>:שחקנים</h4><table width=350px align=center><tr valign=top><td><center>כינוי</td><td><center>רמה</tr>";
$query = mssql_query("SELECT *FROM Character where AccountID='$_SESSION[editAccount]'");
while($row = mssql_fetch_array($query))
{
	echo "<tr valign=top><td><center>",$row['Name'],"</td><td><center>",$row['cLevel'],"(",$row[$ResetTable],")</tr>";
}
if(isset($_POST['save']))
{
	$CheckName1 = mssql_query ("SELECT mail_addr FROM MEMB_INFO WHERE mail_addr='$_POST[mail_addr]' and memb___id !='$_SESSION[editAccount]'");
	$CheckName1 = mssql_num_rows ($CheckName1);
	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['mail_addr'])) { 

} 
else
{
echo "<strong>הכתובת האלקטרונית אינה תקינה</strong>";

return "";
}
    function secure($sec) 
        {return mysql_real_escape_string(htmlspecialchars($sec));}
 if (preg_match('/[^A-Za-z0-9]/', $_POST['memb__pwd'])) // '/[^a-z\d]/i' should also work.
{
	echo "ציינת סיסמה שאינה חוקית נסה שנית";
	}
	else if($CheckName1 ==1)
{
echo "<br>הכתובת האלקטרונית שבחרת כבר בשימוש, אנא בחר אחת אחרת ";
}
elseif (strlen($_POST['memb__pwd']) < 6)
{
echo "<br>הסיסמה חייבת להכיל יותר מ6 תווים";
	}
	elseif ($_POST['Credits'] < 0)
{
echo "<br>ציינת מספר קרדיטים אינו תקין";
	}
	else
	{
		if($md5 ==1)
		{
			if($_POST['banned'] == "חסום")
			{
				$time=date('d/m/Y H:i');
				$_POST['memb__pwd'] = MD5($_POST['memb__pwd'] );
		mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת משתמש', '$time')");
		mssql_query("UPDATE MEMB_INFO SET bloc_code=1 where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE Character SET CtlCode=1 where AccountID='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET memb__pwd='$_POST[memb__pwd]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET mail_addr='$_POST[mail_addr]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET sno__numb='$_POST[sno__numb]' where memb___id='$_SESSION[editAccount]'");
	$_SESSION["editAccount"] = null;
	echo "<meta http-equiv='refresh' content='1'>";
			}
			ELSE
			{
								$time=date('d/m/Y H:i');
				$_POST['memb__pwd'] = MD5($_POST['memb__pwd'] );
		mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת משתמש', '$time')");
		mssql_query("UPDATE MEMB_INFO SET bloc_code=0 where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE Character SET CtlCode=0 where AccountID='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET memb__pwd='$_POST[memb__pwd]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET mail_addr='$_POST[mail_addr]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET sno__numb='$_POST[sno__numb]' where memb___id='$_SESSION[editAccount]'");
	$_SESSION["editAccount"] = null;
	echo "<meta http-equiv='refresh' content='1'>";
			}
		}
		else
		{
			if($_POST['banned'] == "חסום")
			{
				$time=date('d/m/Y H:i');
				$_POST['memb__pwd'] = MD5($_POST['memb__pwd'] );
		mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת משתמש', '$time')");
		mssql_query("UPDATE MEMB_INFO SET bloc_code=1 where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE Character SET CtlCode=1 where AccountID='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET memb__pwd='$_POST[memb__pwd]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET mail_addr='$_POST[mail_addr]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET sno__numb='$_POST[sno__numb]' where memb___id='$_SESSION[editAccount]'");
	$_SESSION["editAccount"] = null;
	echo "<meta http-equiv='refresh' content='1'>";
			}
			ELSE
			{
			$time=date('d/m/Y H:i');
		mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת משתמש', '$time')");
		mssql_query("UPDATE MEMB_INFO SET bloc_code=0 where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE Character SET CtlCode=0 where AccountID='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET memb__pwd='$_POST[memb__pwd]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET mail_addr='$_POST[mail_addr]' where memb___id='$_SESSION[editAccount]'");
		mssql_query("UPDATE MEMB_INFO SET sno__numb='$_POST[sno__numb]' where memb___id='$_SESSION[editAccount]'");
	$_SESSION["editAccount"] = null;
	echo "<meta http-equiv='refresh' content='1'>";
			}
		}
	}
}
}
}
	}
}
function getCharacter($Name)
{
	
	$_SESSION["editCharacter"] = $Name;
	echo "<meta http-equiv='refresh' content='1'>";

	
}
function editCharacter($Name,$ResetTable)
{	
	$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['editCharacter'] ==1)
		{
$time=date('d/m/Y H:i');
$checkName = Mssql_query("SELECT *FROM Character WHERE Name='$_SESSION[editCharacter]'");
$checkName = mssql_num_rows($checkName);
if($checkName ==1)
{
$getCharacter = Mssql_query("SELECT *FROM Character WHERE Name='$_SESSION[editCharacter]'");
$getCharacter = mssql_fetch_array($getCharacter);
$IP = Mssql_query("SELECT *FROM MEMB_STAT WHERE memb___id='$getCharacter[AccountID]'");
$IP = mssql_fetch_array($IP);

echo "<br><br><h3>",$_SESSION['editCharacter'],"</h3><table align=center><form method=post>
<tr valign=top>
<td><center><input type=text name='memb___id' value=",$getCharacter['AccountID'],">
<td><center> :שם משתמש</td>
</tr>
<tr valign=top>
<td><center><input type=number name='cLevel' value=",$getCharacter['cLevel'],">
<td><center> :רמה</td>
</tr><tr valign=top>
<td><center><input type=number name='Resets' value=",$getCharacter[$ResetTable],">
<td><center> :ריסט</td>
</tr>
<tr valign=top>
<td><center><input type=number name='Strength' value=",$getCharacter['Strength'],">
<td><center> :כוח</td>
</tr>
<tr valign=top>
<td><center><input type=number name='Energy' value=",$getCharacter['Energy'],">
<td><center> :אנרגיה</td>
</tr>
<tr valign=top>
<td><center><input type=number name='Vitality' value=",$getCharacter['Vitality'],">
<td><center> :זריזות</td>
</tr>
<tr valign=top>
<td><center><input type=number name='Dexterity' value=",$getCharacter['Dexterity'],">
<td><center> :חיים</td>
</tr>
<tr valign=top>
<td><center><input type=number name='Leadership' value=",$getCharacter['Leadership'],">
<td><center> :פיקוד</td>
</tr>
<tr valign=top>
<td><center>
<select name=banned>
<option>משוחרר</option>
<option>חסום</option>
<option>מנהל</option></select>
<td><center> :פרופיל</td>
</tr></table>
<input type=submit name='save' value='שמור'></form>
";
echo "<br><h4>:שחקנים</h4><table width=250px align=center><tr valign=top><td><center>כינוי</td><td><center>רמה</tr>";
$query = mssql_query("SELECT *FROM Character where AccountID='$getCharacter[AccountID]'");
while($row = mssql_fetch_array($query))
{
	echo "<tr valign=top><td><center>",$row['Name'],"</td><td><center>",$row['cLevel'],"(",$row['$ResetTable'],")</tr>";
}
if(isset($_POST['save']))
{
if($_POST['cLevel']<0)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else if($_POST['Strength']<0 or $_POST['Strength']>32767)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else if($_POST['Resets']<0)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else if($_POST['Energy']<0 or $_POST['Energy']>32767)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else if($_POST['Dexterity']<0 or $_POST['Dexterity']>32767)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else if($_POST['Vitality']<0 or $_POST['Vitality']>32767)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else if($_POST['Leadership']<0 or $_POST['Leadership']>32767)
{
	echo "<br><center>מספר הנקודות שהזנת אינו תקין נסה שנית";
}
else
{
	if($_POST['banned'] =="חסום")
	{
	mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת שחקן', '$time')");
	mssql_query("UPDATE Character set cLevel= $_POST[cLevel]Energy=$_POST[Energy],Strength=$_POST[Strength],Dexterity=$_POST[Dexterity],Vitality=$_POST[Vitality],Leadership=$_POST[Leadership],CtlCode=1 where Name='$_SESSION[editCharacter]'");
    mssql_query("UPDATE Character set $ResetTable = $_POST[Resets] where Name='$_SESSION[editCharacter]'");
	}
	else if($_POST['banned'] =="משוחרר")
	{
	mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת שחקן', '$time')");
	mssql_query("UPDATE Character set cLevel= $_POST[cLevel],Energy=$_POST[Energy],Strength=$_POST[Strength],Dexterity=$_POST[Dexterity],Vitality=$_POST[Vitality],Leadership=$_POST[Leadership],CtlCode=0 where Name='$_SESSION[editCharacter]'");
    mssql_query("UPDATE Character set $ResetTable = $_POST[Resets] where Name='$_SESSION[editCharacter]'");

	}
	else if($_POST['banned'] =="מנהל")
	{
	mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'עריכת שחקן', '$time')");
	mssql_query("UPDATE Character set cLevel= $_POST[cLevel],Energy=$_POST[Energy],Strength=$_POST[Strength],Dexterity=$_POST[Dexterity],Vitality=$_POST[Vitality],Leadership=$_POST[Leadership],CtlCode=32 where Name='$_SESSION[editCharacter]'");
    mssql_query("UPDATE Character set $ResetTable = $_POST[Resets] where Name='$_SESSION[editCharacter]'");

	}
		$_SESSION["editCharacter"] = null;
	echo "<meta http-equiv='refresh' content='1'>";
}

}
}
}
}
}
function searchIP($ip)
{
	$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkCMD = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['searchIP'] ==1)
		{
	$query = mssql_query("SELECT *FROM MEMB_STAT WHERE IP='$ip'");
	$query = mssql_num_rows($query);
	if($query >=1)
	{
	$time=date('d/m/Y H:i');
	mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'חיפוש אייפי', '$time')");
		echo "<h3>",$ip,"</h3>";
	$search = mssql_query("SELECT *FROM MEMB_STAT WHERE IP='$ip'");
	echo "<table align=center width=250px><tr valign=top><td><center>שם משתמש</td><td><center>התחבר לאחרונה</tr>";
	while ($row = mssql_fetch_array($search))
	{
		echo "<tr valign=top><td><center>",$row['memb___id'],"</td><td><center>",$row['ConnectTM'],"</tr>";
	}
	echo "</table>";
	}
	}
	}
	}
function blockIP($IP)
{
	$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkCMD = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['searchIP'] ==1)
		{
	$query = mssql_query("SELECT *FROM MEMB_STAT WHERE IP='$IP'");
	$query = mssql_num_rows($query);
	IF($query >=1)
	{
		$blockIP = mssql_query("SELECT *FROM MEMB_STAT WHERE IP='$IP'");
		while($row = mssql_fetch_array($blockIP))
		{
			$Block = mssql_query("SELECT *FROM MEMB_INFO WHERE memb___id='$row[memb___id]'");
			$Block =mssql_fetch_array($Block);
			$time=date('d/m/Y H:i');
			mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'חסימת אייפי', '$time')");
			mssql_query("UPDATE MEMB_INFO SET bloc_code =1 where memb___id='$Block[memb___id]'");
			echo "<meta http-equiv='refresh' content='1'>";
		}
	}
	else
	{
		echo "<br>לא נמצאו משתמשים התאומים לכתובת האייפי";
	
	}
	}
	}
	}
function getStatic()
{
		$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['Static'] ==1)
		{
	$checkPlayers = mssql_query("SELECT *FROM Character");
	$checkPlayers = mssql_num_rows($checkPlayers);
	$checkUsers = mssql_query("SELECT *FROM MEMB_INFO");
	$checkUsers = mssql_num_rows($checkUsers);
	$checkGuild = mssql_query("SELECT *FROM Guild");
	$checkGuild = mssql_num_rows($checkGuild);
	$checkOnline = mssql_query("SELECT *FROM MEMB_STAT WHERE ConnectTM =1");
	$checkOnline = mssql_num_rows($checkOnline);
	$checkGM = mssql_query("SELECT *FROM Character WHERE CtlCode > 1");
	$checkGM = mssql_num_rows($checkGM);
	$checkBanned = mssql_query("SELECT *FROM Character WHERE CtlCode = 1");
	$checkBanned = mssql_num_rows($checkBanned);
	$reset = 0;
	$checkReset = mssql_query("SELECT *FROM Character where CtlCode =0");
	while($row = mssql_fetch_array($checkReset))
	{
		$reset =$reset + $row['Resets'];
	}
	echo "<table align=center width=200px>
	<tr valign=top><td><center>",$checkUsers,"</td><td><center> :מספר משתמשים","</tr>
	<tr valign=top><td><center>",$checkPlayers,"</td><td><center> :מספר שחקנים","</tr>
	<tr valign=top><td><center>",$checkOnline,"</td><td><center> :מספר מחוברים","</tr>
	<tr valign=top><td><center>",$checkGuild,"</td><td><center> :מספר גילדות","</tr>
	<tr valign=top><td><center>",$checkBanned,"</td><td><center> :מספר חסומים","</tr>
	<tr valign=top><td><center>",$checkGM,"</td><td><center> :מספר מנהלים","</tr>
	<tr valign=top><td><center>",$reset,"</td><td><center> :סהכ ריסטים","</tr>
	</table>";
	}
	}
	}
function LogPanel()
{	
	$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['LogPanel'] ==1)
		{
$query6 = mssql_query("SELECT Top 25 * FROM LogPanel ORDER BY Date DESC");
while ($row = mssql_fetch_array ($query6)) { 
echo "<table align=center border=0><tr bgcolor=white><td width=150px><center>",$row['Username'],"</td><td width=200><center>",$row['CMD'],"</td><td width=200><center>",$row['Date'],"</td></tr></table>";
	}
	}
	}
	}
function addAdmin($Username,$Password,$editAccount,$editCharacter,$searchIP,$logPanel,$editAdmin,$Static)
{
		$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['editAdmin'] ==1)
		{
	$checkEditAccount =0;
	$checkEditCharacter =0;	
	$checkSearchIp =0;
	$checkStatic =0;
	$checkEditPanel =0;
	$checkLogPanel =0;
	if($editAccount =="חיובי")
	$checkEditAccount =1;
	if($editCharacter =="חיובי")
	$checkEditCharacter =1;

	if($searchIP =="חיובי")
	$checkSearchIp =1;

	if($logPanel =="חיובי")
	$checkLogPanel =1;
	if($editAdmin =="חיובי")
	$checkEditPanel =1;
	if($Static =="חיובי")
	$checkStatic =1;
 $query = mssql_query("SELECT *FROM MEMB_INFO WHERE memb___id='$Username' and memb__pwd='$Password'");
 $query = mssql_num_rows($query);
 if($query ==1)
 {
	$query1 = mssql_query("SELECT *FROM AdminPanel WHERE Username='$Username'");
	$query1 = mssql_num_rows($query1);
	if($query1 >=1)
	{
		echo "<br><center>אדמין זה קיים כבר במערכת";
	}
	else{ 
	 $time=date('d/m/Y H:i');
	mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'הוספת אדמין', '$time')");
	mssql_query("Insert Into AdminPanel(Username,Password,editAccount,editCharacter,searchIP,Static,LogPanel,editAdmin)VALUES('$Username', '$Password', $checkEditAccount, $checkEditCharacter, $checkSearchIp, $checkLogPanel, $checkStatic, $checkEditPanel)");
	echo "<meta http-equiv='refresh' content='1'>";}
}
else
{
	echo "<br><center>פרטי משתמש אינם קיימים במערכת";
}
}
}
}
function deleteAdmin($username)
{
			$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['editAdmin'] ==1)
		{
	$query1 = mssql_query("SELECT *FROM AdminPanel WHERE Username='$username'");
	$query1 = mssql_num_rows($query1);
		if($query1 >=1)
	{	 
		$time=date('d/m/Y H:i');
		mssql_query("Insert Into LogPanel(Username,CMD,Date)VALUES('$_SESSION[Username]', 'מחיקת אדמין', '$time')");
		mssql_query("DELETE FROM AdminPanel where Username = '$username'");
		echo "<meta http-equiv='refresh' content='1'>";
	}
	else
		echo "<br><center>אדמין זה אינו קיים במערכת";
	
}
}
}
function allAdmin()
{
	$checkAdmin=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
	$checkAdmin = mssql_num_rows($checkAdmin);
	IF($checkAdmin ==1)
	{
		$checkCMD = mssql_query ("SELECT *FROM AdminPanel WHERE Username = '$_SESSION[Username]'");
		$checkCMD = mssql_fetch_array($checkCMD);
		if($checkCMD['editAdmin'] ==1)
		{
	$checkEditAccount ="שלילי";
	$checkEditCharacter ="שלילי";	
	$checkSearchIp ="שלילי";
	$checkStatic ="שלילי";
	$checkEditPanel ="שלילי";
	$checkLogPanel ="שלילי";
	$query = mssql_query("SELECT *FROM AdminPanel");
	while($row = mssql_fetch_array($query))
	{

		if($row['editAccount']==1)
		$checkEditAccount = "חיובי";	
		if($row['editCharacter']==1)
		$checkEditCharacter = "חיובי";	
		if($row['searchIP']==1)
		$checkSearchIp = "חיובי";	
		if($row['Static']==1)
		$checkStatic = "חיובי";	
		if($row['LogPanel']==1)
		$checkLogPanel = "חיובי";
		if($row['editAdmin']==1)
		$checkEditPanel = "חיובי";	
	echo "<tr valign=top>
	<td><center>",$checkEditAccount,"</td>
		<td><center>",$checkEditCharacter,"</td>
	<td><center>",$checkSearchIp,"</td>
	<td><center>",$checkLogPanel,"</td>
	<td><center>",$checkStatic,"</td>
	<td><center>",$checkEditPanel,"</td>
	<td><center>",$row['Username'],"</td></tr>";
	}
	echo "</table>";
}
}
}
?>

