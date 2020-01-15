@extends('toparticles::layouts.main')

@section('headers')
<link rel="stylesheet" href="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ Module::asset('toparticles:monthpicker/MonthPicker.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('toparticles:datatable/datatables.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('toparticles:jquery/jquery-ui.min.css') }}">
<style>
	.filter__menu, #tabs-allArticles,
	#tabs-newsArticles,
	#tabs-photoArticles,
	#tabs-pushArticles {
			padding: 0;
	}

	.filter__menu ul, #tabs-allArticles ul,
	#tabs-newsArticles ul,
	#tabs-photoArticles ul,
	#tabs-pushArticles ul {
		margin: 0;
		padding: 5px 10px;
	}

	.filter__menu ul li, #tabs-allArticles ul li,
	#tabs-newsArticles ul li,
	#tabs-photoArticles ul li,
	#tabs-pushArticles ul li {
		display: inline-block;
	}

	#tabs-allArticles ul li,
	#tabs-newsArticles ul li,
	#tabs-photoArticles ul li,
	#tabs-pushArticles ul li {
		margin: 3px 5px;
		text-align: center;
		padding: 3px 10px;
	} 
	
	#tabs-allArticles ul li.ui-tab,
	#tabs-newsArticles ul li.ui-tab,
	#tabs-photoArticles ul li.ui-tab,
	#tabs-pushArticles ul li.ui-tab {	
		border-radius: 25px;
		border: 1px solid #00f;
	}
	
	#tabs-allArticles ul li.ui-tabs-active,
	#tabs-newsArticles ul li.ui-tabs-active,
	#tabs-photoArticles ul li.ui-tabs-active,
	#tabs-pushArticles ul li.ui-tabs-active {
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
		Monthly Top Articles (Overview)
	</h2>
	<div class="title__cap">
		Pada laman ini akan menampilkan list top 10 artikel dari semua jenis artikel dan top artikel push notifikasi pada bulan tertentu. Silakan pilih kanal yang Anda inginkan dan pilih bulan tertentu jika Anda ingin memantau traffic sebelumnya.
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
						
			<!-- B: Platform Filter -->
			<div class="filter__dots"><span class="icon-dots"></span></div>
			<div class="filter__menu">
				<ul>
					<li class="filter__menu-item">
						<a href="#allweb" class="">
								All Web (Desktop + Mobile)
						</a>
					</li>
					<li class="filter__menu-item">
						<a href="#desktop" class="">
								Desktop
						</a>
					</li>
					<li class="filter__menu-item">
						<a href="#mobile" class="">
								Mobile
						</a>
					</li>
					<li class="filter__menu-item">
						<a href="#android" class="">
								Android
						</a>
					</li>
					<li class="filter__menu-item" class="">
						<a href="#ios" class="" >
								IOS
						</a>
					</li>
				</ul>
			</div>
			<!-- E: Platform Filter -->
		</div>
	</div>
	<!-- E: Filter -->

	<!-- B: All Top Articles Table  -->
	<div class="white-space">
		<div class="section__box">
			<div class="abs_right">
				<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
			</div>
			<h3 class="title__section">
				Monthly Top 10 Article <small>(All Content Type)</small>
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
							<th style="width:12%" class="sorter-false">
								<span>KANAL</span>
							</th>
							<th style="width:40%" class="sorter-false">
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
						@foreach($allTopArticles as $allArticles)
							<tr>
								<td>{{ $allArticles['monthName'] }}</td>
								<td>{{ $allArticles['year'] }}</td>
								<td>{{ $allArticles['channels'] }}</td>
								<td>{{ $allArticles['pagetitle'] }}</td>
								<td class="text-right">{{ number_format($allArticles['visitors']) }}</td>
								<td class="text-right">{{ number_format($allArticles['pageviews']) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- E: All Top Articles Table -->
	
	<!-- B: News Top Articles Table  -->
	@if (sizeof($newsTopArticles) > 0)
	<div class="white-space">
		<div class="section__box">
			<div class="abs_right">
				<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
			</div>
			<h3 class="title__section">
				Monthly Top 10 Article <small>(Regular)</small>
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
							<th style="width:12%" class="sorter-false">
								<span>KANAL</span>
							</th>
							<th style="width:40%" class="sorter-false">
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
						@foreach($newsTopArticles as $newsArticles)
							<tr>
								<td>{{ $newsArticles['monthName'] }}</td>
								<td>{{ $newsArticles['year'] }}</td>
								<td>{{ $newsArticles['channels'] }}</td>
								<td>{{ $newsArticles['pagetitle'] }}</td>
								<td class="text-right">{{ number_format($newsArticles['visitors']) }}</td>
								<td class="text-right">{{ number_format($newsArticles['pageviews']) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
	<!-- E: News Top Articles Table -->

	<!-- B: Photo Top Articles Table  -->
	@if (sizeof($photoTopArticles) > 0)
	<div class="white-space">
		<div class="section__box">
			<div class="abs_right">
				<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
			</div>
			<h3 class="title__section">
				Monthly Top 10 Article <small>(Photo)</small>
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
							<th style="width:12%" class="sorter-false">
								<span>KANAL</span>
							</th>
							<th style="width:40%" class="sorter-false">
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
						@foreach($photoTopArticles as $photoArticles)
							<tr>
								<td>{{ $photoArticles['monthName'] }}</td>
								<td>{{ $photoArticles['year'] }}</td>
								<td>{{ $photoArticles['channels'] }}</td>
								<td>{{ $photoArticles['pagetitle'] }}</td>
								<td class="text-right">{{ number_format($photoArticles['visitors']) }}</td>
								<td class="text-right">{{ number_format($photoArticles['pageviews']) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
	<!-- E: Photo Top Articles Table -->

	<!-- B: Push notification Top Articles Table  -->
	<?php //dd($pushTopArticles[0]['devices']) ?>
	@if(sizeOf($pushTopArticles) > 0)
	<div class="white-space">
		<div class="section__box">
			<div class="abs_right">
				<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
			</div>
			<h3 class="title__section">
				@if(($pushTopArticles[0]['devices'] == 'android') ||  ($pushTopArticles[0]['devices'] == 'ios'))
						Monthly Top 10 Article Push Notification Apps
					@else
						Monthly Top 10 Article Push Notification Browser
					@endif
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
							<th style="width:12%" class="sorter-false">
								<span>KANAL</span>
							</th>
							<th style="width:40%" class="sorter-false">
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
						@foreach($pushTopArticles as $pushArticles)
							<tr>
								<td>{{ $pushArticles['monthName'] }}</td>
								<td>{{ $pushArticles['year'] }}</td>
								<td>{{ $pushArticles['channels'] }}</td>
								<td>{{ $pushArticles['pagetitle'] }}</td>
								<td class="text-right">{{ number_format($pushArticles['visitors']) }}</td>
								<td class="text-right">{{ number_format($pushArticles['pageviews']) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
	<!-- E: Push notification Top Articles Table -->
	
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
$.fn.updateQuery = function (data) {
        var query = {
                'platform' : data['platform'],
                'start' : data['startdate'],
                'end' : data['enddate'],
                'channels' : data['channels']
        }
        var paramQuery = decodeURIComponent($.param(query));
        location.search = paramQuery;
}

// B: Init Page
var params = {};
var queryString = location.search.substring(1);
if (queryString.length <= 0) {
        var start = moment().subtract(5, 'months');
        var end = moment().subtract(1, 'months');
        var platform = 'allweb';
        var channels = 'all';
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

$('input[name="channels"][value="'+channels+'"]').attr('checked', true);
$('.sdrop__item-title').text($('input[name="channels"]:checked').parent().text());

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
        case 'android' :
                $('.platform__title').text('Android');
                $('.filter__menu a').removeClass('active');
                $('.filter__menu a[href$="#android"]').addClass('active');
                break;
        case 'ios' :
                $('.platform__title').text('IOS');
                $('.filter__menu a').removeClass('active');
                $('.filter__menu a[href$="#ios"]').addClass('active');
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
                        'channels': channels
                }
                $(this).updateQuery(params);
        },
});
// E: Monthpicker Change

// B: When Channel Selected
$('input[name="channels"]').click(function() {
		var channels = $(this).val();
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
                'channels' : channels
        }
        $(this).updateQuery(params);
});
// E: When Channel Selected

// B: Platform Change
$('.filter__menu-item > a').bind('click', function() {
        var channels = $('input[name="channels"]:checked').val();
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
                'channels' : channels
        }
        $(this).updateQuery(params);
});
// E: Platform Change

@endsection


	