<?php
namespace Home\Controller;
use Think\Controller;

class WordsController extends Controller {

	public function index(){
		echo "hao";		
    }
	public function WordSta(){ 
        
		Vendor('PHPWord.PHPWord');
		Vendor('PHPWord.PHPWord.IOFactory');		

        // New Word Document 
		
        $PHPWords = new PHPWord(); 
		$section = $PHPWord->createSection(); 
		$section->addText(iconv('utf-8', 'GB2312//IGNORE', 'PHP���ͨ'));
        // Save File 
        header('Content-type: application/vnd.ms-word'); 
		header('Content-Disposition:attachment;filename="word'.date('Ymd-His').'.docx"');  //����Ϊ�ļ�����׺
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007'); 
        $objWriter->save('php://output'); 
		}
	}
?>