<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-style-Type" content="text/css">
    <title>シラバス・過去問のメニュー</title>
    <link rel="stylesheet"href="style1.css" type="text/css">

  </head>
  <body vlink="red">
  <h1>PM学科専用闇キャンパスポータル</h1>
</form>
    <div id="zure">
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
        $sql = 'SELECT * FROM posts ORDER BY ID';
        $prepare = $db->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        #すべてのつぶやきを表示する。
echo '<table class="yoko">';
		
        foreach ($result as $tweet) {
		$url = 'kako.php?foo=' .h($tweet['ID']);
		if(h($tweet['flag']) == 0) {
echo '<tr><td><a href="' .$url.'">'.h($tweet['teacher']).'</a></td><td class="akaku"><a href="' .$url.'">'.h($tweet['subject']).'</a></td></tr>';
        }
	elseif(h($tweet['flag']) == 1) {
echo '<tr><td><a href="' .$url.'">'.'</a></td><td class="akaku"><a href="' .$url.'">'.h($tweet['subject']).'</a></td></tr>';
	}
	
	}
echo '</table>';
      } catch (PDOException $e) {
        # エラーが発生した場合、PDOException例外がスローされるのでキャッチします。
        echo 'エラーが発生しました。内容: ' . h($e->getMessage());
      }
      ?>
    </div>
		</table>
		<table width="1200" align="center" rules="all" frame="all" border="1" bgcolor="#ffffff">
			<tr>
				<td align="center"><a href="index.htm"><font size="7" color="ff0000"><b>トップページへ</b></font></a></td>
				<td align="center"><a href="PastQuestionsMenu.htm"><font size="7" color="ff0000"><b>過去問メニューへ</b></font></a></td>
			</tr>
		</table>
  </body>
</html>
