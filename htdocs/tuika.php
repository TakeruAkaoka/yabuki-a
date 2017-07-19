<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>アドレス登録</title>
</head>
<body>
<form action="regist.php" method="post">
  ID：<br />
  <input type="text" name="ID" size="10" value="" /><br />
  先生：<br />
  <input type="text" name="teacher" size="30" value="" /><br />
  科目名：<br />
  <input type="text" name="subject" size="30" value=""><br />
  セメスター：<br />
  <input type="text" name="semesuta" size="30" value=""><br />
  単位数：<br />
  <input type="text" name="tanni" size="30" value=""><br />
  期末：<br />
  <input type="text" name="kimatu" size="30" value=""><br />
  中間：<br />
  <input type="text" name="tyuukan" size="30" value=""><br />
  出席：<br />
  <input type="text" name="syusseki" size="30" value=""><br />
  教科書：<br />
  <input type="text" name="kyoukasyo" size="30" value=""><br />
  同名：<br />
  <input type="text" name="flag" size="30" value=""><br />
    <br />
  <input type="submit" value="登録する" />
</form>
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
          echo '<p>結果</p>';
          echo "<p>追加したレコードのID: " . h($id) . '</p>';
	  echo '<p><a href="kako.php?foo='.h($id).'">'."結果を見る".'</a></p>';
        } catch (PDOException $e) {
          echo 'エラーが発生しました。内容: ' . h($e->getMessage());
        }
      }
      ?>
      <form method="post" action="tweetimage.php" enctype="multipart/form-data">
        <p>画像：<input type="file" name="image"></p>
        <p><input type="submit" value="送信する"></p>
      </form>
    </div>

</body>
</html>