@extends('layouts.main_template')

@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
     <ul class="nav navbar-nav">
     	<a class="navbar-brand" href="#">Логотип</a>
	    <li class="active"><a href="#">Главная</a></li>
	    <li><a href="#">По принтерам</a></li>
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
				<form>
					
					<div class="col-xs-offset-3 col-xs-6 margin-top-2">
						<select name="printer_id" class="form-control margin-top" required>
							<option disabled selected>Выберите регион</option>
							@if(!empty($arResult['factorie']))
								@foreach($arResult['factorie'] as $value)
									<option value="{{ $value['id'] }}">{{ $value['location'] }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="clearfix"></div>
					
					<div class="margin-top-2">
						<div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<input id='datetimepicker1' type='text' class="form-control" name="date-before" />
								</div>
								<div class="col-xs-6">
									<input id='datetimepicker2' type='text' class="form-control" name="date-after" />
								</div>
								<div class="clearfix"></div>
								<div class="all-center margin-top-2">
									<input type="submit" value="Обновить" class="btn">
								</div>
								<div class="margin-top-2">
									<h3 class="all-center">ТОП 5 принтеров</h3>
								</div>
								<div class="col-xs-12 margin-top-2">
									<div id="graphic">
										<div id="myfirstchart1" style="height: 400px;">
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<input id='datetimepicker3' type='text' class="form-control" name="date-before" />
								</div>
								<div class="col-xs-6">
									<input id='datetimepicker4' type='text' class="form-control" name="date-after" />
								</div>
								<div class="clearfix"></div>
								<div class="all-center margin-top-2">
									<input type="submit" value="Обновить" class="btn">
								</div>
								<div class="margin-top-2">
									<h3 class="all-center">ТОП 5 пользователей</h3>
								</div>
								<div class="col-xs-12 margin-top-2">
									<div id="graphic">
										<div id="myfirstchart2" style="height: 400px;">
											
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
					

					
					
					<div class="clearfix"></div>
				</form>
			</div>
			
		</div>
	</div>
</section>
<script type="text/javascript">

function jsonPrintSubmit()
{
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
					document.querySelector('.load-text h3').innerHTML = 'Произошла ошибка: ' + data['error'];
					document.querySelector('.load').style.display = 'none';
				}
			}

	    });
	}

	
}


	new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart1',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { user: 'User1', value: 20 },
    { user: 'User2', value: 10 },
    { user: 'User3', value: 5 },
    { user: 'User4', value: 5 },
    { user: 'User5', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'user',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Страниц']
});

	new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart2',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { user: 'User1', value: 20 },
    { user: 'User2', value: 10 },
    { user: 'User3', value: 5 },
    { user: 'User4', value: 5 },
    { user: 'User5', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'user',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Страниц']
});

	
</script>

<script>
    $(function () {                
	  $('#datetimepicker1').datetimepicker({
	  	defaultDate: moment(),
	  	format: 'YYYY-MM-DD'
	  });

	  $('#datetimepicker2').datetimepicker({
	  	format: 'YYYY-MM-DD',
	  	defaultDate: moment(-1,'day'),
	  	useCurrent: false
	  });

	  $("#datetimepicker1").on("dp.change", function (e) { 
	    $('#datetimepicker2').data("DateTimePicker").minDate(e.date.add(1, 'days')); 
	    if(moment(e.date).isAfter($('#datetimepicker2').data("DateTimePicker").date())){
	      $	('#datetimepicker2').data("DateTimePicker").date(e.date);
	    }
	  });
	});

	$(function () {                
	  $('#datetimepicker3').datetimepicker({
	  	defaultDate: moment(),
	  	format: 'YYYY-MM-DD'
	  });

	  $('#datetimepicker4').datetimepicker({
	  	format: 'YYYY-MM-DD',
	  	defaultDate: moment(-1,'day'),
	  	useCurrent: false
	  });

	  $("#datetimepicker3").on("dp.change", function (e) { 
	    $('#datetimepicker4').data("DateTimePicker").minDate(e.date.add(1, 'days')); 
	    if(moment(e.date).isAfter($('#datetimepicker4').data("DateTimePicker").date())){
	      $	('#datetimepicker4').data("DateTimePicker").date(e.date);
	    }
	  });
	});

	
</script>

@endsection  
