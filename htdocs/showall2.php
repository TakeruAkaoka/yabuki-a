<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>時間割表示画面</title>
    <link rel="stylesheet"href="style1.css" type="text/css">
  </head>
  <body vlink="red">

<table width="1000" align="center" frame="void" rules="none" border="2"  bordercolor="#bdb76b" bgcolor="#000000" >
<tr>
<td align="center" valign="middle">
<font size="7"color="#ff0000"><b>PM学科専用闇キャンパスポータル</b></font>
</td>
</tr>
</table>

<br>

		<table width="1000px" align="center" rules="none" frame="void" border="none" bgcolor="transparent">
			<tr>
				<th>
				
					<font size="6"color="000000"><div class="akaku"><b>【すべての登録画像表示画面】</b></div></font>
				</th>
			</tr>
		</table>
<hr>
<br>
  <nav id="nav">
<ul>
<table align="center"  height="50">
			<tr>
			
				<td align="center"><font size="7" color="000000"><b><a href="hyoushi2.php">時間割登録画面</a><b></font></td>
			</tr>
			
		</table>
		
   
<ul>
</nav>

    <div align="center">
      <?php
      # データベース設定☆レシピ260☆（データベースに接続したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'database_conf.php';
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'h.php';
      try {
        # MySQLデータベースに接続します☆レシピ260☆（データベースに接続したい）。
        $db = new PDO($dsn, $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #すべてのつぶやきをデータベースから取得する。
        $sql = 'SELECT * FROM tweets';
        $prepare = $db->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        #すべてのつぶやきを表示する。
        echo '<ul>';
        foreach ($result as $tweet) {
          $id = $tweet['id'];
          $body = h($tweet['body']);
          echo "<a href='item.php?id=${id}'>${body}　　</a>";
        }
        echo '</ul>';
      } catch (PDOException $e) {
        # エラーが発生した場合、PDOException例外がスローされるのでキャッチします。
        echo 'エラーが発生しました。内容: ' . h($e->getMessage());
      }
      ?>
    </div>
    		<table width="380" align="center" rules="all" frame="all" border="1" bgcolor="#ffffff">
			<tr>
				<td align="center"><a href="index.htm"><font size="7" color="ff0000"><b>トップページへ</b></font></a></td>
			</tr>
		</table>

  </body>
</html>