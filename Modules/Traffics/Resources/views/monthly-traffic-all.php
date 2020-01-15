<!DOCTYPE html>
<html>

<?php include "includes/head.php";?>

<body class="bg-grey">


<!-- CONTENT -->
	
	<?php $page = 'mth_traffic_overview_mon'; ?>
	
	<!-- wrapper -->
	<?php include "includes/menu.php" ?>

	<div class="wrapper">
		
		<div class="content">

			<?php include "includes/header.php";?>
			
			<div class="title">
				<span class="title__sub">Monthly Traffic</span>
				<h2 class="title__main">
					Traffic Overview
				</h2>
				<div class="title__cap">
					Halaman ini menampilkan rangkuman dari total traffic monthly (UV-PV) Detikcom dan average daily per bulan berdasarkan platform. Silakan pilih bulan dan kanal yang Anda inginkan pada menu drop down dibawah ini.
				</div>
			</div>


			<div class="section">

				<div class="filter">
					<div class="filter__options clearfix">
						
						<div class="filter__date">
					
							<input type='text' id="startMonth" class="monthpicker rdinput" placeholder='start month' value='' readonly />
							<span class="wbreak">to</span>
							<input type='text' id="endMonth" class="monthpicker rdinput" placeholder='end month' value='' readonly/>

						</div>
						

						<?php include "includes/options-kanal-multi.php" ?>
						
					</div>

					

					<div class="filter__dots"><span class="icon-dots"></span></div>
					<div class="filter__menu">
						<div class="filter__menu-item">
							<a href="monthly-traffic-all.php" class="active">
								All Platform
							</a>
						</div>
						<div class="filter__menu-item">
							<a href="monthly-traffic-all-web.php" class="">
								All Web (Desktop + Mobile)
							</a>
						</div>
						<div class="filter__menu-item">
							<a href="monthly-traffic-desktop.php">
								Desktop
							</a>
						</div>
						<div class="filter__menu-item">
							<a href="monthly-traffic-m.php">
								Mobile
							</a>
						</div>
						<div class="filter__menu-item">
							<a href="monthly-traffic-android.php">
								Android
							</a>
						</div>
						<div class="filter__menu-item">
							<a href="monthly-traffic-ios.php">
								IOS
							</a>
						</div>
					</div>
				</div>
				
				<div class="white-space">

					
					<div class="section__box">
						<div class="abs_right">
							<a href="" class="btn btn-info d-csv"><span>DOWNLOAD AS CSV</span></a>
							<a href="" class="btn btn-primary-alt d-png"><span>DOWNLOAD AS PNG</span></a>
						</div>
						<h3 class="title__section">
							Platform: All platform - Users
						</h3>

						<div class="chart">
							
							<canvas id="c-users" width="400" height="150"></canvas>
							

						</div>
					</div>

					
					<div class="section__box">
						<h3 class="title__section">
							Platform: All platform - Pageviews
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
							Average Traffic Kanal - All Platform
						</h3>

						

						
						<div class="table__box">
							<table class="table-default" data-table="sorter">
								<thead class="sorter">
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
									<tr>
										<td>Finance</td>
										<td>1.202.999</td>
										<td>23.2334.33</td>
									</tr>
									<tr>
										<td>News</td>
										<td>32.443.222</td>
										<td>23.322.232</td>
									</tr>
									<tr>
										<td>Finance</td>
										<td>456.567.566</td>
										<td>1.234.222</td>
									</tr>
									<tr>
										<td>Sepakbola</td>
										<td>1.324.222</td>
										<td>38.343.343</td>
									</tr>
									<tr>
										<td>Sepakbola</td>
										<td>34.099.000</td>
										<td>1.202.999</td>
									</tr>
									<tr>
										<td>Finance</td>
										<td>1.202.999</td>
										<td>23.2334.33</td>
									</tr>
									<tr>
										<td>News</td>
										<td>32.443.222</td>
										<td>23.322.232</td>
									</tr>
									<tr>
										<td>Finance</td>
										<td>456.567.566</td>
										<td>1.234.222</td>
									</tr>
									<tr>
										<td>Sepakbola</td>
										<td>1.324.222</td>
										<td>38.343.343</td>
									</tr>
									<tr>
										<td>Sepakbola</td>
										<td>34.099.000</td>
										<td>1.202.999</td>
									</tr>
									<tr>
										<td>Finance</td>
										<td>1.202.999</td>
										<td>23.2334.33</td>
									</tr>
									<tr>
										<td>News</td>
										<td>32.443.222</td>
										<td>23.322.232</td>
									</tr>
									<tr>
										<td>Finance</td>
										<td>456.567.566</td>
										<td>1.234.222</td>
									</tr>
									<tr>
										<td>Sepakbola</td>
										<td>1.324.222</td>
										<td>38.343.343</td>
									</tr>
									<tr>
										<td>Sepakbola</td>
										<td>34.099.000</td>
										<td>1.202.999</td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>



				</div>


			</div>

		</div>

	</div>
	<!-- E: wrapper -->

<!-- E: CONTENT -->


<?php include "includes/footer.php";?>

</body>
<?php include "includes/js.php";?>


<script>

	
	var callRand = function() {
		
		var random1 = Math.floor(Math.random() * 100) + 1  ;
		return random1;
	}

	var callsets = function() {
		var arr1 = [];

		for (var i = 12 - 1; i >= 0; i--) {
			 arr1.push(callRand());
		}

		return arr1;
	}
	
	var cuserId = document.getElementById("c-users");

	var cpvId = document.getElementById("c-pageviews");
        var cUser = new Chart(cuserId, {
        
        "type": "line",
          "data": {
            "labels": [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",

            ],
            "datasets": [
              {
                "data": callsets(),
                "fill": false,
                label: "Finance",
                borderColor: '#4dc9f6',
                backgroundColor: '#4dc9f6',
              },
              {
                "data": callsets(),
                "fill": false,
                label: "Sport",
                borderColor: '#f67019',
                backgroundColor: '#f67019',

              },
              {
                "data": callsets(),
                "fill": false,
                label: "Inet",
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgb(255, 99, 132)',
              },

            ]
          },
          "options": {
          	tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true
                  }
                }
              ]
            }
          }
        });
        var cPv = new Chart(cpvId, {
        
        "type": "line",
          "data": {
            "labels": [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",

            ],
            "datasets": [
              {
                "data": callsets(),
                "fill": false,
                label: "Finance",
                borderColor: '#4dc9f6',
                backgroundColor: '#4dc9f6',
              },
              {
                "data": callsets(),
                "fill": false,
                label: "Sport",
                borderColor: '#f67019',
                backgroundColor: '#f67019',

              },
              {
                "data": callsets(),
                "fill": false,
                label: "Inet",
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgb(255, 99, 132)',
              },

            ]
          },
          "options": {
          	tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true
                  }
                }
              ]
            }
          }
        });
	
</script>

</html>