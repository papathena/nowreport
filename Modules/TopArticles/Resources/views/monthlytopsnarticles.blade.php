@extends('toparticles::layouts.main')

@section('headers')
<link rel="stylesheet" href="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ Module::asset('toparticles:monthpicker/MonthPicker.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('toparticles:datatable/datatables.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('toparticles:jquery/jquery-ui.min.css') }}">
<style>
	.filter__menu, #tabs-snArticles
	{
			padding: 0;
	}

	.filter__menu ul, #tabs-snArticles ul
	{
		margin: 0;
		padding: 5px 10px;
	}

	.filter__menu ul li, #tabs-snArticles ul li
	{
		display: inline-block;
	}

	#tabs-snArticles ul li
	{
		margin: 3px 5px;
		text-align: center;
		padding: 3px 10px;
	} 
	
	#tabs-snArticles ul li.ui-tab
	{	
		border-radius: 25px;
		border: 1px solid #00f;
	}
	
	#tabs-snArticles ul li.ui-tabs-active
	{
		background-color : #00f;
		color: #fff;
		border-radius: 25px;
		border: 1px solid #00f;
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
	<span class="title__sub">Monthly Traffic</span>
	<h2 class="title__main">
		Monthly Top Articles (Social Network)
	</h2>
	<div class="title__cap">
		Pada laman ini akan menampilkan list top 10 artikel yang berasal dari social media tertentu. Silakan pilih kanal yang Anda inginkan, kemudian pilih sosial media yang Anda inginkan, dan pilih bulan tertentu jika Anda ingin memantau traffic sebelumnya.
	</div>
</div>

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
			@include('toparticles::layouts.options-kanal')
			<!-- E: Channel Filter -->
			
			<!-- B: Channel Source Filter -->
				@include('toparticles::layouts.options-social-multi')
			<!-- E:	Channel Sourcce Filter -->
				
			<!-- B: Platform Filter -->
			<div class="filter__dots"><span class="icon-dots"></span></div>
			<div class="filter__menu">
				<ul>
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
				</ul>
			</div>
			<!-- E: Platform Filter -->
		</div>
	</div>
	<!-- E: Filter -->
	
	<!-- B: Channel Source Top 10 Articles Table  -->
	<div class="white-space">
		<div class="section__box">
			<div class="abs_right">
				<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
			</div>
			<h3 class="title__section">
				Monthly Top 10 Article <small>(Social Network)</small>
			</h3>
			<div class="table__box pt30">
				<table class="table-default" data-table="sorter">
					<thead class="sorter">
						<tr>
							<th style="width:12%" class="">
								<span>MONTH</span>
							</th>
							<th style="width:12%" class="">
								<span>YEAR</span>
							</th>
							<th style="width:10%" class="sorter-false">
								<span>KANAL</span>
							</th>
							<th style="width:12%" class="sorter-false">
								<span>SOCNET</span>
							</th>
							<th style="width:30%" class="sorter-false">
								<span>ARTICLE TITLE</span>
							</th>
							<th style="width:12%" class="text-right">
								<span>USERS</span>
							</th>
							<th style="width:12%" class="text-right">
								<span>PAGEVIEWS</span>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($snTopArticles as $snArticles)
							<tr>
								<td>{{ $snArticles['monthName'] }}</td>
								<td>{{ $snArticles['year'] }}</td>
								<td>{{ $snArticles['channels'] }}</td>
								<td>{{ $snArticles['socnet'] }}</td>
								<td>{{ $snArticles['pagetitle'] }}</td>
								<td class="text-right">{{ number_format($snArticles['visitors'],0,",",".") }}</td>
								<td class="text-right">{{ number_format($snArticles['pageviews'],0,",",".") }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- E: Channel Source Top 10 Articles Table -->
</div>
@endsection

@section('js-sources')
<script type="text/javascript" src="{{ Module::asset('toparticles:js/daterange-picker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:datatable/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:monthpicker/MonthPicker.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:js/blob/Blob.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:js/blob/canvas-to-blob.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:js/blob/FileSaver.min.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('toparticles:jquery/jquery.parseparams.js') }}"></script>
@endsection

@section('jqueries')
// B: Init Page
$("#tabs").tabs({
	"show": function(event, ui) {
		var oTable = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
		if ( oTable.length > 0 ) {
			oTable.fnAdjustColumnSizing();
		}
	}
});

$("#tabs-snArticles").tabs({
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
                'channels' : data['channels'],
				'socnet[]' : data['socnet']
        }
        var paramQuery = decodeURIComponent($.param(query));
        location.search = paramQuery;
}

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
                'channels': channels,
				'socnet': socnet
        }
        $(this).updateQuery(params);
}

