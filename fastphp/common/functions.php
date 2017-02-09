<?php
/**
 * 系统公共函数
 */

/**
 * [get_config 读写配置文件]
 * @param  string $key [config数组键名(key.key....)]
 * @param  string $val [config数组键值]
 * @return [type]      [mix]
 */
function get_config($key='',$val=''){
   $config= require APP_PATH . 'config/config.php';
   $info=explode('.', $key);
   $getValue=$config;
   if(!empty($val) && !empty($key)){
      return $config[$key]=$val;
   }
   if(empty($key)){
      return $config;
   }else{
      foreach ($info as $k => $v) {
            $getValue=$getValue[$v];
      }
      if($getValue){
         return $getValue;
      }else{
         return false;
      }

   }

}

function P($data){
   echo "<pre>";
   print_r($data);
   echo "</pre>";
}

