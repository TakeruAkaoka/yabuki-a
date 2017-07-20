 <?php
      if (isset($_POST['example1'])) {
        require_once 'database_conf.php';
        try {
          $db = new PDO($dsn, $dbUser, $dbPass);
          $sql = 'INSERT INTO posts (semesuta, mime, imgdat) VALUES (:semesuta, :mime, :imgdat)';
          $prepare = $db->prepare($sql);

          if (isset($_FILES['imgdat'])) {
            $tmp_name = $_FILES['imgdat']['tmp_name'];
            if ($tmp_name != '') {
              $finfo = new finfo(FILEINFO_MIME_TYPE);
              $type = $finfo->file($tmp_name);
              $file = fopen($_FILES['imgdat']['tmp_name'], 'rb');
              $imgdat = fread($file, $_FILES['imgdat']['size']);
            }
          }

          $semesuta = $_POST['semesuta'];

          $prepare->bindValue(':semesuta', $semesuta, PDO::PARAM_INT);
          $prepare->bindValue(':mime', $type, PDO::PARAM_STR);
          $prepare->bindValue(':imgdat', $imgdat, PDO::PARAM_STR);
          $prepare->execute();
          $id = $db->lastInsertId();
          echo '<p>結果</p>';
        } catch (PDOException $e) {
          echo 'エラーが発生しました。内容: ' . h($e->getkyoukasyo());
        }
      }
?>