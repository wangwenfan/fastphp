<?php
/**
 * 视图基类
 */
class View
{
   protected $variables=[];
   protected $_controller;
   protected $_action;
   public function __construct($controller,$action)
   {
      $this->_controller= $controller;
      $this->_action= $action;
   }

   //模板赋值
   public function assign($name,$value)
   {
      $this->variables[$name]=$value;
   }

   //渲染视图
   public function render()
   {
      extract($this->variables);
      $defaultHeader= APP_PATH . 'application/views/header.php';
      $defaultFooter= APP_PATH . 'application/views/footer.php';
      $defaultLayout= APP_PATH . 'application/views/layout.php';

      $controllerHeader= APP_PATH . 'application/views/' . $this->_controller.
      '/headre.php';
      $controllerFooter= APP_PATH . 'application/views/' . $this->_controller.
      '/footer.php';
      $controllerLayout= APP_PATH . 'application/views/'. $this->_controller .'/'
      . $this->_action.'.php';
      //页头文件
      if(file_exists($controllerHeader)) {
         include $controllerHeader;
      } else {
         include $defaultHeader;
      }
      //内容文件
      if(file_exists($controllerLayout)) {
         include $controllerLayout;
      } else {
         include $defaultLayout;
      }
      //页脚文件
      if(file_exists($controllerFooter)) {
         include $controllerFooter;
      } else {
         include $defaultFooter;
      }

   }
}