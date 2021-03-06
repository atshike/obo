<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
	
		$mod = D("Archives");
		$count=$mod->count();//统计总数
		$Page = new \Think\Page($count,20);
		$Page->setConfig('header','条信息');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();		
		$list = $mod->relation(true)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);
		$this->assign('show',$show);
		
		$hit = D("Archives");
		$hit=$hit->order('click desc')->limit(10)->select();
		$this->assign("hit",$hit);
		
		$typewhere= 'ispart=0 and issend=1';
		$arc=M("Arctype");
		$typ=$arc->order('id desc')->where($typewhere)->select();
		$this->assign('atype',$typ);
		
	   $this->display("index");
    }
	
	public function listi(){
		$mod=D("Archives");
		$stu = I('get.typeid'); 
		$count=$mod->where('typeid='.$stu)->count();
		$Page = new \Think\Page($count,30);
		$Page->setConfig('header','条信息');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();		
		$list = $mod->relation(true)->where('typeid='.$stu)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);
		$this->assign('show',$show);
		
		$hit = D("Archives");
		$hit=$hit->order('click desc')->limit(10)->select();
		$this->assign("hit",$hit);
		
		$typewhere= 'ispart=0 and issend=1';
		$arc=M("Arctype");
		$typ=$arc->order('id desc')->where($typewhere)->select();
		$this->assign('atype',$typ);

		$this->display("list");
	}
	
	public function showm(){
		$mod=D("Archives");
		$stu = I('get.id'); 
		$show=$mod->relation(true)->where('id='.$stu)->select();
		//dump($show);
		$this->assign('show',$show);
		
		$b=$stu+1; //下一条
		$sa=$mod->relation(true)->where('id='.$b)->select();
		$this->assign('sa',$sa);
		
		$c=$stu-1; //上一条
		$sc=$mod->relation(true)->where('id='.$c)->select();
		$this->assign('sc',$sc);
		
		$this->display("show");
	}
	public function search(){
		
		$where=array();
		if(!empty($_GET['q'])){
			$wh['title'] = array("like","%{$_GET['q']}%");
			$wh['keywords'] = array("like","%{$_GET['q']}%");
			$wh['_logic']='or';
			$where['_complex']=$wh;
			
		}
		$mod = D("Archives");
		$count=$mod->where($where)->count();
		if ($count > 0){
		$Page = new \Think\Page($count,30);
		$Page->setConfig('header','条信息');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();		
		$list = $mod->relation(true)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);

		$this->assign('atype',$typ);
		}else{
			
		}
		$this->display("search");
	}
		public function add(){
		if(isset($_SESSION['uname']) && $_SESSION['uname']!=''){
		
		$typewhere= 'ispart=0 and issend=1';
		$mod=M("Arctype");
		$list=$mod->order('id desc')->where($typewhere)->select();
		$this->assign('atype',$list);

		}else{
			$this->error("请登录后添加！",U("Index/log"));
		}
		$this->display("add");
	}
	//添加
	public function insert(){
			$verify = I('param.code','');
		if(!check_verify($verify)){
			$this->error("验证码错误！");
			exit;
		}
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
		$verify = I('param.code','');
		if(!check_verify($verify)){
			$this->error("验证码错误！");
			exit;
		}
		$cid=$_POST['id']+''; 
		if(!$cid){
			$this->error("执行错误！");
		}else{
			$modd = M("Archives");
			$nodd = M("Addonarticle");	
			if(empty($_POST['litpic'])){
				$imgurl=$_POST['litpics'];
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
				if($savenames!=''){
					$imgurl = "/Uploads/".$savenames;
				}else{
					$imgurl = "/Uploads/obo.png";
				}
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
				$this->success("修改成功",U("Index/index"));		
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
	
	//注册表单
	public function reg(){
		$this->display(reg);
	}
	//注册表单处理
	public function regin(){
		$verify = I('param.code','');
		if(!check_verify($verify)){
			$this->error("验证码错误！");
			exit;
		}
		
		$mod = D("Uadmin");
		if(!$mod->create()){
			$this->error($mod->getError());
		}
		if($mod->add()){	
			$_SESSION['uname']=$_POST['name'];
			$this->success("注册成功",U("Index/index"));		
		}else{
			$this->error("添加失败！");
		}
	}
		public function log(){
		if($_SESSION['uname']!=''){
		//$this->success("",U("Stu/index"));
			$this->redirect('Index/index');
		}else{
			$this->display(log);
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
		$_SESSION['uname']='';
		$this->success('退出成功！',U("Index/index"));
	}
	
	public function bBack(){
		//分享
        $url='http://api.share.baidu.com/getnum?url=URL&callback=bdShare.fn._getShare&type=share';
        $html=file_get_contents($url);
        echo($html)."<br/>";
        $v=explode(",",$html);
        echo $v[2]."<br/>";
        $v2=$v[2];
        $v3=explode('"',$v2);
        echo $v3[1];
	}
}
