<?php
  header('Content-Type: text/html; charset=UTF-8');
  $url = $_POST['link'];
  echo '<a href="http://yabukia.pm-chiba.tech/' .$url.'">管理者画面</a>';
  echo '<br>';
  echo '<a href="index.htm">トップページへ</a>';
?>
