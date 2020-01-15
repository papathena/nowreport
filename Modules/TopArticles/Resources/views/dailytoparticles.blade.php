@extends('toparticles::layouts.main')

@section('headers')
	<link rel="stylesheet" href="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ Module::asset('toparticles:datatable/datatables.min.css') }}">
	<style> 
	#tabs, #tabs-allArticles,
	#tabs-newsArticles,
	#tabs-photoArticles,
	#tabs-pushArticles {
			padding: 0;
	}

	#tabs ul, #tabs-allArticles ul,
	#tabs-newsArticles ul,
	#tabs-photoArticles ul,
	#tabs-pushArticles ul {
		margin: 0;
		padding: 5px 10px;
	}

	#tabs ul li, #tabs-allArticles ul li,
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
		<span class="title__sub">Daily Traffic</span>
		<h2 class="title__main">
			Daily Top Articles (Overview)
		</h2>
		<div class="title__cap">
			Pada laman ini akan menampilkan list top 10 artikel dari semua jenis artikel dan top artikel push notifikasi pada hari tertentu. Silakan pilih kanal yang Anda inginkan dan pilih tanggal tertentu jika Anda ingin memantau traffic sebelumnya.
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
				@include('toparticles::layouts.options-kanal')
				<!-- E:	Channel Filter -->
			</div>
		</div>
		<!-- E: Filter -->

		<!-- B: Platform Filter -->
		<div class="filter__dots"><span class="icon-dots"></span></div>
		<div id="tabs" class="filter__menu">
			<ul>
				<!-- <li class="filter__menu-item">
						<a href="#all" class="">
						All Platform
						</a>
				</li> -->
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

			<div id="all" class="platform"></div>
			<div id="allweb" class="platform"></div>
			<div id="desktop" class="platform"></div>
			<div id="mobile" class="platform"></div>
			<div id="android" class="platform"></div>
			<div id="ios" class="platform"></div>
		</div>
		<!-- E: Platform Filter -->

		<!-- B: All Top Articles Table  -->
		<div class="white-space">
			<div class="section__box">
				<div class="abs_right">
					<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
				</div>
				<h3 class="title__section">
					Daily Top 10 Article <small>(All Content Type)</small>
				</h3>
				<div class="table__box pt30">
					<table class="table-default" data-table="sorter">
						<thead class="sorter">
							<tr>
								<th style="width:15%" class="">
									<span>DATE</span>
								</th>
								<th style="width:15%" class="sorter-false">
									<span>KANAL</span>
								</th>
								<th style="width:40%" class="sorter-false">
									<span>ARTICLE TITLE</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>USERS</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>PAGEVIEWS</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($allTopArticles as $allArticles)
								<tr>
									<td>{{ $allArticles['date'] }}</td>
									<td>{{ $allArticles['channels'] }}</td>
									<td>{{ $allArticles['pagetitle'] }}</td>
									<td class="text-right">{{ number_format($allArticles['visitors'],0,",",".") }}</td>
									<td class="text-right">{{ number_format($allArticles['pageviews'],0,",",".") }}</td>
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
					Daily Top 10 Article <small>(Regular)</small>
				</h3>
				<div class="table__box pt30">
					<table class="table-default" data-table="sorter">
						<thead class="sorter">
							<tr>
								<th style="width:15%" class="">
									<span>DATE</span>
								</th>
								<th style="width:15%" class="sorter-false">
									<span>KANAL</span>
								</th>
								<th style="width:40%" class="sorter-false">
									<span>ARTICLE TITLE</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>USERS</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>PAGEVIEWS</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($newsTopArticles as $newsArticles)
								<tr>
									<td>{{ $newsArticles['date'] }}</td>
									<td>{{ $newsArticles['channels'] }}</td>
									<td>{{ $newsArticles['pagetitle'] }}</td>
									<td class="text-right">{{ number_format($newsArticles['visitors'],0,",",".") }}</td>
									<td class="text-right">{{ number_format($newsArticles['pageviews'],0,",",".") }}</td>
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
					Daily Top 10 Article <small>(Photo)</small>
				</h3>
				<div class="table__box pt30">
					<table class="table-default" data-table="sorter">
						<thead class="sorter">
							<tr>
								<th style="width:15%" class="">
									<span>DATE</span>
								</th>
								<th style="width:15%" class="sorter-false">
									<span>KANAL</span>
								</th>
								<th style="width:40%" class="sorter-false">
									<span>ARTICLE TITLE</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>USERS</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>PAGEVIEWS</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($photoTopArticles as $photoArticles)
								<tr>
									<td>{{ $photoArticles['date'] }}</td>
									<td>{{ $photoArticles['channels'] }}</td>
									<td>{{ $photoArticles['pagetitle'] }}</td>
									<td class="text-right">{{ number_format($photoArticles['visitors'],0,",",".") }}</td>
									<td class="text-right">{{ number_format($photoArticles['pageviews'],0,",",".") }}</td>
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
		@if (sizeOf($pushTopArticles) > 0)
		<div class="white-space">
			<div class="section__box">
				<div class="abs_right">
					<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
				</div>
				<h3 class="title__section">
					@if(($pushTopArticles[0]['devices'] == 'android') ||  ($pushTopArticles[0]['devices'] == 'ios'))
						Daily Top 10 Article Push Notification Apps
					@else
						Daily Top 10 Article Push Notification Browser
					@endif
				</h3>
				<div class="table__box pt30">
					<table class="table-default" data-table="sorter">
						<thead class="sorter">
							<tr>
								<th style="width:15%" class="">
									<span>DATE</span>
								</th>
								<th style="width:15%" class="sorter-false">
									<span>KANAL</span>
								</th>
								<th style="width:40%" class="sorter-false">
									<span>ARTICLE TITLE</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>USERS</span>
								</th>
								<th style="width:15%" class="text-right">
									<span>PAGEVIEWS</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pushTopArticles as $pushArticles)
								<tr>
									<td>{{ $pushArticles['date'] }}</td>
									<td>{{ $pushArticles['channels'] }}</td>
									<td>{{ $pushArticles['pagetitle'] }}</td>
									<td class="text-right">{{ number_format($pushArticles['visitors'],0,",",".") }}</td>
									<td class="text-right">{{ number_format($pushArticles['pageviews'],0,",",".") }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
		<!-- E: Push Notitification Top Articles Table -->

	</div>
@endsection

@section('js-sources')
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/daterange-picker/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/monthpicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:datatable/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:jquery/jquery.parseparams.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/blob/Blob.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/blob/canvas-to-blob.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/blob/FileSaver.min.js') }}"></script>
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

	$("#tabs-allArticles").tabs({
		"show": function(event, ui) {
			var oTable = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTable.length > 0 ) {
				oTable.fnAdjustColumnSizing();
			}
		}
	});

	$("#tabs-newsArticles").tabs({
		"show": function(event, ui) {
			var oTable = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTable.length > 0 ) {
				oTable.fnAdjustColumnSizing();
			}
		}
	});

	$("#tabs-photoArticles").tabs({
		"show": function(event, ui) {
			var oTable = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTable.length > 0 ) {
				oTable.fnAdjustColumnSizing();
			}
		}
	});

	$("#tabs-pushArticles").tabs({
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
			'channels' : data['channels']
		}
		var paramQuery = decodeURIComponent($.param(query));
		location.search = paramQuery;
	}	

	var params = {};

	var queryString = location.search.substring(1);
	if (queryString.length <= 0) {
		var start = moment().subtract(6, 'days');
		var end = moment().subtract(1, 'days');
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
	$('input[name="channels"][value="'+channels+'"]').attr('checked', true);
	$('.sdrop__item-title').text($('input[name="channels"]:checked').parent().text());

	switch (platform) {
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
			$('.platform__title').text('All Web');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#allweb"]').addClass('active');
	}

	$('.filter__menu-item > a').bind('click', function() {
		var channels = $('input[name="channels"]:checked').val();
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

	// B: When channel selected
	$('input[name="channels"]').click(function() {
		var channels = $(this).val();
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var start = $('input[class="rdinput"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end = $('input[class="rdinput"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels,
		}
		$(this).updateQuery(params);
	});
	// E: When channel selected

	$('input[class="rdinput"]').on('apply.daterangepicker', function(ev, picker) {
		var channels = $('input[name="channels"]:checked').val();
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