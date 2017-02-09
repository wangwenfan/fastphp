<?php
class Sql
{
   protected $_dbHandle;//数据库对象
   protected $_result;
   public    $_prefix;//表前缀
   private   $filter='';
   public function __construct()
   {
         $dbConfig=get_config('db');
         $this->connet($dbConfig);
         $this->_prefix=$dbConfig['prefix'];
   }
   //实例化数据库
    public function connet($dbConfig)
   {
      try{
         $dsn= sprintf("mysql:host=%s;dbname=%s;charset=utf8",
            $dbConfig['dbhost'],$dbConfig['dbname']);
         $option=[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
         $this->_dbHandle=new PDO($dsn,$dbConfig['username'],
            $dbConfig['password'],$option);
      } catch(PDOException $e) {
         exit('错误:' . $e->getMessage());
      }
   }
   /**
    * [where 数组转where语句]
    * @param  array  $where
    * @return string
    */
   public function where($where=[])
   {
       $whereStr='';
      if(empty($where)) return $whereStr;
      foreach ($where as $key => $value) {
         if($whereStr != '') $key=' and '.$key;
         $whereStr.=$key.'='.$value;
      }
      $whereStr='WHERE '.$whereStr;
      return $whereStr;
   }
   /**
    * [query方法执行sql语句]
    * @param  string $sql [sql语句]
    * @return [mix|array]
    */
   public function query($sql='')
   {

      $result=[];
      $data=$this->_dbHandle->query($sql);
      if($data==false){
         $this->errorExport($sql);
      }
      while ($row= $data->fetch()) {
         $result[]=$row;
      }
      return $result;
   }
   /**
    * [errorExport sql语句错误处理]
    * @return [type] [description]
    */
   public function errorExport($sql)
   {
      $errorInfo=$this->_dbHandle->errorInfo();
      echo "<h1>Error:{$errorInfo[1]}!</h1><h3>{$errorInfo[2]}!</h3><h4
      style='color:red;'>SQL: {$sql}</h4>";
   }

}