<?php
/////////////////////////////////////////הגנות//////////////////
$xa = getenv('REMOTE_ADDR');
$badwords = array(";","'","\"","*","union","x:","x:\#","delete","///","from|xp_|execute|exec|sp_executesql|sp_|select|insert|delete|where| drop table|show tables|#|\*|","DELETE","insert",","|"x'; U\PDATE Character S\ET level=99;-\-","x';U\PDATE Account S\ET ugradeid=255;-\-","x';U\PDATE Account D\ROP ugradeid=255;-\-","x';U\PDATE Account D\ROP ",",W\\HERE 1=1;-\\-","z'; U\PDATE Account S\ET ugradeid=char","update","drop","sele","memb","set","$","res3t","wareh" ,"%","--"); 
foreach($_POST as $username) 
foreach($badwords as $word) 
if(substr_count($value, $word) > 0) 
die("<script>alert('Anti Sql Injection'); **********''</script>");
?>
<?php

$ip = $_SERVER['REMOTE_ADDR'];

$time = date("l dS of F Y h:i:s A");

$script = $_SERVER[PATH_TRANSLATED];


 

$sql_inject_1 = array(";","'","%",'"'); #Whoth need replace

$sql_inject_2 = array("", "","","&quot;"); #To wont replace

$GET_KEY = array_keys($_GET); #array keys from $_GET

$POST_KEY = array_keys($_POST); #array keys from $_POST

$COOKIE_KEY = array_keys($_COOKIE); #array keys from $_COOKIE

/*begin clear $_GET */

for($i=0;$i<count($GET_KEY);$i++)

{

$real_get[$i] = $_GET[$GET_KEY[$i]];

$_GET[$GET_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_GET[$GET_KEY[$i]]));

if($real_get[$i] != $_GET[$GET_KEY[$i]])

{



}

}

/*end clear $_GET */

/*begin clear $_POST */

for($i=0;$i<count($POST_KEY);$i++)

{

$real_post[$i] = $_POST[$POST_KEY[$i]];

$_POST[$POST_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_POST[$POST_KEY[$i]]));

if($real_post[$i] != $_POST[$POST_KEY[$i]])

{


}

}

/*end clear $_POST */

/*begin clear $_COOKIE */

for($i=0;$i<count($COOKIE_KEY);$i++)

{

$real_cookie[$i] = $_COOKIE[$COOKIE_KEY[$i]];

$_COOKIE[$COOKIE_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_COOKIE[$COOKIE_KEY[$i]]));

if($real_cookie[$i] != $_COOKIE[$COOKIE_KEY[$i]])

{


}

}

 

/*end clear $_COOKIE */



?>