<?php
namespace Home\Controller;
use Think\Controller;

class MemberController extends Controller {

	 public function index(){

		if(isset($_SESSION['uname']) && $_SESSION['uname']!=''){
		
		}else{
			$this->error("请登录！",U("Index/log"));
		}

		$this->display("member/index");
    }

}


?>