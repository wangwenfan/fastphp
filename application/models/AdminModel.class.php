<?php
class AdminModel extends Model
{
    public function test()
    {
        $cc=$this->delete(['id'=>1]);
        P($cc);die;
        
    }
}