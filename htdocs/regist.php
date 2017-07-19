<?php
require_once 'database_conf.php';

$con = mysql_connect($dbServer, $dbUser, $dbPass);
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysql_select_db($dbName, $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}

$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

$ID   = $_REQUEST['ID'];
$teacher = $_REQUEST['teacher'];
$subject  = $_REQUEST['subject'];
$semesuta   = $_REQUEST['semesuta'];
$tanni = $_REQUEST['tanni'];
$kimatu  = $_REQUEST['kimatu'];
$tyuukan   = $_REQUEST['tyuukan'];
$syusseki = $_REQUEST['syusseki'];
$kyoukasyo  = $_REQUEST['kyoukasyo'];
$flag  = $_REQUEST['flag'];


$result = mysql_query("INSERT INTO posts(ID, teacher, subject,semesuta,tanni,kimatu,tyuukan,syusseki,kyoukasyo,flag) 
	VALUES('$ID', '$teacher', '$subject','$semesuta','$tanni','$kimatu','$tyuukan','$syusseki','$kyoukasyo','$flag')", $con);
if (!$result) {
  exit('データを登録できませんでした。');
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
<p>登録が完了しました。<br />
<a href="index.htm">TOP画面へ</a></p>
</body>
</html>