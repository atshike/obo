<?php
namespace Admin\Controller;
use Think\Controller;
class UsersController extends Controller {
    public function users(){
		$mod = D("Uadmin");
		$count=$mod->count();
		$Page = new \Think\Page($count,10);
		$Page->setConfig('header','条信息');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();		
		$list = $mod->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);
		$this->assign('show',$show);
		$this->display("users/ulist");
		/**/
		
	}
	
	public function edit(){
		$id = $_GET['id']+'';
		$mod = D("Uadmin");
		$ar=$mod->where('id='.$id)->select();
		$this->assign("vo",$ar);
		$this->display("users/uedir");		
	}
	public function update(){
		$id=$_POST['id']+'';
		$data['uname']=$_POST['uname'];
		$data['pwd']=md5($_POST['pwd']);
		$data['email']=$_POST['email'];
		$data['logintime']=time();
		$data['loginip']=get_client_ip();

		$mod= D("Uadmin");
		if(!$mod->where('id='.$id)->create($data)){
			$this->error($mod->getError());
		}
		if($mod->save($data)){	
			$this->success("修改成功",U("users/users"));		
		}else{
			$this->error("修改失败！");
		}
		
	}
	public function add(){
		$this->display("users/uadd");
	}
	public function insert(){
	
		$mod = D("Uadmin");
		if(!$mod->create()){
			$this->error($mod->getError());
		}
		if($mod->add()){	
			$this->success("添加成功",U("users/users"));		
		}else{
			$this->error("添加失败！");
		}
	}
	public function del(){
		
		$id = $_GET['id']+'';
		$mod = D("Uadmin");
		$m=$mod->delete($id);
		if($m){
			$this->success("成功删除{$m}条信息！",U("users/users"));
		}
	
	}

}