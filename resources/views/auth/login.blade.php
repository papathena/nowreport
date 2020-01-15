@extends('layouts.main')

@section('headers')
	<style>
		.authpage__wrap {
			width: 55% !important;
		}
	</style>
@endsection

@section('content')
<!-- CONTENT -->
	<div class="container bg-grey">
		
		<div class="authpage">
			<div class="authpage__wrap">
				<div class="white-space clearfix">
					<div class="authpage__bg"></div>
					<div class="authpage__box">
						<h1 class="authpage__brand">
							Now
							<br>
							Report	
						</h1>
					</div>
					<div class="authpage__box">
						<h2 class="authpage__bold">
							Login
						</h2>
						<!-- <div class="authpage__form">
							<form action="index.php">
								<div class="authpage__form-item">
									<div class="authpage__form-icon">
										<span class="icon-user"><span class="path1"></span><span class="path2"></span></span>
									</div>
									<input type="text" id="auth-email" class="authpage__input">
									<label for="auth-email">Your Email</label>
								</div>
								<div class="authpage__form-item">
									<div class="authpage__form-icon">
										<span class="icon-lock"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
									</div>
									<input type="password" id="auth-pass" class="authpage__input">
									<label for="auth-pass">Your Password</label>
									<div class="authpage__form-icon onleft">
										<a href="" class="" data-touch="showpass">
											<span class="icon-ic_eye"></span>
										</a>
									</div>
								</div>
								<div class="authpage__form-item">
									<input type="submit" class="authpage__btn btn" value="LOGIN">
								</div>
							</form>
						</div> -->
						<div class="authpage__connect mt20">
							<span>Login with detikconnect</span>
							<a href="{{ route('detikconnect') }}" class="authpage__btn-connect btn"><span class="authpage__connect-icon"><img src="{{ asset('assets/images/favicon_detikcom.png') }}" alt=""></span>DETIKCONNECT</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

<!-- E: CONTENT -->
@endsection

@section('jqueries');
	$('body').addClass('bg-grey');
@endsection