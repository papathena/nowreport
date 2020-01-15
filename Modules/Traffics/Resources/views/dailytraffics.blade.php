@extends('traffics::layouts.main')

@section('headers')
	<link rel="stylesheet" href="{{ Module::asset('traffics:js/daterange-picker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ Module::asset('traffics:datatable/datatables.min.css') }}">
	<style> 
	#tabs {
			padding: 0;
		}

		#tabs ul {
			margin: 0;
			padding: 5px 10px;
		}

		#tabs ul li {
			display: inline-block;
		}

		.filter__menu-item {
			margin: 0;
		}

		.platform {
			display: none;
		}

	</style>
@endsection

@section('content')
	<div class="title">
		<span class="title__sub">Daily Traffic</span>
		<h2 class="title__main">
			Traffic Overview
		</h2>
		<div class="title__cap">
			Halaman ini menampilkan rangkuman dari total traffic daily (UV-PV) Detikcom dan average daily berdasarkan platform. Silakan pilih tanggal dan kanal yang Anda inginkan pada menu drop down dibawah ini.
		</div>
	</div>

	<div class="section">

		<!-- B: Filter -->
		<div class="filter">
			<div class="filter__options clearfix">
				<!-- B: Date Filter -->			
				<div class="filter__date">							
					<input type="text" class="rdinput" data-type="range" placeholder="Date Range" value="">
				</div>
				<!-- E: Date Filter -->

				<!-- B: Channel Filter -->
				@include('traffics::layouts.options-kanal-multi')
				<!-- E:	Channel Filter -->
			</div>
		</div>
		<!-- E: Filter -->

		<!-- B: Platform Filter -->
		<div class="filter__dots"><span class="icon-dots"></span></div>
		<div id="tabs" class="filter__menu">
			<ul>
				<li class="filter__menu-item">
					<!-- <div class="filter__menu-item"> -->
						<a href="#all" class="">
						All Platform
						</a>
					<!-- </div> -->
				</li>
				<li class="filter__menu-item">
					<!-- <div class="filter__menu-item"> -->
						<a href="#allweb" class="">
							All Web (Desktop + Mobile)
						</a>
					<!-- </div> -->
				</li>
				<li class="filter__menu-item">
					<!-- <div class="filter__menu-item"> -->
						<a href="#desktop" class="">
							Desktop
						</a>
					<!-- </div> -->
				</li>
				<li class="filter__menu-item">
					<!-- <div class="filter__menu-item"> -->
						<a href="#mobile" class="">
							Mobile
						</a>
					<!-- </div> -->
				</li>
				<li class="filter__menu-item">
					<!-- <div class="filter__menu-item"> -->
						<a href="#android" class="">
							Android
						</a>
					<!-- </div> -->
				</li>
				<li class="filter__menu-item" class="">
					<!-- <div class="filter__menu-item"> -->
						<a href="#ios" class="" >
							IOS
						</a>
					<!-- </div> -->
				</li>
			</ul>

			<div id="all" class="platform"></div>
			<div id="allweb" class="platform"></div>
			<div id="desktop" class="platform"></div>
			<div id="mobile" class="platform"></div>
			<div id="android" class="platform"></div>
			<div id="ios" class="platform"></div>
		</div>
		<!-- E: Platform Filter -->

		<!-- B: Charts -->
				<div class="white-space">

					
					<div class="section__box">
						<div class="abs_right">
							<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
							<a href="" class="btn btn-primary-alt d-png"><span>DOWNLOAD AS PNG</span></a>
						</div>
						<h3 class="title__section">
							Platform: <span class="platform__title"></span> - Users
						</h3>

						<div class="chart">
							
							<canvas id="c-users" width="400" height="150"></canvas>
							

						</div>
					</div>

					
					<div class="section__box">
						<h3 class="title__section">
							Platform: <span class="platform__title"></span> - Pageviews
						</h3>

						<div class="chart">
							
							<canvas id="c-pageviews" width="400" height="150"></canvas>
							

						</div>
					</div>

					<div class="section__box">
						<div class="abs_right">
							<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
						</div>
						<h3 class="title__section">
							Average Traffic Kanal - <span class="platform__title"></span>
						</h3>
						
						<div class="table__box">
							<table class="table-default" id=dTable1>
								<thead>
									<tr>
										<th>
											<span>KANAL</span>
										</th>
										<th>
											<span>USERS</span>
										</th>
										<th>
											<span>PAGEVIEWS</span>
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($avgsData as $ch => $channel)
										<tr>
										<td>{{ $channel[0] }}</td>
										@foreach($avgChannels[$channel[1]] as $data)
											<td>{{ number_format($data['visitors'],0,',','.') }}</td>
											<td>{{ number_format($data['pageviews'],0,',','.') }}</td>
										@endforeach
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>

					</div>



				</div>

		<!-- E: Charts -->

	</div>
