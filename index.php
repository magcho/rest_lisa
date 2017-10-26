<?php
require_once('./lib.php');

date_default_timezone_set('Asia/Tokyo');
$hour = date('h');



$i = rest_lisa();
if($i[0] == 'true'){
  //時間処理
  if($hour < 6){
    echo "<h1>学校 is なくなるかも６時まで待とう</h1><br /><br />## 勝因<br />";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    exit();
  }elseif($hour < 8){
    echo "<h1>学校(1限) is ない</h1><br /><br />## 勝因<br />";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    exit();
  }elseif($hour < 11){
    echo "<h1>学校(1,2限) is ない</h1><br /><br />## 勝因<br />";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    exit();
  }elseif($hour >= 11){
    echo "<h1>学校 is ない(今日は休み)</h1><br /><br />## 勝因<br />";
    foreach ($i[1] as $key => $value) {
      echo " - ".$value."<br />";
    }
    exit();
  }




}else{
  echo "<h1>学校 is たぶんある</h1>";
}
