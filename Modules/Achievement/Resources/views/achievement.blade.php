@extends('achievement::layouts.main')

@section('headers')
<link rel="stylesheet" href="{{ Module::asset('achievement:jquery/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('achievement:js/daterange-picker/daterangepicker.css') }}">
<!-- <link rel="stylesheet" href="{{ Module::asset('achievement:css/monthpicker.min.css') }}"> -->
<link rel="stylesheet" href="{{ Module::asset('achievement:monthpicker/MonthPicker.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('achievement:datatable/datatables.min.css') }}">
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
<!-- B: Title -->
<div class="title">
	<span class="title__sub">Monthly Traffic</span>
	<h2 class="title__main">
		Achievement Target of Kanal
	</h2>
	<!-- <div class="title__cap">
		Halaman ini menampilkan rangkuman dari total traffic monthly (UV-PV) Detikcom dan average daily per bulan berdasarkan platform. Silakan pilih bulan dan kanal yang Anda inginkan pada menu drop down dibawah ini.
	</div> -->
</div>
<!-- E: Title -->

<!-- B: Section -->
<div class="section">

	<!-- B: Filter -->
	<div class="filter">
		<div class="filter__options clearfix">
			
			<!-- B: Month Filter -->
			<div class="filter__date">
				<input type="text" id="startMonth" class="monthpicker rdinput" placeholder="start month" value="" readonly />
				<span class="wbreak">to</span>
				<input type='text' id="endMonth" class="monthpicker rdinput" placeholder='end month' value='' readonly/>
			</div>
			<!-- E: Month Filter -->				
			
			<!-- B: Channel Filter -->
			@include('achievement::layouts.options-kanal-multi')
			<!-- E:	Channel Filter -->

		</div>
	</div>
	<!-- E: Filter -->

	<!-- B: Chart -->
	<div class="white-space">
			
		<div class="section__box">
			<div class="abs_right">
				<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
				<a href="#" class="btn btn-primary-alt d-png"><span>DOWNLOAD AS PNG</span></a>
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

	</div>
	<!-- E: Chart -->
</div>
<!-- E: Section -->

@endsection

@section('js-sources')
<script type="text/javascript" src="{{ Module::asset('achievement:js/daterange-picker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('achievement:js/daterange-picker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('achievement:datatable/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('achievement:monthpicker/MonthPicker.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ Module::asset('traffics:js/monthpicker.min.js') }}"></script> -->
<script type="text/javascript" src="{{ Module::asset('achievement:js/blob/Blob.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('achievement:js/blob/canvas-to-blob.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('achievement:js/blob/FileSaver.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('achievement:jquery/jquery.parseparams.js') }}"></script>
@endsection

@section('jqueries')

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

