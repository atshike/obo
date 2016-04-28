<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

		
		
		$this->display("index");
	}
	public function header(){
		$this->display("header");
	}
	public function menu(){

		$this->display("menu");
	}

	public function body(){

	}
	public function articles(){
		$mod = D("Archives");
		$count=$mod->count();
		$Page = new \Think\Page($count,20);
		$Page->setConfig('header','条信息');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();		
		$list = $mod->relation(true)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);
		$this->assign('show',$show);
		
		$this->display("articles");
	}
	public function add(){
		
		$typewhere= 'ispart=0 and issend=1';
		$mod=M("Arctype");
		$list=$mod->order('id desc')->where($typewhere)->select();
		$this->assign('atype',$list);

		$this->display("add");
	}
	//添加
	public function insert(){
		$mod = M("Archives");		
		$nod = M("Addonarticle");
		/**/
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =     ''; // 设置附件上传（子）目录 
		$upload->saveName = 'time';
		$info   =   $upload->upload();
		foreach($info as $file){
				$savenames=$file['savepath'].$file['savename'];
			}
		if($savenames!=''){
			$imgurl = "/Uploads/".$savenames;
		}else{
			$imgurl = "/Uploads/obo.png";
		}
		
		$data['litpic'] = $imgurl;
		/**/
		$data['title'] = $_POST['title'];
		$data['typeid'] = $_POST['typeid'];
		$data['keywords'] = $_POST['keywords'];
		$data['voteid'] = $_POST['voteid'];
		if(!$mod->create()){ //MODEL下验证空
			$this->error($mod->getError());
			exit;
		} 
		$nod->create();
			//验证数据库是否已有信息
		$where['title']=$_POST['title'];
		$e=M('Archives');
		$eres=$e->where($where)->getField('title',true);
		if(!empty($eres)){
			 $this->error('信息已存在！');
		}
		//dump($_POST);
		//dump($data);
		$result=$mod -> add($data);   //M 执行
		if(false == $result){       //M 执行判断
			 $this->error('添加失败！');
		}
			
		$modo = M('Archives');
		$list=$modo->order('id desc')->getField('id',1); //获得body aid
		
		$datas['aid']=$list;
		$datas['typeid']=$_POST['typeid'];
		$datas['body']=$_POST['body'];
		$modoo = M('Archives');
		$lt=$modo->order('id desc')->getField('title',1);
		//dump($datas);
		if($lt==$_POST['title'] && $nod -> add($datas)){
			$this->success("添加成功",U("Index/index"),3);	
		}else{
			$this->error("添加失败！");
		}

	}
	 
	//更新
	public function edit(){
		$id = $_GET['id']+'';
		$mod = D("Archives");
		$stu = $mod->relation(true)->where('id='.$id)->select();
		$this->assign("vo",$stu);
		
			$typewhere= 'ispart=0 and issend=1';
			$mod=M("Arctype");
			$list=$mod->order('id desc')->where($typewhere)->select();
			$this->assign('atype',$list);
			
		$this->display("edir");
	}
	 
	//执行更新
	public function update(){	
		$cid=$_POST['id']+''; 
		if(!$cid){
			$this->error("执行错误！");
		}else{
			$modd = M("Archives");
			$nodd = M("Addonarticle");	
			if(empty($_POST['litpic'])){
				if(empty($_POST['litpics'])){
					$imgurl=$_POST['litpics'];
				}else{
					$imgurl = "/Uploads/obo.png";
				}
			}else{
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize   =     3145728 ;// 设置附件上传大小
				$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
				$upload->savePath  =     ''; // 设置附件上传（子）目录 
				$upload->saveName  =	 'time';
				$info   =   $upload->upload();
				foreach($info as $file){
						$savenames=$file['savepath'].$file['savename'];
				}
				$imgurl = "/Uploads/".$savenames;
			}
			$data['litpic'] = $imgurl;
			$data['title'] = $_POST['title'];
			$data['typeid'] = $_POST['typeid'];
			$data['keywords'] = $_POST['keywords'];
			$data['voteid'] = $_POST['voteid'];
			$data['senddate'] = time();
			/*
			$modo = M('Archives');
			$list=$modo->order('id desc')->getField('id',1); //获得body aid		

			$datas['aid']=$list;
			*/
			$datas['typeid']=$_POST['typeid'];
			$datas['body']=$_POST['body'];
		
			$modd->where('id='.$cid)->create($data);
			$nodd->where('aid='.$cid)->create($datas);
			$result=$modd->save($data);
			$result1=$nodd->save($datas);
			if(false !== $result && false !== $result1){		
				$this->success("修改成功",U("Index/articles"));		
			}else{
				
				$this->error("修改失败！");
			}
		}
	}
	 
	public function del(){
		$mod = D("Archives");
		if(isset($_SESSION['uname']) && $_SESSION['uname']!=''){
		$m=$mod->delete($_GET['id']+0);
			$this->success("成功删除{$m}条信息！",U("Index/index"));
		}else{
			$this->error("请登录！",U("Index/log"));
		}
	}
	public function checkName(){
		
		$where['uname']=$_POST['uname'];
			$e=M('Uadmin');
			$eres=$e->where($where)->getField('uname',true);
			if(!empty($eres)){
				 $this->error('信息已存在！');
			}else{
				echo 0;
			}
	}
	public function log(){		
		

		/*		if(!isset($_SESSION['uname'])){			
			 $this->error('你还未登录，请先登录!', false, __APP__.'/log/');
		
		$nowtime = time();
		$s_time = $_SESSION['uname']['logtime'];
		if (($nowtime - $s_time) > 100) {
			unset($_SESSION['uname']);
			$this->error('登录超时，请重新登录', false, __APP__.'/log/'); 
			exit;
		}else{
			$_SESSION['uname']['logtime'] = $nowtime; 
		}
		*/

		$this->display("log");
	}
	public function login(){

	
	$verify = I('param.code','');
	if(!check_verify($verify)){
		$this->error("验证码错误！");
	}else{		
		$uname = I('post.uname'); 
		$pwd = I('post.pwd'); 
		if($uname==''||$pwd==''){
			$this->redirect("login");
		}
		
		$mod = D("Uadmin");
		$where['uname']=$uname;
		$where['pwd']=md5($pwd);
		//dump($where);
		$arr=$mod->where($where)->find();
		if(!$arr||md5($pwd)!=$arr['pwd']){
			$this->error('输入密码错误！');
			
			
		}else{
			$_SESSION['uname']=$uname;
			$_SESSION['id']=$arr['id'];
			$this->success('登录成功！',U("Index/index"));
		}
	}	
		
	
	
	}
	
	public function logout(){
		//$_SESSION['uname']='';
		//unset($_SESSION['uname']);
		session(null);
		$this->success('退出成功！',U("log"));
	}
}