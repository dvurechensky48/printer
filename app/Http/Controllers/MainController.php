<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factorie;
use App\Printer;
use App\Printing;
use App\Continent;
use App\Country;

class MainController extends Controller
{
    public function continent()
    {
    	$continent = Continent::get();

    	return view('pages.continent',[
    		'arResult' => $continent,
    		]);
    }
    public function country($continent)
    {
    	$continent = Continent::where('name','=', $continent)
                 ->firstOrFail();
        $country = Country::where('continent_id','=', $continent['id'])
                 ->get(); 
        return view('pages.country',[
    		'arResult' => $country,
    		]); 
    }
    public function index($country)
    {

    	$country = Country::where('name','=', $country)
                 ->firstOrFail();
        $factorie = Factorie::where('country_id',$country['id'])->get(); 
        $post['country'] = $country;
        $post['factorie'] = $factorie;


        return view('pages.index',[
    		'arResult' => $post,
    		]);  
    }
}
