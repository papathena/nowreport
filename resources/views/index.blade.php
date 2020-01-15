@extends('layouts.main')

@section('content')
	<div class="homeopt">
		<h2 class="text-center">
			Select Report
		</h2>

		<div class="homeopt__list clearfix">

			<div class="homeopt__item">
				<div class="homeopt__box">
					<a href="{{ route('gaindex') }}">
						<span class="homeopt__icon">
							<img src="{{ asset('assets/images/icon_ga.png') }}" alt="">
						</span>

						<span class="homeopt__title">Google Analytic</span>
					</a>
				</div>
			</div>


			<div class="homeopt__item">
				<div class="homeopt__box">
					<!-- <a href=""> -->
						<span class="homeopt__icon">
							<img src="{{ asset('assets/images/icon_comscore.png') }}" alt="" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
						</span>

						<span class="homeopt__title">ComScore</span>
					<!-- </a> -->
				</div>
			</div>


			<div class="homeopt__item">
				<div class="homeopt__box">
					<!-- <a href=""> -->
						<span class="homeopt__icon">
							<img src="{{ asset('assets/images/alexa.png') }}" alt="" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
						</span>

						<span class="homeopt__title">Alexa</span>
					<!-- </a>  -->
				</div>
			</div>


			<div class="homeopt__item">
				<div class="homeopt__box">
					<!-- <a href=""> -->
						<span class="homeopt__icon">
							<img src="{{ asset('assets/images/icon_all.png') }}" alt="" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
						</span>

						<span class="homeopt__title">Compare GA, Alexa, Comscore</span>
					<!-- </a> -->
				</div>
			</div>


			<div class="homeopt__item">
				<div class="homeopt__box">
					<!-- <a href="user/users"> -->
						<span class="homeopt__icon">
							<img src="{{ asset('assets/images/icon_setup.png') }}" alt="" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
						</span>

						<span class="homeopt__title">Control Panel</span>
					<!-- </a> -->
				</div>
			</div>

		</div>
	</div>
@endsection

