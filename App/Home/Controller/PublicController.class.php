<?php
namespace Home\Controller;
use Think\Controller;


class PublicController extends Controller{
	public function code(){
	
		ob_clean();
		$config =    array(
			'fontSize'    =>    15,    // 验证码字体大小
			'length'      =>    2,     // 验证码位数
			'useNoise'    =>    true, // 关闭验证码杂点
			'imageW'	  =>	60,
			'imageH'	  =>	25,
			'useZh'		  =>	false,
			'useCurve'	  =>	false,
			'expire'	  =>	60,
		);
		$Verify = new \Think\Verify($config);
		$Verify->codeSet = '0123456789'; 
		$Verify->entry();
	}



}

?>