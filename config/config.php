<?php
/**
 * 系统配置文件
 * User: wang
 * Date: 16-12-21
 * Time: 下午10:54
 */
$config= [
   //调试模式
   'debug'     =>true,
   //数据库
   'db'        => [
            'dbhost'    =>'127.0.0.1',
            'dbname'    => 'phpcmsv9',
            'username'  => 'root',
            'password'  => 'root',
            'prefix'    =>'v9_'

   ],
   //文件上传
   'upload'    => [
             'fileType' => '',//文件类型
             'fileSize' => '',//文件大小
             'uploadPath' => '',//上传目录
   ],
];

return $config;