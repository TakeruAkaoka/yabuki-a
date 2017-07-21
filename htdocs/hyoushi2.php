    
      <?php
      # データベース設定を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'database_conf.php';
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます。
      require_once 'h.php';
      try {
        # MySQLデータベースに接続します。
        $db = new PDO($dsn, $dbUser, $dbPass);
        # プリペアドステートメントのエミュレーションを無効にします。
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        # エラーが発生した場合、例外☆レシピ169☆（例外処理とは何ですか？）がスローされるようにします。
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '';
      } catch (PDOException $e) {
        # 接続できない場合、PDOException例外がスローされるのでキャッチします。
        echo ' 理由: ' . h($e->getMessage());
      }
      ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-style-Type" dontent="text/css">
<title>PM学科専用闇キャンパスポータル</title>
<link rel="stylesheet"href="style1.css" type="text/css">
		<style type="text/css">a { text-decoration: none; }</style>

</head>

<body vlink="red">

<table width="100%" align="center" frame="void" rules="none" border="2"  bordercolor="#bdb76b" bgcolor="#000000" >
<tr>
<td align="center" valign="middle">
<font size="7"color="#ff0000"><b>PM学科専用闇キャンパスポータル</b></font>
</td>
</tr>

</table>
<nav id="nav">
<ul>
<li><a href="showall2.php">すべての登録画像画面</a></li>
<li><a href="hyoushi2.php">時間割登録画面</a></li>
<li><a href="hyoushi1.php">登録画面</a></li
<ul>
</nav>
<div>
      <?php
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'h.php';
      if (isset($_POST['example1'])) {
        require_once 'database_conf.php';
        require_once 'h.php';
        try {
          $db = new PDO($dsn, $dbUser, $dbPass);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = 'INSERT INTO tweets (body, mime, image) VALUES (:message, :mime, :image)';
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
          echo '<p>結果</p>';
          echo "<p>追加したレコードのID: " . h($id) . '</p>';
          echo "<p><a href='showallimage.php'>確認</a></p>";
        } catch (PDOException $e) {
          echo 'エラーが発生しました。内容: ' . h($e->getMessage());
        }
      }
      ?>
      <br>
      <br>
      <form method="post" action="tweetimage.php" enctype="multipart/form-data">
        <p>時間割名
          <input type="text" name="example1" value="" autofocus></p>
        <p>画像を選択：<input type="file" name="image"></p>
        <p><input type="submit" value="送信する"></p>
      </form>
    </div>
  


</body>
</html>
