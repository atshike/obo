<?php



function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}


function checklogin(){
  if (!isset($_SESSION['uname'])){
   $this->get_msg('你还未登录，请先登录!', false, __APP__.'/log/');
  }
  //设置超时为30分
  $nowtime = time();
  $s_time = $_SESSION['uname']['logtime'];
  if (($nowtime - $s_time) > 1800) {
   unset($_SESSION['uname']);
   $this->get_msg('登录超时，请重新登录', false, __APP__.'/log/');
  }else{
   $_SESSION['uname']['logtime'] = $nowtime;
  }
 } 