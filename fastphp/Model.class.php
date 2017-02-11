<?php
class Model extends Sql
{
   protected $_new_table=null;
   static protected $_table;
   static protected $_model=null;
   public function __construct()
   {
      //连接数据库
      parent::__construct();
      //设置表名
      if($this->_new_table == null){
        self::$_table=strtolower(substr(get_called_class(), 0,-strlen(__CLASS__)));
      }else{
        self::$_table=$this->_new_table;
      }
   }
   /**
    * [name 实例化数据模型]
    * @param  string $table [表名]
    * @return [object]
    */
   static public function name($table='')
   {
      if(self::$_model==null){
         self::$_model=new self();
      }
      self::$_table=$table;
      return self::$_model;
   }
   /**
    * [select 查询数据]
    * @param  array  $where [查询条件 example:['id'=>1]]
    * @param  string $filed [查询字段]
    * @param  string $order []
    * @param  string $limit []
    * @return array
    */
   public function select($where=[],$filed='*',$order='',$limit='')
   {
      $whereStr=$this->where($where);

      if(!empty($order)) $order='ORDER BY '.$order;

      if(!empty($limit)) $limit='LIMIT '.$limit;

      $sql="SELECT {$filed} FROM ".$this->_prefix.self::$_table."
           {$whereStr} {$order} {$limit}";

      return $this->query($sql);
   }
   /**
    * [insert 插入单条记录]
    * @param  [type] $data
    * @return [bloom|int]
    */
   public function insert($data)
   {
      $keys=join(',',array_keys($data));
      $val_data=array_values($data);

      foreach ($val_data as &$v) {
         if(is_string($v) || is_float($v)){
           $v="'".$v."'";
         }
      }
      $vals=join(',',$val_data);
      $sql="INSERT INTO ".$this->_prefix.self::$_table."
      ({$keys}) VALUES ({$vals})";
      $id=$this->_dbHandle->exec($sql);
      if($id==false){
         $this->errorExport($sql);
      }else{
         return $id;
      }
   }
   /**
    * [update 更新数据]
    * @param  [array] $data [需要修改的数据]
    * @param  [array] $where [条件]
    * @return [string|bloom]        
    */
   public function update($data=[],$where=[])
   {
    $whereStr=$this->where($where);
    $dataStr=$this->arrayInStr($data);
    $sql="UPDATE ".$this->_prefix.self::$_table." SET ".$dataStr.' '.$whereStr;
    $r=$this->_dbHandle->exec($sql);
    if($r==false){
      $this->errorExport($sql);
    }else{
      return true;
    }
   }
  /**
    * [delete 删除数据]
    * @param  [array] $where [条件]
    * @return [bloom]        
    */
   public function delete($where=[])
   {
    $whereStr=$this->where($where);
    $sql="DELETE FROM ".$this->_prefix.self::$_table." ".$whereStr;
    $r=$this->_dbHandle->exec($sql);
    if($r==false){
      $this->errorExport($sql);
    }else{
      return true;
    }
   }

}