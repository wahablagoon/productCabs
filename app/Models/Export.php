<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Excel;
class Export extends Model
{
	public function generate($data,$data_header,$type,$title)
	{
		$filename=random_string(10);		

		Excel::create($filename, function($excel)  use ($data,$data_header,$title){
	    	$excel->sheet($title, function($sheet) use ($data,$data_header,$title) {
			$alphabet = range('A', 'Z');
			$end=$alphabet[(count($data_header)-1)]."1"; 
	        $sheet->fromArray($data);
	        	
				$sheet->row(1, [$title]);
				$sheet->mergeCells('A1:'.$end);
				$sheet->row(1, function($title) {
		    		$title->setBackground('#3f51b5');
		    		$title->setFontColor('#ffffff');
		    		$title->setFontWeight('bold');
		    		$title->setAlignment('center');
				});
	        	$sheet->row(2,$data_header); 
		        $sheet->row(2, function($data_header) {
		    		$data_header->setBackground('#3f51b5');
		    		$data_header->setFontColor('#ffffff');
		    		$data_header->setFontWeight('bold');
		    		$data_header->setAlignment('center');
				});
    		});
		})->export($type);
	}


}
