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

          $subject = $_POST['subject'];
          $teacher = $_POST['teacher'];
          $semesuta = $_POST['semesuta'];
          $tanni = $_POST['tanni'];
          $kimatu = $_POST['kimatu'];
          $tyuukan = $_POST['tyuukan'];
          $kyoukasyo = $_POST['kyoukasyo'];
          $syusseki = $_POST['syusseki'];
          $teisyutu = $_POST['teisyutu'];
          $mime = $_POST['mime'];
          $flag = $_POST['flag'];
              
          $prepare->bindValue(':subject', $subject, PDO::PARAM_INT);
          $prepare->bindValue(':teacher', $teacher, PDO::PARAM_STR);
          $prepare->bindValue(':imgdat', $imgdat, PDO::PARAM_STR);
          $prepare->bindValue(':semesuta', $semesuta, PDO::PARAM_INT);
          $prepare->bindValue(':mime', $type, PDO::PARAM_STR);
          $prepare->bindValue(':kimatu', $kimatu, PDO::PARAM_INT);
          $prepare->bindValue(':tyuukan', $tyuukan, PDO::PARAM_STR);
          $prepare->bindValue(':kyoukasyo', $kyoukasyo, PDO::PARAM_STR);          
          $prepare->bindValue(':syusseki', $syusseki, PDO::PARAM_STR);
          $prepare->bindValue(':teisyutu', $teisyutu, PDO::PARAM_INT);
          $prepare->bindValue(':flag', $flag, PDO::PARAM_STR);
          $prepare->execute();
          $id = $db->lastInsertId();
          echo '<p>結果</p>';
        } catch (PDOException $e) {
          echo 'エラーが発生しました。内容: ' . h($e->getkyoukasyo());
        }
      }
?>
