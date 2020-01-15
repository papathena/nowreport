<!DOCTYPE html>
<html>

<?php include "includes/head.php";?>

<body class="bg-grey">


<!-- CONTENT -->
	
	<?php $page = 'dashboard'; ?>
	<!-- wrapper -->
	<?php include "includes/menu.php" ?>
	
	<div class="wrapper">


		
		<div class="content">

			<?php include "includes/header.php";?>
			
			<div class="title">
				<h2 class="title__main">
					Welcome Scott Rodriquez
				</h2>
				<p class="title__cap">
					Silahkan memilih menu di navigasi sebelah kiri untuk melihat reporting traffic dan pilih kanal yang diinginkan di menu drop down kanal detikcom
				</p>
			</div>


			<div class="section pt30">

				<div class="section__head">
					<h3 class="title__section">
						Overview Traffic Alldetik - all platform
					</h3>

					<a href="daily-traffic-all.php" class="section__head-link">
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
									12 Desember 2018
								</div>
							</div>

							<div class="card__counter">
								<span class="text-warning">UV (UNIQUE VISITOR)</span>
								10.000.029
								<div class="card__numb danger">
									100%
								</div>
							</div>


							<div class="card__counter">
								<span class="text-primary">PV (PAGE VIEWS)</span>
								10.000.029
								<div class="card__numb info">
									100%
								</div>
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
									12 Desember 2018
								</div>
							</div>

							<div class="card__counter">
								<span class="text-warning">UV (UNIQUE VISITOR)</span>
								10.000.029
								<div class="card__numb danger">
									100%
								</div>
							</div>


							<div class="card__counter">
								<span class="text-primary">PV (PAGE VIEWS)</span>
								10.000.029
								<div class="card__numb info">
									100%
								</div>
							</div>
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
</html>