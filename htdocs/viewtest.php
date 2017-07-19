<?php
# データベース設定☆レシピ260☆（データベースに接続したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
require_once 'database_conf.php';
//データベース接続設定
//$dbServer = '127.0.0.1';
//$dbName = 'sample1';
//$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
//$dbUser = 'test';
//$dbPass = 'pass';
//データベースへの接続
require_once 'h.php';
$db = new PDO($dsn, $dbUser, $dbPass);

//クエリパラメータの取得
$id = $_GET['foo'];//手抜き
//検索実行
$sql = 'SELECT * FROM posts WHERE id = :id';
$prepare = $db->prepare($sql);
$prepare->bindValue(':id', $id, PDO::PARAM_INT);//$sqlの:idの部分に$idを埋め込む
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
//結果の出力
foreach ($result as $person);
$mime = $person['mie'];
$image = base64_encode($person['imgdat']);
echo "<object type='data:${mime};base64,${image}' data="url"></object>";
?>