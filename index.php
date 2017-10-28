<!DOCTYPE html>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108743341-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108743341-1');
</script>

    <meta charset="utf-8">
    <title>rest_lisa</title>
  </head>
  <style type="text/css">
    h1{
      font-size: 3em;
    }
  </style>
  <body>
    <center>
<?php
require_once('./lib.php');

date_default_timezone_set('Asia/Tokyo');
$hour = date('h');



$i = rest_lisa();
if($i[0] == 'true'){
  //時間処理
  if($hour < 6){
    echo "<h1>学校 is たぶんなくなるかも６時まで待とう</h1><br /><br /><h2>## 現在発令中の情報</h2>";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    // exit();
  }elseif($hour < 8){
    echo "<h1>学校(1限) is たぶんない</h1><br /><br /><h2>## 勝因</h2>";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    // exit();
  }elseif($hour < 11){
    echo "<h1>学校(1,2限) is たぶんない</h1><br /><br /><h2>## 勝因</h2>";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    // exit();
  }elseif($hour >= 11){
    echo "<h1>学校 is たぶんない(今日は休み)</h1><br /><br /><h2>## 勝因</h2>";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    // exit();
  }




}else{
  echo "<h1>学校 is たぶんある</h1>";
}

?>
<h2>## 注意</h2>
<p>※MagChoが作ったものでいかなる損害があっても責任とかとりません、<br>
  ※自己責任でどうぞ。 情報は簡易的なものです、<br>
  ※必ず複数かつ正確な情報を確認してください。
</p>
<p>Google Analytics導入してます。</p>
<p>APIもあるよ -> <a href="./api/v1/">API</a></p>
<p>詳しくは -> <a href="https://github.com/magcho/rest_lisa">Github</a></p>
<p>copyright©︎ MagCho 2017-</p>
</center>
</body>
</html>
