<?php
namespace Admin\Controller;
use Think\Controller;
class ColumnsController extends Controller {
    public function columns(){
		$mod = D("Arctype");
		$count=$mod->count();
		$Page = new \Think\Page($count,10);
		$Page->setConfig('header','条信息');
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$show = $Page->show();		
		$list = $mod->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign("list",$list);
		$this->assign('show',$show);
		$this->display("columns/clist");
	}
	public function add(){
		$this->display("columns/cadd");
	}
	public function inserts(){
		$mod = D("Arctype");
		if(!$mod->create()){
			$this->error($mod->getError());
		}
		if($mod->add()){	
			$this->success("添加成功",U("columns/clist"));		
		}else{
			$this->error("添加失败！");
		}
	}
	public function edit(){
		$id = $_GET['id']+'';
		$mod = D("Arctype");
		$stu = $mod->where('id='.$id)->select();
		$this->assign("vo",$stu);
		
		$this->display("columns/cedir");
	}
	public function update(){
		
		$id = $_POST['id']+'';
		$mod = D("Arctype");
		if(!$mod->where('id='.$id)->create()){
			$this->error($mod->getError());
		}
		if($mod->save()){	
			$this->success("修改成功",U("columns/columns"));		
		}else{
			$this->error("修改失败！");
		}
	}
	public function del(){
		$id = $_GET['id']+'';
		$mod = D("Arctype");
		$m=$mod->delete($id);
		if($m){
			$this->success("成功删除{$m}条信息！",U("columns/columns"));
		}
	}

}