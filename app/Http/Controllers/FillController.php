<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factorie;
use App\Printer;
use App\Printing;

class FillController extends Controller
{
    public function lister(Request $request)
    {
    	
    	$post['factorie'] = Factorie::get();
    	$post['count_factorie'] = Factorie::count();
    	$post['count_printer'] = Printer::count();
    	$post['count_pristing'] = Printing::count();
    	if($request->input('name')  && $request->input('location') && $request->input('factorie'))
        {
        	$factorie = new Factorie();
            $factorie->name = $request->input('name');
            $factorie->location = $request->input('location');
			$factorie->save();
            return back();
        }
        if($request->input('printer') && $request->input('print_factorie'))
        {
        	$print = new Printer();

            $print->factorie_id = intval($request->input('print_factorie'));

            //Добавить местоположение
            if($request->input('site'))
            {
                $print->site = $request->input('site');
            }
            else
            {
                $print->site = NULL ;
            }
            //Добавить локализацию
            if($request->input('lang'))
            {
                $print->lang = $request->input('lang');
            }
            else
            {
                $print->lang = NULL ;
            }
            //добавить имя принтера
            if($request->input('printer_name'))
            {
                $print->printer_name = $request->input('printer_name');
            }
            else
            {
                $print->printer_name = NULL ;
            }
            //Добавить модель
            if($request->input('model'))
            {
                $print->model = $request->input('model');
            }
            else
            {
                $print->model = NULL ;
            }
            //Добавить цвет
            if($request->input('color'))
            {
                $print->color = $request->input('color');
            }
            else
            {
                $print->color = NULL ;
            }
            //Добавить ссылку
            if($request->input('link'))
            {
                $print->link = $request->input('link');
            }
            else
            {
                $print->link = NULL ;
            }
            //Добавить локацию
            if($request->input('location'))
            {
                $print->location = $request->input('location');
            }
            else
            {
                $print->location = NULL ;
            }
            //Добавить дополнительно
            if($request->input('notes'))
            {
                $print->notes = $request->input('notes');
            }
            else
            {
                $print->notes = NULL ;
            }


        	
        	$print->save();
            return back();
        }
        if($request->input('printing_factorie') && $request->input('user_name') && $request->input('printing_print') && $request->input('quantity')) 
        {
        	$quantity = $request->input('quantity');
        	for($i=0;$i<$quantity;$i++)
        	{
        		$printig =new Printing();
	        	$printig->printer_id = $request->input('printing_print');
	        	$printig->user_name = $request->input('user_name');
	        	$printig->factorie_id = $request->input('printing_factorie');
	        	$printig->save();
        	}
        	
            return back();
        }

    	return view('pages.simulation',[
         	'arResult' => $post,
         ]);
    }
    public function info(Request $request)
    {
    	if($request->input('value'))
    	{
    		$factorie_id = intval($request->input('value'));
    		$req['printer'] = Printer::where('factorie_id',$factorie_id)->get();
    		echo(json_encode($req));
    	}
    }
}
