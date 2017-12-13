@extends('layouts.template')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<h2 class="all-center">Добавить страну</h2>	
			<div class="margin-top-4">
				<form method="get">
					<div class="row">
						<div class="col-xs-3">
							<div>Колличество зарегестрированных стран: <span class="badge">{{ $arResult['count_country'] }}</span></div>
						</div>
						<div class="col-xs-9">
							<div>
								<input class="form-control" type="text" name="name" placeholder="Название страны" required>
							</div>
							<div class="margin-top-2">
								<input class="form-control" type="text" name="lang" placeholder="Вторая локализация" required>
							</div>
							<div class="margin-top-2">
								<input class="form-control" type="text" name="lang1" placeholder="На английском" required>
							</div>
							<div class="margin-top-2">
								<input class="form-control" type="text" name="lang2" placeholder="На %lang%" required>
							</div>
							<div class="margin-top-2">
								<select name="continent_id" class="form-control" required>
								    <option selected disabled>Выберите континент</option>
								    @if(!empty($arResult['continent']))
									    @foreach($arResult['continent'] as $post)
									    <option value="{{ $post['id'] }}">{{ $post['name'] }}</option>
									    @endforeach
								    @endif
							   </select>
							</div>
							<div class="margin-top-2">
								<h3>Флаг</h3>
								<input class="form-control" type="file" name="flag" placeholder="Место положения" required>
							</div>

							<div class="margin-top-2 all-center">
								<input class="btn" type="submit" name="factorie" value="Отправить">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

@endsection  