@endsection

@section('js-sources')
	<script type="text/javascript" src="{{ Module::asset('traffics:js/daterange-picker/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:monthpicker/MonthPicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:datatable/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:jquery/jquery.parseparams.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:js/blob/Blob.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:js/blob/canvas-to-blob.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('traffics:js/blob/FileSaver.min.js') }}"></script>
@endsection

@section('jqueries')
	$("#tabs").tabs({
		"show": function(event, ui) {
			var oTable = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTable.length > 0 ) {
				oTable.fnAdjustColumnSizing();
			}
		}
	});

	$.fn.updateQuery = function (data) {
		var query = {
			'platform' : data['platform'],
			'start' : data['startdate'],
			'end' : data['enddate'],
			'channels[]' : data['channels']
		}
		var paramQuery = decodeURIComponent($.param(query));
		location.search = paramQuery;
	}	

	$.fn.random_rgba = function() {
  		var o = Math.round, r = Math.random, s = 255;
  		return 'rgba('+ o(r()*s) +','+ o(r()*s) +','+ o(r()*s) +',1)';
	}

	/*$.fn.updatePages = function (data) {
		queryString = location.search.substring(1);
		if (querString.length <= 0) {

		}
	}*/

	var params = {};

	var queryString = location.search.substring(1);
	if (queryString.length <= 0) {
		var start = moment().subtract(6, 'days');
		var end = moment().subtract(1, 'days');
		var platform = 'all';
		var channels = [
			'all',
		];
		var params = {
			'platform' : platform,
			'startdate' : start.format('YYYY-MM-DD'),
			'enddate' : end.format('YYYY-MM-DD'),
			'channels': channels
		}
		$(this).updateQuery(params);
	} 

	var parsedQuery = $.parseParams(queryString);
	var platform = parsedQuery['platform'];
	var start = parsedQuery['start'];
	var end = parsedQuery['end'];
	var channels = parsedQuery['channels'];
	$('input[class="rdinput"]').daterangepicker({
		startDate : moment(start).format('DD/MM/YYYY'),
		endDate : moment(end).format('DD/MM/YYYY'),
		locale: {
			format: 'DD/MM/YYYY'
		}
	});
	$('.options-multi').find(':checkbox[name^="channels"]').each(function() {
		$(this).prop("checked", ($.inArray($(this).val(), channels) != -1));
	});
	//console.log(parsedQuery);

	switch (platform) {
		case 'allweb' :
			$('.platform__title').text('All Web');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#allweb"]').addClass('active');
			break;
		case 'desktop' :
			$('.platform__title').text('Desktop');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#desktop"]').addClass('active');
			break;
		case 'mobile' :
			$('.platform__title').text('Mobile');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#mobile"]').addClass('active');
			break;
		case 'android' :
			$('.platform__title').text('Android');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#android"]').addClass('active');
			break;
		case 'ios' :
			$('.platform__title').text('IOS');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#ios"]').addClass('active');
			break;
		default :
			$('.platform__title').text('All');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#all"]').addClass('active');
	}

	$('.filter__menu-item > a').bind('click', function() {
		var channels = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (channels.length <= 0) {
			alert('Select a platform and any channels before applied!');
            return;
		} 
		var platform = $(this).attr('href').substring(1);
		var start = $('input[class="rdinput"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end = $('input[class="rdinput"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels
		}
		$(this).updateQuery(params);
	});

	$('.apply-channels').click(function() {
		var channels = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (channels.length <= 0) {
			alert('Select a platform and any channels before applied!');
            return;
		} 
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var start = $('input[class="rdinput"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end = $('input[class="rdinput"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels
		}
		$(this).updateQuery(params);
	});

	$('input[class="rdinput"]').on('apply.daterangepicker', function(ev, picker) {
		var channels = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (channels.length <= 0) {
			alert('Select a platform and any channels before applied!');
            return;
		} 
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var start = picker.startDate.format('YYYY-MM-DD');
		var end = picker.endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels
		}
		$(this).updateQuery(params);
	});

	// B: Script of UV Chart
	var cuserId = $('#c-users');
	var ctx = cuserId[0].getContext('2d');
	Chart.plugins.register({
	  beforeDraw: function(chartInstance) {
	    var ctx = chartInstance.chart.ctx;
	    ctx.fillStyle = "white";
	    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
	  }
	});
	var cUser = new Chart (ctx, {
		'type': 'line',
		options: {
			responsive: true,
			bezierCurve : false,
			legend: {
				position: 'top',
			},
			scales: {
				yAxes: [{
					ticks: {
						userCallback: function(value, index, values) {
							value = value.toString();
							value = value.split(/(?=(?:...)*$)/);
							value = value.join('.');
							return value;
						}
					}
				}]
			},
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
						var label = data.datasets[tooltipItem.datasetIndex].label;
						value = value.toString();
						value = value.split(/(?=(?:...)*$)/);
						value = value.join('.');
						return label + ': ' + value;
					},
					footer: function(tooltipItems, data) {
						var valBefore = 0;
						var growthUV = 0;
						tooltipItems.forEach(function(tooltipItem) {
							value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
							if (tooltipItem.index > 0) {
								indexBefore = tooltipItem.index - 1;
								valBefore = data.datasets[tooltipItem.datasetIndex].data[indexBefore];
								growthUV = Math.round(((value - valBefore)/value)*100);
							} else {
								growthUV = '-';
							}
						});
						return 'Growth: '+growthUV+' %';
					}
				},
			},
		},
		data: {
			labels:[
				@foreach($arrayChannels[$tabsData['tabs-1'][1]] as $day)
					['{{ substr($day['dayName'], 0,3) }}','{{ $day['dayDate'] }}'],
				@endforeach
				],
			datasets:[
				@foreach($tabsData as $tabKey => $tabValue)
					{
						label: '{{ $tabValue[0] }}',
						//backgroundColor: bgcolor=$(this).random_rgba(),
						//borderColor: bgcolor,
						backgroundColor: '{{ $tabValue[2] }}',
						borderColor: '{{ $tabValue[2] }}',
						data:[
							@foreach($arrayChannels[$tabValue[1]] as $datas)
								{{ $datas['visitors'] }},
							@endforeach
						],
						fill: false,
						//lineTension: 0,
						pointRadius: 5,
						pointHoverRadius: 6,

					},
				@endforeach
			],
		}
	});
	// E: Script of UV Chart

	// B: Script of PV Chart
	var cpvId = $('#c-pageviews');
	var ctx = cpvId[0].getContext('2d');
	Chart.plugins.register({
	  beforeDraw: function(chartInstance) {
	    var ctx = chartInstance.chart.ctx;
	    ctx.fillStyle = "white";
	    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
	  }
	});
	var cPv = new Chart (ctx, {
		'type': 'line',
		options: {
			responsive: true,
			bezierCurve : false,
			legend: {
				position: 'top',
			},
			scales: {
				yAxes: [{
					ticks: {
						userCallback: function(value, index, values) {
							value = value.toString();
							value = value.split(/(?=(?:...)*$)/);
							value = value.join('.');
							return value;
						}
					}
				}]
			},
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
						var label = data.datasets[tooltipItem.datasetIndex].label;
						value = value.toString();
						value = value.split(/(?=(?:...)*$)/);
						value = value.join('.');
						return label + ': ' + value;
					},
					footer: function(tooltipItems, data) {
						var valBefore = 0;
						var growthPV = 0;
						tooltipItems.forEach(function(tooltipItem) {
							value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
							if (tooltipItem.index > 0) {
								indexBefore = tooltipItem.index - 1;
								valBefore = data.datasets[tooltipItem.datasetIndex].data[indexBefore];
								growthPV = Math.round(((value - valBefore)/value)*100);
							} else {
								growthPV = '-';
							}
						});
						return 'Growth: '+growthPV+' %';
					}
				},
			},
		},
		data: {
			labels:[
				@foreach($arrayChannels[$tabsData['tabs-1'][1]] as $day)
					['{{ substr($day['dayName'], 0,3) }}','{{ $day['dayDate'] }}'],
				@endforeach
				],
			datasets:[
				@foreach($tabsData as $tabKey => $tabValue)
					{
						label: '{{ $tabValue[0] }}',
						backgroundColor: '{{ $tabValue[2] }}',
						borderColor: '{{ $tabValue[2] }}',
						data:[
							@foreach($arrayChannels[$tabValue[1]] as $datas)
								{{ $datas['pageviews'] }},
							@endforeach
						],
						fill: false,
						//lineTension: 0,
						pointRadius: 5,
						pointHoverRadius: 6,

					},
				@endforeach
			],
		}
	});
	// E: Script of PV Chart

	// B: Save PNG File
	$('a.d-png').click(function() {
		var fileUV = 'uv-daily-traffics.png';
		var filePV = 'pv-daily-traffics.png';
		var canvasUV = $('#c-users')[0], ctx = canvasUV.getContext("2d");
		var canvasPV = $('#c-pageviews')[0], ctx = canvasPV.getContext("2d");
		canvasUV.toBlob(function(blob) {
			saveAs(blob, fileUV);
		});
		canvasPV.toBlob(function(blob) {
			saveAs(blob, filePV);
		});

	});
	// E: Save PNG File

@endsection