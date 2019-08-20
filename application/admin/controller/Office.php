<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * excel操作
 * @author jachin <jachin@qq.com>
 */
class Office{
	
	/**
     * @description  导出excel表
     * @param  array   $data：要导出excel表的数据，接受一个二维数组
     * @param  array   $head：字段名以及写入表的字段名
     * @param  string  $name：表名
     * @return string  base64数据
     * @author jachin  2019-07-18
     */
	 
    public function outdata($data=[], $header=[],$name='')
    {
    	try {
    		if(empty($data)|empty($header)){
    			return false;
    		}
    		//计算表头数量
	        $count = count($header);
	        $head=array_values($header);
	 		$keys=array_keys($header);
	 		//创建对象
	 		$spreadsheet=new Spreadsheet();
	 		$spreadsheet->getProperties()->setCreator('jachin')
			    ->setLastModifiedBy('justin')
			    ->setTitle($name)
			    ->setSubject('日志')
			    ->setDescription('导出日志查看信息')
			    ->setKeywords('log')
			    ->setCategory('表格');
	 		$sheet = $spreadsheet->getActiveSheet();
	 		$spreadsheet->setActiveSheetIndex(0)->setTitle($name);
	 		//设置通用功能 
	 		$styleArray = [
			    'alignment' => [
			        'horizontal' => Alignment::HORIZONTAL_CENTER,
			        'vertical'   => Alignment::VERTICAL_CENTER,
			    ],
			    
			];
	        $spreadsheet->getDefaultStyle()->applyFromArray($styleArray);


	        $cell="A1:".($this->cellTree($count))."1";
	        
	        //设置头
	        $sheet->mergeCells($cell);
	        $sheet->setCellValue('A1',$name);
	        //设置第一行的高度
	        $sheet->getRowDimension('1')->setRowHeight(40); 
	       	$sheet->getStyle('A2:E3')->getFill()->getStartColor()->setARGB('FF808080');
	       	$styleTitle = [
				'font' =>[
			    	'bold' =>true,
			    	'color' => [
			    		'argb'=>'800000'
			    	],
			    	'name'=>'宋体',
			    	'size'=>'22',
			    ],
			];
			$sheet->getStyle('A1')->applyFromArray($styleTitle);
			//设置第二行的高度
			$sheet->getRowDimension('2')->setRowHeight(30);
	       	
			
	 		//数字转字母从65开始，循环设置表头
	        for ($i = 0; $i < $count; $i++) {
	        	$cellName=$this->cellTree($i+1);
	            $sheet->setCellValue($cellName.'2', $head[$i]);

	        	//固定列宽
	        	 $sheet->getColumnDimension($cellName)->setWidth(20); 

	        }

	        /*--------------开始从数据库提取信息插入Excel表中------------------*/
	 
	        foreach ($data as $key => $item) {             
	            //$key+2,因为第一行是表头，所以写到表格时   从第二行开始写
	 			
	            for ($i = 0; $i < $count; $i++) {     
	            	$cellName=$this->cellTree($i+1) .($key + 3);
	                $sheet->setCellValue($cellName, $item[$keys[$i]]);
	               
	            }
	 
	        }
	        return $this->exportExcel($spreadsheet, 'xlsx', date('YmdHis'));

    	} catch (Exception $e) {
    		return false;
    	}
        
   
    }
    /**
     * @description  导出保存操作
     * @param  object   $spreadsheet 实例化的对象
     * @param  string   $format xls为excel2003 xlsx为excel2007
     * @param  string  $savename 表民名
     * @return array  $data 返回数组
     * @author jachin  2019-07-18
     */
	 

    public function exportExcel($spreadsheet, $format = 'xls', $savename = 'export') {
    	try {
    		if (!$spreadsheet) return false;
		    ob_clean();
	        ob_start();
		    if ($format == 'xls') {
		        //输出Excel03版本
		        header('Content-Type:application/vnd.ms-excel'); 
		        $writer = new Xls($spreadsheet);

		    } elseif ($format == 'xlsx') {
		        //输出07Excel版本
		        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		        $writer = new Xlsx($spreadsheet);
		    }
		    //输出名称
		    header('Content-Disposition: attachment;filename="'.$savename.'.'.$format.'"');
		    //禁止缓存
		    header('Cache-Control: max-age=0');
		   
		    $writer->save('php://output');
		    $xlsxData=ob_get_contents();
		     $spreadsheet->disconnectWorksheets();
	        unset($spreadsheet);
		    $data=['filename' =>$savename.'.'.$format, 'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsxData)];
		    ob_end_clean();
	        return $data;
    	} catch (Exception $e) {
    		return false;
    	}
	    
	}
	/**
     * @description  单元格处理
     * @param  integer   $num
     * @return string  返回字符串以（A-Z）
     * @author jachin  2019-07-18
     */
    public function cellTree($num) {
	    $num = intval($num);
	    if ($num <= 0)
	        return false;
	    $letterArr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	    $letter = '';
	    do {
	        $key = ($num - 1) % 26;
	        $letter = $letterArr[$key] . $letter;
	        $num = floor(($num - $key) / 26);
	    } while ($num > 0);
	    return strtoupper($letter);
	}
	
}