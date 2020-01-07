<?php
namespace dMath

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
            $json = json_encode($ops);
            dMath::calc($json);
          }
        }
      }
      $res = dMath::operations($ops);
      return $res;
    }

    public static function findGroup($array){
      $groups = 0;
      foreach($array as $key=>$value){
        foreach($array[$key] as $elm1 => $field1){
          if($elm1 == 'group'){
            $res = dMath::operations($field1);
            $array[$key] = array(
              "num"=>$res
            );
          }
        }

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
            elseif($lastop == "sqr"){
              $squ = 1/$value;
              $res = pow($res,$squ);
            }
            elseif($lastop == "pot"){
              $res = pow($res,$value);
            }

          }
          if($key == "op"){
              $lastop = $value;
          }
        }


      }
      return $res;
    }

}
 ?>
