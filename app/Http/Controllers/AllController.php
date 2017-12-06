<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factorie;
use App\Printer;
use App\Printing;
use App\User;

class AllController extends Controller
{
   
    public function lister()
    {
    	$post['factorie'] = Factorie::get();
    	$printing = Printing::paginate(10);
    	return view('pages.all',[
         	'arResult' => $printing,
         	'form' => $post, 
         ]);
    }
    public function lister1()
    {
    	return view('pages.all-lister',[

    		]);
    }
    
}
