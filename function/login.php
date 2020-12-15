<?php
ob_start();
session_start();
include('config.php');
function GetIdLog()
{
	$query = mssql_query("SELECT  *From LogAccount");
	$query = mssql_num_rows($query);
	return $query;
}
	function GetTimeLog()
	{
		$time=date('H:i d/m/y');
		return $time;
	}
function CheckLogin($memb___id,$pwd,$md5)
{
		

	if($md5 ==1)
	{
		$pass = md5($pwd);
$check1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and  memb__pwd = '$pass'");
$check1 = mssql_num_rows($check1);
if($check1 ==0)
{
	echo ".הזנת פרטי משתמש שגויים";
}
else
{
	$check2 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and memb__pwd = '$pass'");
$check2 = mssql_fetch_array($check2);
if($check2['bloc_code'] ==1)
{
	echo "חשבון זה חסום";
}
else
{
$_SESSION["Username"] = $memb___id;
$_SESSION["Password"] = $pass;
	 	$newid = GetIdLog() + 1;
		$time = GetTimeLog();
		mssql_query("INSERT INTO LogAccount(Id,Account,Name,Time, CMD)VALUES($newid, '$_SESSION[Username]', 'none', '$time', 'Login Account')");
header('Location: myaccount');
}
}
}
else
{
	
$check1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and memb__pwd='$pwd'");
$check1 = mssql_num_rows($check1);
if($check1 ==0)
{
		echo ".הזנת פרטי משתמש שגויים";
}
else
{
	$check2 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and memb__pwd='$pwd'");
$check2 = mssql_fetch_array($check2);
if($check2['bloc_code'] ==1)
{
	echo "חשבון זה חסום";
}
else
{
$_SESSION["Username"] = $memb___id;
$_SESSION["Password"] = $pwd;
	 	$newid = GetIdLog() + 1;
		$time = GetTimeLog();
		mssql_query("INSERT INTO LogAccount(Id,Account,Name,Time, CMD)VALUES($newid, '$_SESSION[Username]', 'none', '$time', 'Login Account')");
header('Location: myaccount');
}
}
}

}

function CheckLoginPage($memb___id,$pwd,$cap,$md5)
{
	if (empty($cap) || $_SESSION['captcha'] != $cap)
{
echo "הקוד שהקשת שגוי, אנא נסה שנית ";
 echo "<meta http-equiv='refresh' content='1'>";
}
else
{
	if($md5 ==1)
	{
		$pass = md5($pwd);
$check1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and  memb__pwd = '$pass'");
$check1 = mssql_num_rows($check1);
if($check1 ==0)
{
	echo ".הזנת פרטי משתמש שגויים";
}
else
{
	$check2 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and memb__pwd = dbo.fn_md5('$pwd','$memb___id')");
$check2 = mssql_fetch_array($check2);
if($check2['bloc_code'] ==1)
{
	echo "חשבון זה חסום";
}
else
{
$_SESSION["Username"] = $memb___id;
$_SESSION["Password"] = $pass;
header('Location: /myaccount');
}
}
}
else
{
	
$check1 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and memb__pwd='$pwd'");
$check1 = mssql_num_rows($check1);
if($check1 ==0)
{
		echo ".הזנת פרטי משתמש שגויים";
}
else
{
	$check2 = mssql_query("SELECT *FROM MEMB_INFO where memb___id='$memb___id' and memb__pwd='$pwd'");
$check2 = mssql_fetch_array($check2);
if($check2['bloc_code'] ==1)
{
	echo "חשבון זה חסום";
}
else
{
$_SESSION["Username"] = $memb___id;
$_SESSION["Password"] = $pwd;
header('Location: /myaccount');
}
}
}
}
}

