<?php
//データベース接続設定
$dbServer = '127.0.0.1';
$dbName = 'blobtest';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'root';
$dbPass = '';

//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass);

//検索実行
header('Content-type: application/pdf');
$sql = "select * from test where id=1";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

print $row[0]; 
?>