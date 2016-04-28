<?php
namespace Home\Model;
use Think\Model;
	class UadminModel extends Model{
	
		protected $_auto=array(
			//array('logintime','time',1,'function'),
			//array('senddate','time',2,'function'),	
			//array('uid','getId',1,'callback'),

			array("pwd","md5",3,'function'),  
 
		
		);
		
		protected $_map = array(
			'name'=>'uname',
		);
		
		protected $_validate = array(
			 //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
			 array('uname','require','用户名必须填写！'),
			 array('uname','/^\w{6,8}$/','用户名格式错误！'),
			 array('uname','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
			 array('pwd','require','密码必须填写！'),
			 array('pwd2','pwd','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
			 array('email','email','邮箱不正确'),
		);
	
	}
?>