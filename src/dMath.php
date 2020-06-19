<?php
namespace dionkeldei\dMath;

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
              if($value == 0){
              	$res = 0;
              }else{
              	$res = $res / $value;
              }
              
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
    
    public static function decodeJSON($json){
        if($json == '' || $json == null){
            return '';
        }
        $text = '';
        $array = json_decode($json,true);
        foreach($array as $key => $val){ 
            if(array_key_exists("group",$val)){
                $text.="(";

                foreach($val['group'] as $k => $v){
                    if(array_key_exists("group",$v)){
                    $text.="(";
                    foreach($v['group'] as $ke => $va){
                        $text.=dMath::opDecode($va); 
                    }
                    $text.=")";
                    } 
                   $text.=dMath::opDecode($v);  
                }
                $text.=')';
            }
            $text.=dMath::opDecode($val); 
        }

        return $text;

    }

    public static function opDecode($value){

        if(array_key_exists("op",$value)){
            switch ($value['op']){
                case 'add':
                    return '+';
                    break;
                case 'rest':
                    return '-';
                    break;
                case 'div':
                    return '/';
                    break;
                case 'mult':
                    return '*';
                    break;
                case 'sqr':
                    return '?';
                    break;
                case 'pot':
                    return '^';
                    break;


            }
        }elseif(array_key_exists("num",$value)){
            return $value['num'];
        }
    }

}
 ?>
