<?php
header('content-type: application/json; charset=utf-8');
chdir('./../../');
require_once('./lib.php');
function printJson($json){
  print json_encode($json,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
}
date_default_timezone_set('Asia/Tokyo');
$hour = date('h');



$i = rest_lisa();
if($i[0] == 'true'){
  //時間処理
  if($hour < 6){
    // echo "<h1>学校 is なくなるかも６時まで待とう</h1><br /><br />## 勝因<br />";
    $json['mess'] = "学校 is なくなるかも６時まで待とう";
    $json['code'] = 1;

    foreach ($i[1] as $key => $value) {
      // echo " - ".$value."<br />";
      $json['factor'][] = $value;
    }
    printJson($json);
    exit();
  }elseif($hour < 8){
    // echo "<h1>学校(1限) is ない</h1><br /><br />## 勝因<br />";
    $json['mess'] = "学校(1限) is ない";
    $json['code'] = 2;

    foreach ($i[1] as $key => $value) {
      // echo " - ".$value."<br />";
      $json['factor'][] = $value;
    }
    printJson($json);
    exit();
  }elseif($hour < 11){
    // echo "<h1>学校(1,2限) is ない</h1><br /><br />## 勝因<br />";
    $json['mess'] = "学校(1,2限) is ない";
    $json['code'] = 3;

    foreach ($i[1] as $key => $value) {
      // echo " - ".$value."<br />";
      $json['factor'][] = $value;
    }
    printJson($json);
    exit();
  }elseif($hour >= 11){
    // echo "<h1>学校 is ない(今日は休み)</h1><br /><br />## 勝因<br />";
    $json['mess'] = "学校 is ない(今日は休み)";
    $json['code'] = 4;

    foreach ($i[1] as $key => $value) {
      // echo " - ".$value."<br />";
      $json['factor'][] = $value;
    }
    printJson($json);
    exit();
  }




}else{
  $json['mess'] = "学校 is たぶんある";
  $json['code'] = 5;
  $json['factor'] = 'none';
  printJson($json);
  exit();
}
