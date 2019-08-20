<?php

namespace app\admin\controller;

use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelOffice {
	function daysales_excel(){
	    //导出表格
	    $objExcel = new \PHPExcel();
	    $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
	    // 设置水平垂直居中
	    $objExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    $objExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    // 字体和样式
	    $objExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
	    $objExcel->getActiveSheet()->getStyle('A2:AB2')->getFont()->setBold(true);
	    $objExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	    // 第一行、第二行的默认高度
	    $objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
	    $objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
	    //设置某一列的宽度
	    $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	    $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	    $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	    $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
	    $objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
	    $objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
	    $objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
	    $objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		//设置表头
		//  合并
		$objExcel->getActiveSheet()->mergeCells('A1:I1');
		$objActSheet = $objExcel->getActiveSheet(0);
		$objActSheet->setTitle('用户统计');//设置excel的标题
		// $objActSheet->setCellValue('A1','日销售额统计');
		// $objActSheet->setCellValue('A2','标的名称');
		// $objActSheet->setCellValue('B2','标的金额');
		// $objActSheet->setCellValue('C2','标的利率(%)');
		// $objActSheet->setCellValue('D2','标的上线时间');
		// $objActSheet->setCellValue('E2','募集天数');
		// $objActSheet->setCellValue('F2','实际募集金额(元)');
		// $objActSheet->setCellValue('G2','超过部分');
		// $objActSheet->setCellValue('H2','融资人');

		$baseRow = 3; //数据从N-1行开始往下输出 这里是避免头信息被覆盖
		// foreach ( $driver as $r => $d ) {
		//     $i = $baseRow + $r;
		//     $objExcel->getActiveSheet()->setCellValue('A'.$i,$d['title']);
		//     $objExcel->getActiveSheet()->setCellValue('B'.$i,$d['amount']);
		//     $objExcel->getActiveSheet()->setCellValue('C'.$i,$d['user_interest_rate']);
		//     $objExcel->getActiveSheet()->setCellValue('D'.$i,$d['start_time']);
		//     $objExcel->getActiveSheet()->setCellValue('E'.$i,''.$d['duration_collect']);
		//     $objExcel->getActiveSheet()->setCellValue('F'.$i,$d['daysales_amount']);
		//     $objExcel->getActiveSheet()->setCellValue('G'.$i,$d['amount']-$d['daysales_amount']);
		//     $objExcel->getActiveSheet()->setCellValue('H'.$i,$d['debit_name']);
		// }
		$objExcel->setActiveSheetIndex(0);
		    //4、输出
	    $objExcel->setActiveSheetIndex();
	    header('Content-Type: applicationnd.ms-excel');
	    $time=date('YmdHis');
	    header("Content-Disposition: attachment;filename=$time.xls");
	    header('Cache-Control: max-age=0');
	    $objWriter->save('php://output');
	}


}