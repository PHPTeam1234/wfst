<?php 
namespace Home\Widget;
use Think\Controller;
class FooterWidget extends Controller{
    //展示脚步
    public function footer(){
    	$this->display('Footer:footer');
    }
}
?>
