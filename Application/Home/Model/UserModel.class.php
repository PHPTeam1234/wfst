<?php 
namespace Home\Model;
use Think\Model;
class UserModel extends Model {


   // 验证条件： 0 存在字段就验证，  1 必须验证， 2 值不为空的时候验证
   //验证时间： 3表示所有后时候， 2 表示更新的时候， 1 表示新增的时候
   
      protected $_auto = array(
           // array('password'     , 'md5', 3, 'function'),   //由于密码使用盐，故在这里不使用 自动完成
           array('register_time', 'time', 1 , 'function'),  //新增的时候 插入时间
      );


     // 第一个数字为验证条件，第二个为验证时间
      protected $_validate = array(
 
           // array('username', '', 'username 存在', 0, 'unique', 1 ),  //
           array('username', 'require', '用户名不能为空'),
           array('password', 'require', '密码不能为空'),
           // array('password', 'confirmPassword', '两次密码输入不一致', 0, 'confirm'), //
      );

}

 ?>