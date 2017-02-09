<?php
/**
 * 核心框架
 * User: wang
 * Date: 16-12-21
 * Time: 下午10:57
 */
class Core
{

    //运行框架
    public function run()
    {
        spl_autoload_register([$this,'loadClass']);
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->route();

    }

    //路由处理
    protected function route()
    {
      $controllerName= 'index';
      $action= 'index';
      $param= [];
      $url= isset($_GET['url']) ? $_GET['url'] : false;

      if($url !== false) {
         //拆分url;
         $urlArray= explode('/', $url);
         //删除空键值;
         $urlArray= array_filter($urlArray);
         //获取控制器名
         $controllerName=ucfirst($urlArray[0]);
         //删除第一个元素
         array_shift($urlArray);
         //获取方法名
         $action=$urlArray ? $urlArray[0] : $action;
         //获取url参数
         array_shift($urlArray);
         $param= $urlArray ? $urlArray : $param;
      }
      //实例化控制器
      $controller= $controllerName . 'Controller';
      $dispatch= new $controller($controllerName,$action);
      if(method_exists($controller, $action)) {
         // 执行控制器里的方法
         call_user_func_array([$dispatch,$action], $param);
      } else {
         exit($controller . '控制器不存在');
      }
    }

    //检查自定义全局变量并移除
    protected function unregisterGlobals()
    {
      if(ini_get('register_globals')) {
         $array=['_SESSION','_COOKIE','_GET','_POST','_REQUEST','_SERVER','_ENV'
         ,'_FILES'];
         foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $k => $v) {
               if($v === $GLOBALS[$k]) {
                  unset($GLOBALS[$k]);
               }
            }
         }
      }
    }

    //检查敏感字符并删除
    protected function removeMagicQuotes()
    {
      $_GET= isset($_GET) ? $this->stripSlashesDeep($_GET) : '';
      $_POST= isset($_POST) ? $this->stripSlashesDeep($_POST) : '';
      $_COOKIE= isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
      $_SESSION= isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
    }

    //删除敏感字符
    private function stripSlashesDeep($value)
    {
      $value= is_array($value) ? array_map(array($this,'stripSlashesDeep'),
      $value) : stripslashes($value);
      return $value;
    }

    //检测开发环境
    protected function setReporting()
    {
      if(APP_DEBUG == true) {
         error_reporting(E_ALL);
         ini_set('display_errors', 'On');
      } else {
         error_reporting(E_ALL);
         ini_set('display_errors', 'Off');
         ini_set('log_errors', 'On');
         ini_set('error_log', RUNTIME_PATH,'logs/error.log');
      }
    }

    //自动加载
    static public function loadClass($class)
    {
      $frameworks= FRAME_PATH .$class . '.class.php';
      $controllers= APP_PATH . 'application/controllers/' . $class .
      '.class.php';
      $models= APP_PATH . 'application/models/' . $class . '.class.php';
      if(file_exists($frameworks)) {
         //加载核心框架和基类
         include $frameworks;
      } elseif (file_exists($controllers)) {
         //加载控制器
         include $controllers;
      } elseif (file_exists($models)) {
         //加载模型
         include $models;
      } else {
         //错误信息
         echo 'Is Errors !';
      }

    }
}