<?php
/**
*组件类
*/
class Component
{
   //系统配置文件
   public static function sysConfig($key='')
   {
      return get_config($key);
   }

}