@extends('layouts.main_template')

@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
     <ul class="nav navbar-nav">
     	<a class="navbar-brand" href="#">Логотип</a>
	    <li><a href="#">Главная</a></li>
	    <li class="active"><a href="#">По принтерам</a></li>
	    <li><a href="#">По пользователся</a></li>
	    <li><a href="#">Экпорт</a></li>
	  </ul>
  </div>
</nav>

<section>
	<div class="container">
		<div class="row">
			@if(!empty($arResult['country']))
			<h2 class="all-center">{{ json_decode($arResult['country']['content'])->ru->title }}</h2>
			@endif
			<div>
				
					<div class="col-xs-offset-3 col-xs-6 margin-top-2">
						<select id="region" name="region_id" class="form-control margin-top" required>
							<option value="none" disabled selected>Выберите регион</option>
							@if(!empty($arResult['factorie']))
								@foreach($arResult['factorie'] as $value)
									<option class="regons-name" value="{{ $value['id'] }}">{{ $value['location'] }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-offset-3 col-xs-6 margin-top-2">
						<select id="printer" name="printer_id" class="form-control margin-top" disabled required>
							<option value="none" disabled selected>Выберите принтер</option>
							<option value="val">office1</option>
							<option value="val">MOS</option>
							<option value="val">VRN</option>
							<option value="val">TMB</option>
						</select>
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-offset-3 col-xs-6 margin-top-2">
						<div class="row">
							<div class="col-xs-6">
								<div class="all-center">От</div>
								<input id='datetimepicker-after' type='text' class="form-control" name="date-before" />
							</div>
							<div class="col-xs-6">
								<div class="all-center">До</div>
								<input id='datetimepicker-before' type='text' class="form-control" name="date-after" />
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="all-center margin-top-2">
						<button id="subm" class="btn">Обновить</button>
					</div>
					<div class="clearfix"></div>
				
			</div>
			<div class="col-xs-12 margin-top-2">
				<div id="graphic">
					<div id="myfirstchart" style="height: 400px;">
						<div class="load-text ">
							<h3 class="all-center margin-top-4">Диаграмма не загружена</h3>
							<div class="all-center load margin-top-4">
								<img src="{{ asset('img/load.gif') }}">
							</div>	
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

//События

document.getElementById('subm').addEventListener('click',jsonSubmit,false);

document.addEventListener('DOMContentLoaded',function() 
{
	
	document.querySelector('#region').onchange=addOption;

},false);
//Отправка json для построения 

function addOption()
{
	document.querySelector('#printer').removeAttribute('disabled');
	$$a({

        type:'get',
		url:'/info',
		data:{'value':this.value},
		response:'text',
		success:function (data) {
			data = JSON.parse(data);
			option = document.getElementById('printer').querySelectorAll('option');
			for(k=0;k<option.length;k++)
			{
				option[k].remove();
			}

			for(i=0;i<data['printer'].length;i++)
			{
				document.getElementById('printer').options[i] = new Option(data['printer'][i]['printer_name']+' - '+data['printer'][i]['location'], data['printer'][i]['id']);
			}
		}

    });
}

function jsonSubmit()
{

	deleteDuagramm();
	document.querySelector('.load').style.display = 'block';


	date_after = document.querySelector('#datetimepicker-after');
	date_before = document.querySelector('#datetimepicker-before');
	printer_id = document.querySelector('#printer');


	if(printer_id.value != 'none')
	{
		json = {
			printer_id :  printer_id.value,
			date_before :  date_before.value,
			date_after :  date_after.value
		}

		json = JSON.stringify(json);
		console.log(json);
		$$a({

	        type:'get',
			url:'/country/russia/printer/info',
			data:{'value': json},
			response:'text',
			success:function (data) {
				data = JSON.parse(data);
				if(data['status'] == 1) 
				{
					duagramm(data['top']);
					document.querySelector('.load').style.display = 'none';
					document.querySelector('.load-text h3').style.display = 'none';
				}
				else
				{
					document.querySelector('.load-text h3').style.display = 'block';
					document.querySelector('.load-text h3').innerHTML = 'Произошла ошибка: ' + data['error'];
					document.querySelector('.load').style.display = 'none';
				}
			}

	    });
	}
	else
	{
		document.querySelector('.load-text h3').innerHTML = 'Произошла ошибка: Выберите регион и принтер';
		document.querySelector('.load').style.display = 'none';
	}

	
}

function deleteDuagramm()
{
	if(document.querySelector('svg') && document.querySelector('.morris-hover'))
	{
		document.querySelector('svg').remove();
		document.querySelector('.morris-hover').remove();
	}
}
//Конец

//Диаграмма

function duagramm(top)
{
	

	  new Morris.Bar({
	  // ID of the element in which to draw the chart.
	  element: 'myfirstchart',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: top,
	  // The name of the data record attribute that contains x-values.
	  xkey: 'user_name',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['amount'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Страниц']
	});
}
	

	
</script>

<script type="text/javascript">
	$(function () {                
	  $('#datetimepicker-after').datetimepicker({
	  	defaultDate: moment(-1,'day'),
	  	format: 'YYYY-MM-DD'
	  });

	  $('#datetimepicker-before').datetimepicker({
	  	format: 'YYYY-MM-DD',
	  	defaultDate: moment(),
	  	useCurrent: false
	  });

	  
	  $("#datetimepicker-after").on("dp.change", function (e) { 
	    $('#datetimepicker-before').data("DateTimePicker").minDate(e.date.add(1, 'days')); 
	    if(moment(e.date).isAfter($('#datetimepicker-before').data("DateTimePicker").date())){
	      $	('#datetimepicker-before').data("DateTimePicker").date(e.date);
	    }
	  });

	});
</script>

@endsection 
