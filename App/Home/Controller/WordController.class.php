<?php 
namespace Home\Controller;
use Think\Controller;

class WordController extends Controller {
	public function WordSta(){ 
        
		Vendor('PWord.PHPWord');
		Vendor('PWord.PHPWord.IOFactory');		

        // New Word Document 
		
        $PHPWord = new PHPWord(); 
		$section = $PHPWord->createSection(); 
		$section->addText(iconv('utf-8', 'GB2312//IGNORE', 'PHP点点通'));
        // Save File 
        header('Content-type: application/vnd.ms-word'); 
		header('Content-Disposition:attachment;filename="word'.date('Ymd-His').'.docx"');  //日期为文件名后缀
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007'); 
        $objWriter->save('php://output'); 
		}
	}
?> 