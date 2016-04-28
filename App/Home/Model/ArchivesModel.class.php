<?php

namespace Home\Model;
use Think\Model\RelationModel;

	class ArchivesModel extends RelationModel{
	
		protected $_auto=array(
			array('senddate','time',1,'function'),
			array('senddate','time',2,'function'),	
			//array('uid','getId',1,'callback'),
		
		);
		
		//注册判断
		protected $_validate=array(
			 array('title','require','标题必须填写！'),
			 //array('keywords','require','关键词必须填写！'),
		
		);
		protected $_link=array(
			'Arctype'=>array(		 	 //表
				'mapping_type'  => self::BELONGS_TO,   // 
				'class_name'	=>'Arctype',      //类名，可删
				'foreign_key'	=>'typeid',      //
				'mapping_name'	=>'arctype',
				'mapping_fields'=>'typename',	  //
				'as_fields'		=>'typename',
			),
			'Addonarticle'=>array(		 	 //表
				'mapping_type'  => self::BELONGS_TO,   // 
				'class_name'	=>'addonarticle',      //类名，可删
				'foreign_key'	=>'id',      //
				'mapping_name'	=>'addonarticle',
				'mapping_fields'=>'body',	  //
				'as_fields'		=>'body',
			),
			

		);
	}
?>