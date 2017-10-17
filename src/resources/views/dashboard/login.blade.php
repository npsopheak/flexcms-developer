@extends('flexcms::layouts.login')

@section('content')	
<form id="page-login" class="ng-cloak login-area" method="POST" name="loginForm" ng-controller="LoginCtrl" ng-submit="submit()" style="margin: auto; background: none; box-shadow: 0 0 0 0;">
		<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Username" name="username" ng-model="user.email" required id="text1">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Password" name="password" ng-model="user.password" required id="text2">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary px-4" onclick="test()">Login</button>
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

</form>
@stop
<script type="text/javascript">
    function test(){
        if(   document.getElementById("text1").value == "workshop"
           && document.getElementById("text2").value == "workshop")
        {
            alert( "validation succeeded" );
        }
        else
        {
            alert( "validation failed" );
        }
    }

</script>