<?php
class dMath{

    public static function calc($json){
      $ops = json_decode($json,true);
      foreach($ops as $op => $field){
        foreach($ops[$op] as $key => $value){
          if($key == 'group'){
            $res = dMath::findGroup($value);
            $ops[$op] = array(
              "num"=>$res
            );
          }
        }
      }
      $res = dMath::operations($ops);
      return $res;
    }

    public static function findGroup($array){
      $groups = 0;
      foreach($array as $key=>$value){
        if($key == 'group'){
          $groups = 1;
        }
      }

      if($groups == 1){
         dMath::findGroup();
      }
      $res = dMath::operations($array);

      return $res;
    }

    public static function operations($array){
      $op = [];
      $res = 0;
      $lastop = '';
      foreach($array as $ar){
        foreach($ar as $key=>$value){
          if($key == "num"){
            if($lastop == ''){
              $res = $value;
            }elseif($lastop == "add"){
              $res = $res + $value;
            }elseif($lastop == "rest"){
              $res = $res - $value;
            }elseif($lastop == "div"){
              $res = $res / $value;
            }elseif($lastop == "mult"){
              $res = $res * $value;
            }

          }
          if($key == "op"){
            if($value == "add"){
              $lastop = "add";
            }
            if($value == "rest"){
                $lastop = "rest";
            }
            if($value == "div"){
                $lastop = "div";
            }
            if($value == "mult"){
                $lastop = "mult";
            }

          }
        }


      }
      return $res;
    }

}

$json = $_POST['json'];
$json ='{"el0":{"group":{"el1":{"num":56},"el3":{"op":"add"},"el4":{"num":78}}},"el7":{"op":"div"},"el10":{"num":50}}';
echo "el resultado es : ".dMath::calc($json);
