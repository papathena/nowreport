@extends('toparticles::layouts.main')

@section('headers')
	<link rel="stylesheet" href="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ Module::asset('toparticles:datatable/datatables.min.css') }}">
	<style> 
	#tabs, #tabs-csArticles
	{
			padding: 0;
	}

	#tabs ul, #tabs-csArticles ul
	{
		margin: 0;
		padding: 5px 10px;
	}

	#tabs ul li, #tabs-csArticles ul li
	{
		display: inline-block;
	}

	#tabs-csArticles ul li
	{
		margin: 3px 5px;
		text-align: center;
		padding: 3px 10px;
	} 
	
	#tabs-csArticles ul li.ui-tab
	{	
		border-radius: 25px;
		border: 1px solid #00f;
	}
	
	#tabs-csArticles ul li.ui-tabs-active
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
		<span class="title__sub">Daily Traffic</span>
		<h2 class="title__main">
			Top Article (Channel Source)
		</h2>
		<div class="title__cap">
			Pada laman ini akan menampilkan list top 10 artikel yang berasal dari channel source tertentu. Silakan pilih kanal yang Anda inginkan, kemudian pilih channel source yang Anda inginkan, dan pilih tanggal tertentu jika Anda ingin memantau traffic sebelumnya. 
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
				
				<!-- B: Channel Source Filter -->
				@include('toparticles::layouts.options-source-multi')
				<!-- E:	Channel Sourcce Filter -->
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
				<!-- <li class="filter__menu-item">
						<a href="#android" class="">
							Android
						</a>
				</li>
				<li class="filter__menu-item" class="">
						<a href="#ios" class="" >
							IOS
						</a>
				</li> -->
			</ul>

			<div id="allweb" class="platform"></div>
			<div id="desktop" class="platform"></div>
			<div id="mobile" class="platform"></div>
		</div>
		<!-- E: Platform Filter -->
		
		<!-- B: Channel Source Top Articles Table  -->
		<div class="white-space">
			<div class="section__box">
				<div class="abs_right">
					<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
				</div>
				<h3 class="title__section">
					Daily Top 10 Article <small>(Channel Source)</small>
				</h3>
				<div class="table__box pt30">
					<table class="table-default" data-table="sorter">
						<thead class="sorter">
							<tr>
								<th style="width:15%" class="">
									<span>DATE</span>
								</th>
								<th style="width:10%" class="sorter-false">
									<span>KANAL</span>
								</th>
								<th style="width:15%" class="sorter-false">
									<span>CH. SOURCE</span>
								</th>
								<th style="width:30%" class="sorter-false">
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
							@foreach($csTopArticles as $csArticles)
								<tr>
									<td>{{ $csArticles['date'] }}</td>
									<td>{{ $csArticles['channels'] }}</td>
									<td>{{ $csArticles['chgroup'] }}</td>
									<td>{{ $csArticles['pagetitle'] }}</td>
									<td class="text-right">{{ number_format($csArticles['visitors'],0,",",".") }}</td>
									<td class="text-right">{{ number_format($csArticles['pageviews'],0,",",".") }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- E: Channel Source Top Articles Table -->
		@include('toparticles::layouts.popup-channel-source')
	</div>
@endsection

@section('js-sources')
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/daterange-picker/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:js/monthpicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:datatable/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('toparticles:jquery/jquery.parseparams.js') }}"></script>
@endsection

@section('jqueries')
	// B: Init page
	$("#tabs").tabs({
		"show": function(event, ui) {
			var oTable = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTable.length > 0 ) {
				oTable.fnAdjustColumnSizing();
			}
		}
	});

	$("#tabs-csArticles").tabs({
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
			'chgroups[]' : data['chgroups']
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
		var chgroups = [
			'Direct',
		];
		var params = {
			'platform' : platform,
			'startdate' : start.format('YYYY-MM-DD'),
			'enddate' : end.format('YYYY-MM-DD'),
			'channels': channels,
			'chgroups': chgroups
		}
		$(this).updateQuery(params);
	} 

	var parsedQuery = $.parseParams(queryString);
	var platform = parsedQuery['platform'];
	var start = parsedQuery['start'];
	var end = parsedQuery['end'];
	var channels = parsedQuery['channels'];
	var chgroups = parsedQuery['chgroups'];
	$('input[class="rdinput"]').daterangepicker({
		startDate : moment(start).format('DD/MM/YYYY'),
		endDate : moment(end).format('DD/MM/YYYY'),
		locale: {
			format: 'DD/MM/YYYY'
		}
	});
	
	$('input[name="channels"][value="'+channels+'"]').attr('checked', true);
	$('.sdrop__item-title').text($('input[name="channels"]:checked').parent().text());
	$('.options-multi').find(':checkbox[name^="chgroups"]').each(function() {
		$(this).prop("checked", ($.inArray($(this).val(), chgroups) != -1));
	});
	
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
		default :
			$('.platform__title').text('All Web');
			$('#tabs a').removeClass('active');
			$('#tabs a[href$="#allweb"]').addClass('active');
	}
	// E: Init page
	
	// B: When platform menu clicked
	$('.filter__menu-item > a').bind('click', function() {
		var chgroups = $('.rdrop__opt input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (chgroups.length <= 0) {
			alert('Select any channel source before applied!');
            return;
		}
		var platform = $(this).attr('href').substring(1);
		var channels = $('input[name="channels"]:checked').val();
		var start = $('input[class="rdinput"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end = $('input[class="rdinput"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels,
			'chgroups' : chgroups
		}
		$(this).updateQuery(params);
	});
	// E: When platform menu clicked
	
	// B: When channel selected
	$('input[name="channels"]').click(function() {
		var channels = $(this).val();
		var chgroups = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (chgroups.length <= 0) {
			alert('Select any channel source before applied!');
            return;
		}
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var start = $('input[class="rdinput"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end = $('input[class="rdinput"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels,
			'chgroups' : chgroups
		}
		$(this).updateQuery(params);
	});
	// E: When channel selected
	
	// B: When channel source applied
	$('.apply-chgroups').click(function() {
		var channels = $('input[name="channels"]:checked').val();
		var chgroups = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (chgroups.length <= 0) {
			alert('Select any channel source before applied!');
            return;
		}
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var start = $('input[class="rdinput"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
		var end = $('input[class="rdinput"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels,
			'chgroups' : chgroups
		}
		$(this).updateQuery(params);
	});
	// E: When channel source applied
	
	// B: When date picker changed
	$('input[class="rdinput"]').on('apply.daterangepicker', function(ev, picker) {
		var channels = $('input[name="channels"]:checked').val();
		var chgroups = $('.options-multi input:checkbox:checked').map(function() {
			return $(this).val();
		}).get();
		if (chgroups.length <= 0) {
			alert('Select any channel source before applied!');
            return;
		} 
		var platform = $('.filter__menu-item > a.active').attr('href').substring(1);
		var start = picker.startDate.format('YYYY-MM-DD');
		var end = picker.endDate.format('YYYY-MM-DD');
		var params = {
			'platform' : platform,
			'startdate' : start,
			'enddate' : end,
			'channels' : channels,
			'chgroups' : chgroups
		}
		$(this).updateQuery(params);
	});
	// E: When date picker changed
	
@endsection