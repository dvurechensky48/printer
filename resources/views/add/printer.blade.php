@extends('layouts.template')

@section('content')

<section>
		<div class="container">
			<div class="row">
				<h2 class="all-center">Добавить принтер</h2>	
				<div class="margin-top-4">
					<form method="get">
						<div class="row">
							<div class="col-xs-3">
								<div>Колличество зарегестрированных принтеров: <span class="badge">{{ $arResult['count_printer'] }}</span></div>
							</div>
							<div class="col-xs-9">
								
								<div>
									<select name="print_factorie" class="form-control" required>
									    <option selected disabled>Выберите в какой завод добавить</option>
									    @if(!empty($arResult['factorie']))
										    @foreach($arResult['factorie'] as $post)
										    <option value="{{ $post['id'] }}">{{ $post['location'] }}</option>
										    @endforeach
									    @endif
								   </select>
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="site" placeholder="Местонахождение">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="lang" placeholder="Локализация">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="printer_name" placeholder="Имя">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="model" placeholder="Модель">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="color" placeholder="Краска">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="link" placeholder="Ссылка">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="location" placeholder="Локация">
								</div>

								<div class="margin-top-2">
									<input class="form-control" type="text" name="notes" placeholder="Дополнительно">
								</div>

								<div class="margin-top-2 all-center">
									<input class="btn" type="submit" name="printer" value="Отправить">
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
