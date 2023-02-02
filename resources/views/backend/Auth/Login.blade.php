<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
</head>
<style>
.form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>
<body>
	<div class="container" style="margin-top: 5%;">
		<div class="row">
			@if(Request::get("notify") == "invalid")
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="alert alert-danger">Please check email and password</div>
				@endif
				<div class="account-wall" style="margin: auto; width: 350px;">
					<img class="profile-img" src="https://kiemsoat.idmart.com.vn/wp-content/uploads/2019/06/icon-ng%C6%B0%E1%BB%9Di-d%C3%B9ng.png"
						alt="">
					<form class="form-signin" method="post" action="">
						@csrf
						<input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
						<input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
						<input type="reset" value="Reset" class="btn btn-lg btn-danger btn-block">
					</form>
				</div>
				<a href="{{ url('register') }}" class="text-center new-account">Create an account </a>
			</div>
		</div>
	</div>
</body>
</html>