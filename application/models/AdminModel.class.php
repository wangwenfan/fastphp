<?php
class AdminModel extends Model
{
    public function test()
    {
        // $cc=$this->insert(['username'=>'wangwenfan','password'=>123134123]);
        $cc=$this->select();
        P($cc);die;
        
    }
}