var parsedQuery = $.parseParams(queryString);
var platform = parsedQuery['platform'];
var start = moment(parsedQuery['start']).format('MMM YYYY');
var end = moment(parsedQuery['end']).format('MMM YYYY');
var channels = parsedQuery['channels'];
var socnet = parsedQuery['socnet'];

$('#startMonth').MonthPicker({
        Button: false,
        MonthFormat: 'M yy',
}).val(start);
$('#endMonth').MonthPicker({
        Button: false,
        MonthFormat: 'M yy',
}).val(end);

$('input[name="channels"][value="'+channels+'"]').attr('checked', true);
$('.sdrop__item-title').text($('input[name="channels"]:checked').parent().text());
$('.options-multi').find(':checkbox[name^="socnet"]').each(function() {
	$(this).prop("checked", ($.inArray($(this).val(), socnet) != -1));
});

switch (platform) {
        case 'desktop' :
                $('.platform__title').text('Desktop');
                $('.filter__menu a').removeClass('active');
                $('.filter__menu a[href$="#desktop"]').addClass('active');
                break;
        case 'mobile' :
                $('.platform__title').text('Mobile');
                $('.filter__menu a').removeClass('active');
                $('.filter__menu a[href$="#mobile"]').addClass('active');
                break;
        default :
                $('.platform__title').text('All Web');
                $('.filter__menu a').removeClass('active');
                $('.filter__menu a[href$="#allweb"]').addClass('active');
}
// E: Init Page

// B: Monthpicker Change
$('.monthpicker').MonthPicker({
	Button: false,
	MonthFormat: 'M yy',
	OnAfterChooseMonth: function() {
		var channels = $('input[name="channels"]:checked').val();
		var socnet = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (socnet.length <= 0) {
			alert('Select any social network before applied!');
			return;
		}
		var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
		var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
		var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
		var endYear = $('#endMonth').MonthPicker('GetSelectedYear');

		var nowDate = moment().format('DD');

		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);

		var params = {
				'platform' : platform,
				'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
				'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
				'channels': channels,
				'socnet' : socnet
		}
		$(this).updateQuery(params);
	},
});
// E: Monthpicker Change

// B: When Channel Selected
$('input[name="channels"]').click(function() {
		var channels = $(this).val();
		var socnet = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (socnet.length <= 0) {
			alert('Select any social network before applied!');
            return;
		}
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
        var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
        var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
        var endYear = $('#endMonth').MonthPicker('GetSelectedYear');

        var nowDate = moment().format('DD');

        var params = {
                'platform' : platform,
                'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
                'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
                'channels' : channels,
				'socnet' : socnet
        }
        $(this).updateQuery(params);
});
// E: When Channel Selected

// B: When platform menu clicked
$('.filter__menu-item > a').bind('click', function() {
	var socnet = $('.rdrop__opt input:checkbox:checked').map(function() {
		return $(this).val();
	}).get();
	if (socnet.length <= 0) {
		alert('Select any social network before applied!');
		return;
	}
	
	var platform = $(this).attr('href').substring(1);
	var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
	var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var endYear = $('#endMonth').MonthPicker('GetSelectedYear');

	var nowDate = moment().format('DD');

	var params = {
			'platform' : platform,
			'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
			'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
			'channels' : channels,
			'socnet' : socnet
	}
	$(this).updateQuery(params);
});
// E: When platform menu clicked

// B: When social network applied
$('.apply-socnet').click(function() {
	var channels = $('input[name="channels"]:checked').val();
	var socnet = $('.options-multi input:checkbox:checked').map(function() {
		return $(this).val();
	}).get();
	if (socnet.length <= 0) {
		alert('Select any social network before applied!');
		return;
	}
	var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
	var startMonth = ('0' + $('#startMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var startYear = $('#startMonth').MonthPicker('GetSelectedYear');
	var endMonth = ('0' + $('#endMonth').MonthPicker('GetSelectedMonth')).slice(-2);
	var endYear = $('#endMonth').MonthPicker('GetSelectedYear');
	var nowDate = moment().format('DD');
	var params = {
			'platform' : platform,
			'startdate' : moment(startYear+'-'+startMonth+'-'+nowDate).format('YYYY-MM-DD'),
			'enddate' : moment(endYear+'-'+endMonth+'-'+nowDate).format('YYYY-MM-DD'),
			'channels' : channels,
			'socnet' : socnet
	}
	$(this).updateQuery(params);
});
// E: When channel source applied

@endsection
