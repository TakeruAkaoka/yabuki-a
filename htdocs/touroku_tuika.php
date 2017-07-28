<?php

    //「autoload.php」読み込み
    //「twitteroauth/」フォルダは本プログラムと同階層に配置
    require_once dirname(__FILE__) . '/twitteroauth/autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

if (isset($_POST['subject']) && isset($_FILES['imgdat'])) {
  require_once 'database_conf.php';

  $db = new PDO($dsn, $dbUser, $dbPass);
  $sql = 'INSERT INTO posts (subject,teacher,semesuta,tanni,kimatu,tyuukan,kyoukasyo,syusseki,teisyutu,kana, imgdat) VALUES (:subject,:teacher,:semesuta,:tanni,:kimatu,:tyuukan,:kyoukasyo,:syusseki,:teisyutu,:kana, :imgdat)';
  $prepare = $db->prepare($sql);

  $tmp_name = $_FILES['imgdat']['tmp_name'];
  if ($tmp_name != '') {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $type = $finfo->file($tmp_name);
    $file = fopen($_FILES['imgdat']['tmp_name'], 'rb');
    $imgdat = fread($file, $_FILES['imgdat']['size']);
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
  //$mime = $_POST['mime'];
  $kana = $_POST['kana'];

  $prepare->bindValue(':subject', $subject, PDO::PARAM_STR);
  $prepare->bindValue(':teacher', $teacher, PDO::PARAM_STR);
  $prepare->bindValue(':semesuta', $semesuta, PDO::PARAM_INT);
  $prepare->bindValue(':tanni', $tanni, PDO::PARAM_STR);
  $prepare->bindValue(':kimatu', $kimatu, PDO::PARAM_INT);
  $prepare->bindValue(':tyuukan', $tyuukan, PDO::PARAM_INT);
  $prepare->bindValue(':kyoukasyo', $kyoukasyo, PDO::PARAM_STR);          
  $prepare->bindValue(':syusseki', $syusseki, PDO::PARAM_INT);
  $prepare->bindValue(':teisyutu', $teisyutu, PDO::PARAM_INT);
  //$prepare->bindValue(':mime', $type, PDO::PARAM_STR);
  $prepare->bindValue(':kana', $kana, PDO::PARAM_STR);
  $prepare->bindValue(':imgdat', $imgdat, PDO::PARAM_STR);             
  $prepare->execute();
  $id = $db->lastInsertId();
  echo '<p> 登録完了</p>';
  echo '<a href="select.php">過去問選択画面へ</a>';

    // 「Consumer key」値
    $ck = "IJgKmXRVKBkTXsuEQpTI0LeJr";
    // 「Consumer secret」値
    $cs = "LOnaRkAYxFNXsjIvRtAglSvnoICsO3zOW3erdgNoxzmRCKoMMn";
    // 「Access Token」値
    $at = "871578191344705536-V2oBBIPpi3DTofuXBEVjiLLHyR64Xo3";
    // 「Access Token Secret」値
    $ats = "cHzrK01JQpMhHBhoG5xYJQJEZ2C8CFyHvD2f0odWItGE4";

    //リクエストを投げる先（固定値）
    //※前の「https://api.twitter.com/1.1/」と後ろの「.json」は
    //　TwitterOAuth内で勝手にくっつくのでいらない
//    $url = "https://api.twitter.com/1.1/statuses/update.json";
    $url = "statuses/update";

    //投稿する文言
    $postMsg = "$teacher"."・"."$subject"."が追加されました。";

    // OAuthオブジェクト生成
    $toa = new TwitterOAuth($ck,$cs,$at,$ats);

    //投稿
    $res = $toa->post($url, array("status" => "$postMsg"));


    // レスポンス表示
    var_dump($res);

} else {
  echo '失敗';
}
?>
