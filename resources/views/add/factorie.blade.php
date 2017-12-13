@extends('layouts.template')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<h2 class="all-center">Добавить завод</h2>	
			<div class="margin-top-4">
				<form method="get">
					<div class="row">
						<div class="col-xs-3">
							<div>Колличество зарегестрированных заводов: <span class="badge">{{ $arResult['count_factorie'] }}</span></div>
						</div>
						<div class="col-xs-9">
							<div>
								<input class="form-control" type="text" name="name" placeholder="Название завода" required>
							</div>
							<div class="margin-top-2">
								<input class="form-control" type="text" name="location" placeholder="Место положения" required>
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
