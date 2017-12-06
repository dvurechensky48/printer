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
	    <li><a href="#">По принтерам</a></li>
	    <li><a href="#">По пользователся</a></li>
	    <li class="active"><a href="#">Экпорт</a></li>
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
					<form method="get">
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
							<div class="row">
								<div class="col-xs-6">
									<div class="all-center">От</div>
									<input id='datetimepicker-after' type='text' class="form-control" name="date-after" />
								</div>
								<div class="col-xs-6">
									<div class="all-center">До</div>
									<input id='datetimepicker-before' type='text' class="form-control" name="date-before" />
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="all-center margin-top-2">
							<button id="subm" type="sibmit" class="btn">Скачать</button>
						</div>
						<div class="clearfix"></div>
					</form>
			</div>
		</div>
	</div>
</section>


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
