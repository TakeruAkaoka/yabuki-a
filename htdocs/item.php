<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>つぶやき</title>
  </head>
  <body>
   <table width="1200" align="center" rules="all" frame="all" border="1" bgcolor="#dcdcdc">
<tr>
<td align="center"><a href="showall2.php"><font size="7" color="000000">時間割表示画面</font></a></td>
<td align="center"><a href="index.htm"><font size="7" color="000000">　トップページへ</font></a></td>
</tr>
</table>
    <div>
      <?php
      if (isset($_GET['id'])) {
        #データベース設定☆レシピ260☆（データベースに接続したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
        require_once 'database_conf.php';
        # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
        require_once 'h.php';
        try {
          #MySQLデータベースに接続します☆レシピ260☆（データベースに接続したい）。
          $db = new PDO($dsn, $dbUser, $dbPass);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          #すべてのつぶやきをデータベースから取得する。
          $sql = 'SELECT * FROM tweets where id=:id';
          $prepare = $db->prepare($sql);
          $prepare->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
          $prepare->execute();
          $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
          #つぶやきを表示する。
          foreach ($result as $tweet) {
            echo h($tweet['body']);
             $body = h($tweet['body']);
          if (isset($tweet['mime'], $tweet['image'])) {//画像がある場合
            $mime = $tweet['mime'];
            $image = base64_encode($tweet['image']);
            echo "<li>${body}<br><img src='data:${mime};base64,${image}'></li>";
          } 
        
        echo '</ul>';
          }
        } catch (PDOException $e) {
          #エラーが発生した場合、PDOException例外がスローされるのでキャッチします。
          echo 'エラーが発生しました。内容: ' . h($e->getMessage());
        }
      }
      ?>
    </div>
   
  </body>
</html>