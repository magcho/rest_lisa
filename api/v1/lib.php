<?php
/**
 * 学校があると思ったらfalse、ないならtrue
 * @return [type] [description]
 */
function rest_lisa(){
  $city_name = ["横浜市","川崎市","平塚市","藤沢市","茅ヶ崎市","大和市","海老名市","座間市","綾瀬市","寒川町","大磯町","二宮町","横須賀市","鎌倉市","逗子市","三浦市","葉山町","相模原市","秦野市","厚木市","伊勢原市","愛川町","清川村","南足柄市","中井町","大井町","松田町","山北町","開成町","小田原市","箱根町","真鶴町","湯河原町"];

  $html = file_get_contents('http://www.jma.go.jp/jp/warn/320_table.html');
  preg_match('/<table id=\'WarnTableTable\'>(.*)<\/table>/',$html,$match);

  // やけくそだ
  // 各市町村の行生データテキスト
  preg_match_all('/<td nowrap bgcolor="#dddddd">(<a name="[0-9]{6}"><\/a>|)<a href="\w{1}_[0-9]{7}\.html">(横浜市|川崎市|平塚市|藤沢市|茅ヶ崎市|大和市|海老名市|座間市|綾瀬市|寒川町|大磯町|二宮町|横須賀市|鎌倉市|逗子市|三浦市|葉山町|相模原市|秦野市|厚木市|伊勢原市|愛川町|清川村|南足柄市|中井町|大井町|松田町|山北町|開成町|小田原市|箱根町|真鶴町|湯河原町)<\/a><\/td>(<td class="(wrn|il1|adv|il2)"><\/td>){23}/',$match[1],$row);
  // var_dump($row);

  $warning_info = [];
  $warning_flag['oame'] = false;
  $warning_flag['bouhu'] = false;
  $log = '';
  foreach ($row[0] as $key => $value) {
    // preg_match_all('/(<td class="(wrn|il1)">(●|)<\/td>){7}/',$value);
    preg_match('/(横浜市|川崎市|平塚市|藤沢市|茅ヶ崎市|大和市|海老名市|座間市|綾瀬市|寒川町|大磯町|二宮町|横須賀市|鎌倉市|逗子市|三浦市|葉山町|相模原市|秦野市|厚木市|伊勢原市|愛川町|清川村|南足柄市|中井町|大井町|松田町|山北町|開成町|小田原市|箱根町|真鶴町|湯河原町)/',$value,$city[$key]);
    preg_match('/<td class="wrn">.*$/',$value,$data);
    preg_match('/<td class="wrn"(><|>●<)\/td><td class="wrn"(><|>●<)\/td><td class="wrn"(><|>●<)\/td><td class="wrn"(><|>●<)\/td><td class="wrn"(><|>●<)\/td>/',$data[0],$dot);
    // 警報アルカナ？大雨は1つめ暴風は3つめ大雪は5こめ
    if($dot[1] === ">●<"){
      //大雨警報あり
      $warning_info[$key]['oame'] = true;
      if($warning_flag['oame'] === false){
        $warning_flag['oame'] = true;
      }
    }
    if($dot[3] === ">●<"){
      //暴風あり
      $warning_info[$key]['bouhu'] = true;
      if($warning_flag['bouhu'] === false){
        $warning_flag['bouhu'] = true;
      }
    }
    if($dot[5] === ">●<"){
      //大雪あり
      $warning_info[$key]['oyuki'] = true;
      if($warning_flag['oyuki'] === false){
        $warning_flag['oyuki'] = true;
      }
    }
    // var_dump($city[$key][1]);
    // var_dump($dot);
    // var_dump($data);
  }

  // どの市区町村が勝因か検索
    /**
     * $warning_info[市区町村No.]['oame'] =true 大雨警報あり
     * $warning_info[市区町村No.]['bouhu'] =true 暴風警報あり
     * $warning_info[市区町村No.]['oyuki'] =true 大雪警報あり
     */
  if($warning_flag['bouhu'] && $warning_flag['oame'] || $warning_flag['oyuki']){  //我々の勝ち
    foreach ($warning_info as $key => $value) {
      if($value['oame']){
        $log .= "{$city_name[$key]}に大雨警報が発令されています。";
      }
      if($value['bouhu']){
        $log .= "{$city_name[$key]}に暴風警報が発令されています。";
      }
      if($value['oyuki']){
        $log .="{$city_name[$key]}に大雪警報が発令されています。";
      }
    }
  }

  if($warning_flag['bouhu'] && $warning_flag['oame'] || $warning_flag['oyuki']){
    $return = ['true',$log];
    return $return;
  }else {
    $return = ['false',$log];
    return $return;
  }



}
