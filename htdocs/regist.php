<?php
# h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
require_once 'h.php';
require_once 'database_conf.php';

$con = mysql_connect($dbServer, $dbUser, $dbPass);
if (!$con) {
  exit('データベースに接続できませんでした。');
}
      if (isset($_POST['example1'])) {
        require_once 'database_conf.php';
        require_once 'h.php';
        try {
          $db = new PDO($dsn, $dbUser, $dbPass);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = 'INSERT INTO posts (kyoukasyo, mime, imgdat) VALUES (:message, :mime, :image)';
          $prepare = $db->prepare($sql);
          $prepare->bindValue(':message', $_POST['example1'], PDO::PARAM_STR);
          //☆レシピ266 アップロードされが画像の処理☆
          //データのチェックは省略
          $type = null;
          $image = null;
          if (isset($_FILES['image'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            if ($tmp_name != '') {//ファイルがアップロードされた
              //ファイルタイプを確認する☆レシピ124☆の準備が必要
              $finfo = new finfo(FILEINFO_MIME_TYPE);
              $type = $finfo->file($tmp_name);
              //アップロードされ，一時保管されたファイルを読み出す
              $file = fopen($_FILES['image']['tmp_name'], 'rb');
              $image = fread($file, $_FILES['image']['size']);
            }
          }
          $prepare->bindValue(':mime', $type, PDO::PARAM_STR);
          $prepare->bindValue(':image', $image, PDO::PARAM_STR);
          $prepare->execute();
          $id = $db->lastInsertId();

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