// B: Init Page
var params = {};
var queryString = location.search.substring(1);
if (queryString.length <= 0) {
	var start = moment().subtract(5, 'months');
	var end = moment().subtract(1, 'months');
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
var start = moment(parsedQuery['start']).format('MMM YYYY');
var end = moment(parsedQuery['end']).format('MMM YYYY');
var channels = parsedQuery['channels'];

$('#startMonth').MonthPicker({
	Button: false,
	MonthFormat: 'M yy',
}).val(start);
$('#endMonth').MonthPicker({
	Button: false,
	MonthFormat: 'M yy',
}).val(end);

$('.options-multi').find(':checkbox[name^="channels"]').each(function() {
	$(this).prop("checked", ($.inArray($(this).val(), channels) != -1));
});

switch (platform) {
	case 'allweb' :
		$('.platform__title').text('All Web');
		//$('#tabs a').removeClass('active');
		//$('#tabs a[href$="#allweb"]').addClass('active');
		break;
	case 'desktop' :
		$('.platform__title').text('Desktop');
		//$('#tabs a').removeClass('active');
		//$('#tabs a[href$="#desktop"]').addClass('active');
		break;
	case 'mobile' :
		$('.platform__title').text('Mobile');
		//$('#tabs a').removeClass('active');
		//$('#tabs a[href$="#mobile"]').addClass('active');
		break;
	case 'android' :
		$('.platform__title').text('Android');
		//$('#tabs a').removeClass('active');
		//$('#tabs a[href$="#android"]').addClass('active');
		break;
	case 'ios' :
		$('.platform__title').text('IOS');
		//$('#tabs a').removeClass('active');
		//$('#tabs a[href$="#ios"]').addClass('active');
		break;
	default :
		$('.platform__title').text('All');
		//$('#tabs a').removeClass('active');
		//$('#tabs a[href$="#all"]').addClass('active');
}
// E: Init Page

// B: Monthpicker Change
$('.monthpicker').MonthPicker({
	Button: false,
	MonthFormat: 'M yy',
	OnAfterChooseMonth: function() {
		var channels = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (channels.length <= 0) {
			alert('Select a platform and any channels before applied!');
            return;
		} 
		var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
		var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
		var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
		var endYear = $('#endMonth').MonthPicker('GetSelectedYear');
		
		var nowDate = moment().format('DD');
		
		//var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var platform = 'all';
		
		var params = {
			'platform' : platform,
			'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
			'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
			'channels': channels
		}
		$(this).updateQuery(params);
	},
});
// E: Monthpicker Change

// B: Channels Change	
$('.apply-channels').click(function() {
	var channels = $('.options-multi input:checkbox:checked').map(function() {
		return $(this).val();
	}).get();
	if (channels.length <= 0) {
		alert('Select a platform and any channels before applied!');
		return;
	} 
	//var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
	var platform = 'all';
	var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
	var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var endYear = $('#endMonth').MonthPicker('GetSelectedYear');
	
	var nowDate = moment().format('DD');
		
	var params = {
		'platform' : platform,
		'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
		'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
		'channels' : channels
	}
	$(this).updateQuery(params);
});
// E: Channles Change

// B: Platform Change	
$('.filter__menu-item > a').bind('click', function() {
	var channels = $('.options-multi input:checkbox:checked').map(function() {
		return $(this).val();
	}).get();
	if (channels.length <= 0) {
		alert('Select a platform and any channels before applied!');
		return;
	} 
	//var platform = $(this).attr('href').substring(1);
	var platform = 'all';
	var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
	var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var endYear = $('#endMonth').MonthPicker('GetSelectedYear');
	
	var nowDate = moment().format('DD');
	
	var params = {
		'platform' : platform,
		'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
		'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
		'channels' : channels
	}
	$(this).updateQuery(params);
});
// E: Platform Change

// B: UV Chart
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
	'type': 'bar',
	options: {
		responsive: true,
		bezierCurve : false,
		legend: {
			position: 'top',
		},
		scales: {
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'Achievement in percent',
				},
				ticks: {
					userCallback: function(value, index, values) {
						value = value.toString();
						value = value.split(/(?=(?:...)*$)/);
						value = value.join('.');
						return value;
					},
					suggestedMin: 0,
					suggestedMax: 100,
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
				/*footer: function(tooltipItems, data) {
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
				}*/
			},
		},
	},
	data: {
		labels:[
			@foreach($arrayChannels[$tabsData['tabs-1'][1]] as $day)
				['{{ substr($day['monthName'], 0,3) }}','{{ $day['year'] }}'],
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
// E: UV Chart

// B: PV Chart
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
	'type': 'bar',
	options: {
		responsive: true,
		bezierCurve : false,
		legend: {
			position: 'top',
		},
		scales: {
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'Achievement in percent',
				},
				ticks: {
					userCallback: function(value, index, values) {
						value = value.toString();
						value = value.split(/(?=(?:...)*$)/);
						value = value.join('.');
						return value;
					},
					suggestedMin: 0,
					suggestedMax: 100,
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
				/*footer: function(tooltipItems, data) {
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
				}*/
			},
		},
	},
	data: {
		labels:[
			@foreach($arrayChannels[$tabsData['tabs-1'][1]] as $day)
				['{{ substr($day['monthName'], 0,3) }}','{{ $day['year'] }}'],
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
// E: PV Chart

// B: Save PNG File
$('a.d-png').click(function() {
	var fileUV = 'uv-monthly-traffics.png';
	var filePV = 'pv-monthly-traffics.png';
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

