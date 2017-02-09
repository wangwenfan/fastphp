<?php
/**
 * 控制器基类
 */
class Controller
{
   protected $_controller;
   protected $_action;
   protected $_view;
   protected $systemConfig;

   //初始化参数并实例化模型
   public function __construct($controller,$action)
   {
      $this->_controller= $controller;
      $this->_action= $action;
      $this->view= new View($controller,$action);
      $this->systemConfig=Component::sysConfig();
   }

   //模板赋值
   public function assign($name,$value)
   {
      $this->view->_assign($name,$value);
   }

   //渲染模板
   public function render()
   {
      $this->view->render();
   }

}