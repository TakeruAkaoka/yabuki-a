    
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
</head>

<body>
<nav id="nav">
<ul>
<li><a href="showall2.php">すべての登録画像画面</a></li>
<li><a href="hyoushi2.php">時間割登録画面</a></li>
<li><a href="hyoushi1.php">登録画面</a></li
<ul>
</nav>

<table width="100%" align="center" frame="void" rules="none" border="2"  bordercolor="#bdb76b" bgcolor="#ffffff" >
<tr>
<td align="center" valign="middle">
<font size="7"color="#000000"><b>PM学科専用闇キャンパスポータル</b></font>
<body>
<h2>新規登録</h2>
<form method="post" action="tweetimage.php" enctype="multipart/form-data">
        <p>学生番号
        <input type="text" name="example1" ></p>
        <p>パスワード
        <input type="password" name="guestpw"></p>
        <p><input type="submit" value="登録">
        <input type="submit" value="リセット"></p>
      </form>


</body>
</html>
