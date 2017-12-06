<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factorie;
use App\Printer;
use App\Printing;
use App\Continent;
use App\Country;

class PrinterController extends Controller
{
    public function index($country)
    {
    	$country = Country::where('name','=', $country)
                 ->firstOrFail();
        $factorie = Factorie::where('country_id',$country['id'])->get(); 
        $post['country'] = $country;
        $post['factorie'] = $factorie;


        return view('pages.printer',[
    		'arResult' => $post,
    		]); 
    }

    public function info(Request $request,$country)
    {
    	if($request->input('value'))
    	{
    		$value = json_decode($request->input('value'));
    		$printing = Printing::where('printer_id',$value->printer_id)
    					->whereDate('created_at', '<=', $value->date_before)
    					->whereDate('created_at', '>=', $value->date_after)
    					->get();
			if(count($printing) > 0)
			{
				$post['status'] = '1';
				$top = array();
				$users = array();
				for($i=0;$i<count($printing);$i++)
				{
					if(!in_array($printing[$i]['user_name'], $users))
					{
						$arr = [
								"user_name" => $printing[$i]['user_name'],
								"amount" => $printing[$i]['amount'],
							];
						array_push($top, $arr);
						array_push($users, $printing[$i]['user_name']);

					}
					else
					{
						$num = array_search($printing[$i]['user_name'], $users);
						$sum1 = $top[$num]['amount'];
						$sum2 =  $printing[$i]['amount'];
						$top[$num]['amount'] = $sum1 + $sum2;
					}

					
				}

				if(count($top) <= 5 && count($top) > 0)
				{
					$post['top'] = $top;
					echo json_encode($post);
				}
				else if(count($top) > 5)
				{
					$arr_top = array();
					for($i=0;$i<count($top);$i++)
					{
						if($i >= 0 && $i <= 4)
						{
							array_push($arr_top, $top[$i]);
						}
						else
						{
							if($top[$i]['amount'] > $arr_top[0]['amount']) 
							{
								$arr_top[0] = $top[$i];
								continue;
							}
							else if($top[$i]['amount'] > $arr_top[1]['amount']) 
							{
								$arr_top[1] = $top[$i];
								continue;
							}
							else if($top[$i]['amount'] > $arr_top[2]['amount']) 
							{
								$arr_top[2] = $top[$i];
								continue;
							}
							else if($top[$i]['amount'] > $arr_top[3]['amount']) 
							{
								$arr_top[3] = $top[$i];
								continue;
							}
							else if($top[$i]['amount'] > $arr_top[4]['amount']) 
							{
								$arr_top[4] = $top[$i];
								continue;
							}
							
						}
					}
					$post['top'] = $arr_top;
					echo json_encode($post);
				}	
			}
			else
			{
				$post['status'] = '0';
	    		$post['error'] = 'Данных нет';
	    		echo json_encode($post);
			}
    	}
    	else
    	{
    		$post['status'] = '0';
    		$post['error'] = 'Неправильно задана переменная';
    		echo json_encode($post);
    	}
    	
    }
}
