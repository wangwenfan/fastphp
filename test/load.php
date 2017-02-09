<?php
class LOAD
{
static function loadClass($class_name)
{
   $filename = $class_name.".class.php";

   if(file_exists($filename)){
  require_once($filename);
 }
}
}
/**
* 设置对象的自动载入
* spl_autoload_register — Register given function as __autoload() implementation
*/
$re= spl_autoload_register(array('LOAD', 'loadClass'));
$a = new Test();//实现自动加载，很多框架就用这种方法自动加载类
