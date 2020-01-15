@extends('ga::layouts.main')

@section('content')
	<div class="title">
		<h2 class="title__main">
			Welcome {{ Auth::user()->name }}
		</h2>
		<p class="title__cap">
			Silakan pilih menu yang anda inginkan pada bagian navigasi sebelah kiri, untuk report harian pilih menu “Daily Traffic” dan untuk report bulanan pilih menu “Monthly Traffic”
		</p>
	</div>

	<div class="section pt30">

		<div class="section__head">
			<h3 class="title__section">
				Overview Traffic Alldetik - all platform
			</h3>

			<a href="{{ url('ga/traffics/daily') }}" class="section__head-link">
				VIEW DETAIL
			</a>
		</div>

		<div class="card__list clearfix">

			<div class="card">
				<div class="card__box">
					<div class="card__top">
						<div class="card__day">
							2 DAYS BEFORE
						</div>
						<div class="card__date">
							{{ $twoDays }}
						</div>
					</div>

					<div class="card__counter">
						<span class="text-warning">UV (UNIQUE VISITOR)</span>
						@if (count($trafficData))
						{{ number_format($trafficData[1]['visitors'], 0, ',', '.') }}
						@if ($trafficData[1]['diffVisitors'] < 0)
							<div class="card__numb danger">
						@else
							<div class="card__numb info">
						@endif
							{{ $trafficData[1]['diffVisitors'] }} %
						</div>
						@endif
					</div>


					<div class="card__counter">
						<span class="text-primary">PV (PAGE VIEWS)</span>
						@if (count($trafficData))
						{{ number_format($trafficData[1]['pageviews'], 0, ',', '.') }}
						@if ($trafficData[1]['diffPageviews'] < 0)
							<div class="card__numb danger">
						@else
							<div class="card__numb info">
						@endif
							{{ $trafficData[1]['diffPageviews'] }} %
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card__box">
					<div class="card__top">
						<div class="card__day">
							YESTERDAY
						</div>
						<div class="card__date">
							{{ $oneDays }}
						</div>
					</div>

					<div class="card__counter">
						<span class="text-warning">UV (UNIQUE VISITOR)</span>
						@if (count($trafficData))
						{{ number_format($trafficData[2]['visitors'], 0, ',', '.') }}
						@if ($trafficData[2]['diffVisitors'] < 0)
							<div class="card__numb danger">
						@else
							<div class="card__numb info">
						@endif
							{{ $trafficData[2]['diffVisitors'] }} %
						</div>
						@endif
					</div>


					<div class="card__counter">
						<span class="text-primary">PV (PAGE VIEWS)</span>
						@if (count($trafficData))
						{{ number_format($trafficData[2]['pageviews'], 0, ',', '.') }}
						@if ($trafficData[2]['diffPageviews'] < 0)
							<div class="card__numb danger">
						@else
							<div class="card__numb info">
						@endif
							{{ $trafficData[2]['diffPageviews'] }} %
						</div>
						@endif
					</div>
				</div>
			</div>

		</div>

	</div>
@endsection
