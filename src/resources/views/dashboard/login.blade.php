@extends('flexcms::layouts.login')

@section('content')	
	<form id="page-login" class="ng-cloak login-area" method="POST" name="loginForm" 
		ng-controller="LoginCtrl"
		ng-submit="submit()" style="margin: auto; background: none; box-shadow: 0 0 0 0;">
		
<!-- 		<div class="logo-container">			
			<img class="logo" 
				style="width: 220px;"
				src="{{ URL::asset('/img/biz-dimension-logo.png') }}"/>
		</div> -->
    <div class="container" >
		<!-- <div class="logo-container login-title">
			{{ config('flexcms.app.login.name') }} Admin Area
		</div>
		<div class="logo-container login-subtitle">
			{{ config('flexcms.app.login.description') }}
		</div> -->
		<div class="row justify-content-center " style="margin: auto;">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary px-4">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0" style="color:rgb(32,168,216)">Forgot password?</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <button type="button" class="btn btn-primary active mt-3">Register Now!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</form>
@stop