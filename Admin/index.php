<?php
ob_start();
session_start();
include('../config.php');
include('function/index.php');	
?>

<html dir=lft>
<head>

<style>

body,a { cursor: url(images/mu.cur), auto; }
a:hover { cursor: url(images/mu2.cur), auto; }
</style>

<link href="style1.css" rel="stylesheet" type="text/css" />
   <link rel="shortcut icon" href="http://sky-mu.tripod.com/sitebuildercontent/sitebuilderpictures/mu_online.jpg" />

<meta  http-equiv="content-type" content="text/html; charset=UTF-8"> 
	<title><?php echo $title;?></title>
	<link rel=stylesheet type="text/css" href="style.css">
</head>


<body>
<div class=web>
<div class=Welcome>
<form method=get>
<input type=hidden name=Page>
</form>
<?

if ($_GET['Page'] == "" or $_GET['Page']=="Home")
{?>
<?
$Login=mssql_query("SELECT *FROM AdminPanel where Username='$_SESSION[Username]' and Password='$_SESSION[Password]'");
$Login = mssql_num_rows($Login);
if($Login ==0)
{?><h3>
<center>
עלייך להתחבר לאדמין פאנל
</h3>
<form method=POST>
<table align=center width=400px>
<tr valign><td><center><input type=text name=Username></td><td><center> :שם משתמש</td></tr>
<tr valign><td><center><input type=Password name=Password></td><td><center> :סיסמה</td></tr>
</table><center><br><input type=submit name=Login value="התחבר לפאנל"></form>
<?
if(isset($_POST['Login']))
{
	echo Login($_POST['Username'],$_POST['Password']);
}
}else{?>

<a href=index.php?Page=editAccount>
<div class=boxRow>

<h1>
עריכת פרטי חשבון
</h1>
<center><img src=images/account.png width=150px height=150px>
</div>
</a><a href=index.php?Page=editCharacter>
<div class=boxRow>
<h1>
עריכת שחקן
</h1>
<center><img src=images/character.jpg width=150px height=150px>

</div></a>
<a href=index.php?Page=searchIP>
<div class=boxRow>
<h1>
בדיקת אייפי
</h1>
<center><img src=images/ip.png width=150px height=150px>

</div></a>
<a href=index.php?Page=Static>
<div class=boxRow>
<h1>
סטטיסטיקת השרת</h1>
<center><img src=images/static.png width=150px height=150px>

</div></a>
<a href=index.php?Page=Log>
<div class=boxRow>
<h1>
לוג פעוליות </h1>
<center><img src=images/log.png width=150px height=150px>
</div>
</a><a href=index.php?Page=editAdmin>
<div class=boxRow>
<h1>
ניהול הרשאות</h1>
<center><img src=images/login.png width=150px height=150px>

</div></a>
<br>
<br><br>
<a href=index.php?Page=logOut title=התנתק>
<div class=boxRow1>
<center><img src=images/logout.png width=150px height=150px>
<?}?>
</div></a>
<?
}
else if($_GET['Page']=="editAccount")
{echo checkLogin();?>
<center>
<h3>עריכת פרטי משתמש</h3>
<center>
<table align=center width=350px>
<form method=POST>
<tr valign=top>
<td><center><input type=text name="memb___id">
<td><center> :שם משתמש</td>
</tr>
</table><center><input type=submit name="editUser" value="חפש משתמש"> <input type=submit name="UP" value="חזור">

</form>
<? 
if(isset($_POST['editUser']))
{
	echo getUser($_POST['memb___id']);

}
if(isset($_POST['UP']))
{
$_SESSION['editAccount']=NULL;
	header('Location: index.php?Page=Home');

}
	echo editUser($_POST['memb___id'],$reset,$md5);
}
else if ($_GET['Page']=="editCharacter")
{echo checkLogin();?>

<center>
<h3>עריכת פרטי שחקן</h3>
<center>
<table align=center width=350px>
<form method=POST>
<tr valign=top>
<td><center><input type=text name="Name">
<td><center> :שחקן</td>
</tr>
</table><center><input type=submit name="editCharacter" value="חפש שחקן"> <input type=submit name="UP" value="חזור"> 

</form>

<? 

if(isset($_POST['editCharacter']))
{
	echo getCharacter($_POST['Name']);

}
if(isset($_POST['UP']))
{
	header('Location: index.php?Page=Home');

}
	echo editCharacter($_POST['Name'],$reset);

}else if ($_GET['Page']=="searchIP")
{echo checkLogin();
?>

<center>
<h3>עקוב אחרי כתובת אייפי</h3>
<center>
<table align=center width=350px>
<form method=POST>
<tr valign=top>
<td><center><input type=text name="IP">
<td><center> :כתובת אייפי</td>
</tr>
</table><center><input type=submit name="searchIP" value="חפש משתמשים"> <input type=submit name="UP" value="חזור"> 

</form>

<? 

if(isset($_POST['searchIP']))
{
	echo searchIP($_POST['IP']);

}
if(isset($_POST['UP']))
{
	header('Location: index.php?Page=Home');

}
?>
<br>
<br>
<hr>

<center>
<h3>חסום כתובת אייפי</h3>
<center>
<table align=center width=350px>
<form method=POST>
<tr valign=top>
<td><center><input type=text name="checkIP">
<td><center> :כתובת אייפי</td>
</tr>
</table><center><input type=submit name="BlockIP" value="חסום משתמשים"> <input type=submit name="UP" value="חזור"> 
</form>
<?
if(isset($_POST['BlockIP']))
{
	echo BlockIP($_POST['checkIP']);

}
if(isset($_POST['UP']))
{
	header('Location: index.php?Page=Home');

}
}
else if ($_GET['Page']=="Static")
{
	echo checkLogin();
	echo "<center><h3>סטטיסטיקת השרת</h3>";
	echo getStatic();
	echo "<form method=POST><input type=submit name=UP Value=חזור></form>";
	if(isset($_POST['UP']))
{
	header('Location: index.php?Page=Home');

}
}else if ($_GET['Page']=="Log")
{echo checkLogin();?>
<center>
<h3> לוג פעולות באדמין פאנל</h3>
<table align=center>
<tr valign=top>
<td width=150 bgcolor=6699FF>
<center>
משתמש</td>
<td width=200 bgcolor=6699FF><center>
פקודה</td>
<td width=200 bgcolor=6699FF><center>
תאריך</td>
<? echo logPanel();?><BR>
<form method=POST>
<input type=submit name=UP Value="חזור"></form></table>
<?
if (isset($_POST['UP']))
{
header('Location: index.php?Page=Home');
}
}else if ($_GET['Page']=="editAdmin"){echo checkLogin();?>
<center>
<h3> ניהול הרשאות לפאנל</h3>
<form method=POST>
<table align=center width=270px>
<tr valign=top><td><center><input type=text name="Username"></td><td><center> :שם משתמש</td></tr>
<tr valign=top><td><center><input type=Password name="Password"></td><td><center> :סיסמה</td></tr>
<tr valign=top><td><center><select name=editAccount><option>שלילי</option><option>חיובי</option></select>
</td><td><center> :עריכת חשבון</tr>
<tr valign=top><td><center><select name=editCharacter><option>שלילי</option><option>חיובי</option></select>
</td><td><center> :עריכת שחקן</tr>
<tr valign=top><td><center><select name=SearchIP><option>שלילי</option><option>חיובי</option></select>
</td><td><center> :חיפוש אייפי</tr>
<tr valign=top><td><center><select name=logPanel><option>שלילי</option><option>חיובי</option></select>
</td><td><center> :לוג פעולות</tr>
<tr valign=top><td><center><select name=editAdmin><option>שלילי</option><option>חיובי</option></select>
</td><td><center> :ניהול הרשאות</tr>
<tr valign=top><td><center><select name=Static><option>שלילי</option><option>חיובי</option></select>
</td><td><center> :צפיה בסטטיסטיקה</tr>
</table>
<center><input type=submit name="addAdmin" value="הוסף אדמין"> <input type=submit name="UP" value="חזור"> 
</form>
<?
if (isset($_POST['addAdmin']))
{
	echo addAdmin($_POST['Username'],$_POST['Password'],$_POST['editAccount'],$_POST['editCharacter'],$_POST['SearchIP'],$_POST['logPanel'],$_POST['editAdmin'],$_POST['Static']);
}
if (isset($_POST['UP']))
{
header('Location: index.php?Page=Home');}
?>
<br><br>
<hr>
<center>
<h3> מחק הרשאות אדמין</h3>
<form method=POST>
<table align=center width=260px>
<tr valign=top><td><center><input type=text name=adminUser></td><td><center> :שם משתמש</tr>
</table><input type=Submit name=Delete value="מחק הרשאות"> <input type=submit name="UP" value="חזור"> </form>
<?
if(isset($_POST['Delete']))
{
	echo deleteAdmin($_POST['adminUser']);
}
if(isset($_POST['UP']))
{
	header('Location: index.php?Page=Home');
}
?>
<br><br>
<hr>
<center>
<h3>הרשאות אדמינים</h3>
<table align=center width=650px>
<tr valign=top>
<td bgcolor=6699FF><center>
עריכת משתמשים</td>
<td bgcolor=6699FF><center>
עריכת שחקנים</td>
<td bgcolor=6699FF><center>
חיפוש אייפי</td>
<td bgcolor=6699FF><center>
לוג פעולות</td>
<td bgcolor=6699FF><center>
סטטיסטיקה</td>
<td bgcolor=6699FF><center>
ניהול הרשאות</td>
<td bgcolor=6699FF>
<center>
אדמין</td>
<? echo allAdmin();}elseif($_GET['Page']=="logOut")
{
		$_SESSION['Username'] = NULL;
		$_SESSION['Password'] =NULL;
		header('Location: ../index.php');

}
?>
</div>

</div>
</body>
</html>