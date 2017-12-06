<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factorie;
use App\Printer;
use App\Printing;

class StepController extends Controller
{
    public function step1()
    {
    	$post = Factorie::get();
    	return view('pages.all-lister',[
    		'arResult' => $post,
    		]);
    }
    public function step2(Request $request)
    {
    	if($request->input('factorie'))
        {
        	$factorie_id = $request->input('factorie');
        	$factorie = Factorie::where('id','=',$factorie_id)->firstOrFail();
        	$post['factorie'] = $factorie;
        	//Получить все модели завода
        	$printer = Printer::where('factorie_id',$factorie_id)->get();
        	$post['printer'] = $printer;
        	
        }
    	return view('pages.all-lister2',[
    		'arResult' => $post,
    		]);
    }
    public function step3(Request $request)
    {

if($request->input('printer_id') && $request->input('date-after') && $request->input('date-before'))
    	
        $printing = Printing::where('printer_id',$request->input('printer_id'))->whereDate('created_at', '>=', $request->input('date-before'))->whereDate('created_at', '<=', $request->input('date-after'))->paginate(10);
        return view('pages.all-lister3',[
            'arResult' => $printing,
         ]);
    }
}
