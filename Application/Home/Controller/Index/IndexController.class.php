<?php
namespace Home\Controller\Index;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }


    public function index1(){
    	$this -> display();
    }

    public function index2(){
        $this -> display();
    }

    public function about(){
    	$this -> display();
    }

    public function blog(){
    	$this -> display();
    }

    public function blog_alternate(){
    	$this -> display();
    }

    public function blog_single(){
    	$this -> display();
    }

    public function buttons_tables(){
    	$this -> display();
    }

    public function contact(){
    	$this -> display();
    }

    public function fullwidth_columns(){
    	$this -> display();
    }

    public function images_dropcaps(){
    	$this -> display();
    }

    public function list_blockquotes(){
    	$this -> display();
    }

    public function portfolio_1col(){
    	$this -> display();
    }

    public function portfolio_2col(){
    	$this -> display();
    }

    public function portfolio_3col(){
    	$this -> display();
    }

    public function portfolio_4col(){
    	$this -> display();
    }

    public function portfolio_details(){
    	$this -> display();
    }

    public function tabs_toggles(){
    	$this -> display();
    }

    public function typography(){
        header("Content-Type: text/html;charset=utf-8"); 
    	$shopPortalDAO = M("shop_portal");
    	$shopPortal = $shopPortalDAO->order('show_rank')->select();
        for($i = 0; $i < count($shopPortal); $i++ ){
            $shopPortal[$i]['web_desc'] = htmlspecialchars_decode($shopPortal[$i]['web_desc']);
        }
    	$this->assign('websPortal', $shopPortal);
    	$this -> display();
    }

    
}