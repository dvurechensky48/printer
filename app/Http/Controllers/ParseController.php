<?php

namespace App\Http\Controllers;

use App\Printer;
use App\Helpers\Parser\Parse;

class ParseController extends Controller
{
	function allUpdates()
	{
		$arr = array();

		$printers = Printer::get();

		for ($i=0; $i < count($printers); $i++) { 
			$id = $printers[$i]['id'];
			//Обновить базу 
			array_push($arr, Parse::parsePrinter($id));
		}
		print_r($arr);
	}

}
