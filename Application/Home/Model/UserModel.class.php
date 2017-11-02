<?php 
namespace Home\Model;
use Think\Model;
class UserModel extends Model {

   // 3表示所有后， 2 表示更新的时候， 1 表示新增的时候
      protected $_auto = array(
           array('password'     , 'md5', 3, 'function'),   
           array('register_time', 'time', 1 , 'function'),  //新增的时候 插入时间
      );

}

 ?>