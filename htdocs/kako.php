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
foreach ($result as $person)
?>

<!DOCTYPE html>
	<html>
	<head>
		<title><?php echo $person['teacher'];?>先生　<?php echo $person['subject'];?></title>
		<link rel="stylesheet"href="style1.css" type="text/css">
	</head>
	<body>
		<table width="100%" align="center" frame="void" rules="none" border="2"  bordercolor="#bdb76b" bgcolor="#000000" >
			<tr>
				<td align="center" valign="middle">
					<font size="9"color="#ff0000"><b>PM学科専用闇キャンパスポータル</b></font>
				</td>
			</tr>
		</table>
		<br></br>
		<br></br>
		<table width="1000px" align="center" rules="none" frame="void" border="none" bgcolor="transparent">
			<tr>
				<th>
					<font size="7"color="ff0000"><b><?php echo $person['subject'];
          echo "<br/>";
          echo $person['teacher'];?>先生</b></font>
				</th>
			</tr>
		</table>
		<br></br>
		<style type="text/css">
			.table3 {
				width:90%;
				font-size:30px;
				border-collapse: collapse;
				background-color:#ffffff;
			}
		</style>
		<div>
		<table class="table3" border=1 align="center" >
			<tr><td>科目名</td><td colspan="2"><?php echo $person['subject'];?></td></tr>
			<tr><td>担当者</td><td colspan="2"><?php echo $person['teacher'];?>先生</td></tr>
			<tr><td>開講学期</td><td colspan="2"><?php echo $person['semesuta'];?>セメスター</td></tr>
			<tr><td>単位数</td><td colspan="2"><?php echo $person['tanni'];?></td></tr>
			<tr><td colspan="3">評価基準</td></tr>
			<tr><td>期末試験<?php echo $person['kimatu'];?>%</td>
				<td>中間試験<?php echo $person['tyuukan'];?>%</td><td>提出物(1回)20%</td></tr>
			<tr><td>出席</td><td colspan="2">5回以上欠席した場合は単位を取得できない</td></tr>
			<tr><td>教科書・参考書</td><td colspan="2">特になし</td></tr>
		</table>
		</div>
		<br></br>
		<table width="1000px" align="center" rules="none" frame="void" border="none" bgcolor="transparent">
			<tr>
				<th>
					<font size="6"color="ff0000"><b>過去問</b></font>
				</th>
			</tr>
		</table>
		<br></br>
		<table align="center"  height="50">
			<tr>
				<td align="center">
<?php
$mime = $person['mime'];
$image = base64_encode($person['imgdat']);
echo "<img src='data:${mime};base64,${image}'>";
?>
			</tr>
		</table>
		<table width="1200" align="center" rules="all" frame="all" border="1" bgcolor="#000000">
			<tr>
				<td align="center"><a href="index.htm"><font size="7" color="ff0000">トップページへ</font></a></td>
				<td align="center"><a href="PastQuestionsMenu.htm"><font size="7" color="ff0000">　過去問メニューへ</font></a></td>
			</tr>
		</table>
	</body>
</html>
