﻿<?php
//データベース接続設定
require_once 'database_conf.php';
//$dbServer = '127.0.0.1';
//$dbName = 'kensaku';
//$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
//$dbUser = 'k';
//$dbPass = '12345';
//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass);

//クエリパラメータの取得
$id = $_GET['foo'];//手抜き
//検索実行
$sql = 'SELECT * FROM sensei WHERE id = :id';
$prepare = $db->prepare($sql);
$prepare->bindValue(':id', $id, PDO::PARAM_INT);//$sqlの:idの部分に$idを埋め込む
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
//結果の出力
foreach ($result as $person)
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-style-Type" dontent="text/css">
<title>PM学科専用闇キャンパスポータル</title>
<link rel="stylesheet"href="style1.css" type="text/css">
</head>

<body link="#000000" vlink="#000000" alink="000000">

<table width="1000" align="center" frame="void" rules="none" border="2"  bordercolor="#bdb76b" bgcolor="#ffffff" >
<tr>
<td align="center" valign="middle">
<font size="7"color="#000000"><b>PM学科専用闇キャンパスポータル</b></font>
</td>
</tr>
</table>

<br>


	<table width="1000px" align="center" rules="none" frame="void" border="none" bgcolor="transparent">
			<tr>
				<th>
					<p id="komidashi"><b>過去の演習の成果物</b></p>
				</th>

			</tr>
		</table>

<hr>
<br>
	<table width="1000px" align="center" rules="none" frame="void" border="none" bgcolor="transparent">
			<tr>
				<th>
					<p id="komidashi"><b>2年前期・PM実験</b></p>
				</th>

			</tr>
		</table>
<br>
	<table width="500px" align="center" rules="none" frame="void" border="none" bgcolor="transparent">
			<tr>
				<th>
					<p id="komidashi"><b><?php echo $person['teacher'];?>研究室</b></p>
				</th>
<th>
					<p id="komidashi"><b><?php echo $person['gr'];?>グループ</b></p>
				</th>

			</tr>
		</table>
   

<br>
<br>


<table align="center" width="1000" height="50" border="0" >
			<tr>
				<td align="center"><p id="komidashi"><b>発表パワーポイント<b></p></td>

			</tr>
		</table>
 <br>
 <br>
		<table align="center"  height="50">
			<tr>
				<td align="center">
<?php
$mime = $person['mime'];
$image = base64_encode($person['img']);
echo "<img src='data:${mime};base64,${image}'>";
?>
			</tr>
		</table>


<br>
<br>
<br>
<hr>
<br>
<br>
<table width="1200" align="center" rules="all" frame="all" border="1" bgcolor="#ffffff">
<tr>
<td align="center"><a href="ArtifactsMenu.php"><font size="7" color="ff0000">成果物メニューへ</font></a></td>
<td align="center"><a href="index.htm"><font size="7" color="ff0000">　トップページへ</font></a></td>
</tr>
</table>
<br>

</body>
</html>
