<?php
class indexController extends Controller{

    public function index() {       
      // $db=Model::name('admin');
      // var_dump($db);die;
      // $r=$db->update(['username'=>'23432','password'=>23423],['id'=>1]);
        $r=new AdminModel();
        echo $r->test();die;
     
      $this->render();
    }
}