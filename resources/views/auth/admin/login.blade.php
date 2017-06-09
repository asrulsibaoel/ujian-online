<!DOCTYPE html>
<html>
<head>
	<title>Sistem Ujian Online SMKN 5 Malang - Login Guru</title>
	<link href="{{asset('public/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <script src="{{asset('public/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('public/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <style>
    body{
    	background-color: #313944;
    	color:white;
    }
    span.input-icon, span.input-help {
	display: block;
	position: relative;
}
.input-icon > input {
	padding-left: 65px;
	padding-right: 6px;
	border-radius: 0px;
	color:white;W
	
}
.input-icon > [class*="fa-"], .input-icon > [class*="clip-"] {
	bottom: 0px;
	color: #909090;
	display: inline-block;
	font-size: 20px;
	line-height: 50px;
	padding: 0px 20px;
	position: absolute;
	top: 0px;
	z-index: 2;
	background-color:#38424f;
	color: white;
	width: 55px;
}
textarea, select, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"] {
	background-color: #464d56;
	height: 50px;
	border: 0px;
	color: #ffffff;
	font-family: inherit;
	font-size: 14px;
	line-height: 1.2;
}
input[type="submit"] {
	border-radius:0px;
}
footer{
	bottom:0;
	left:0;
	width:100%;
	position:absolute;
	font-size: 15px;
}
.btn-custom {
		background-color: #f0793f;
		color:white;
		height:50px;
		font-family:verdana;
		font-weight:bold;
		font-size:20px;
}
.alert-danger {
	background-color: #f0793f;
	border-radius:0px;
	border:none;
	text-transform:capitalize;
}
.close {
	color:white;
}
    </style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
		<div class="col-md-4">

		</div>
		<div class="col-md-4" style="margin-top: 150px">
			@include('flash::message')
					@if (count($errors) > 0)

						<div class="alert alert-danger"> <!-- jika ada error, tampilkan -->
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
			{!!Form::open(['method' => 'post', 'action' => 'Admin\AuthAdminController@postLogin'])!!}
			<input type="hidden" name="status" value="1">
				<div class="form-group">
					<span class="input-icon">
						{!! Form::text('nip', null,['class' => 'form-control', 'placeholder' => 'NIP']) !!}
						<i class="fa fa-user"></i>
					</span>
				</div>
				<div class="form-group">
					<span class="input-icon">
						{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password'])!!}
						<i class="fa fa-lock"></i>
					</span>
				</div>
				<div class="form-group">
					{!! Form::submit('Login', ['class' => 'btn btn-custom btn-block']) !!}
				</div>
			{!!Form::close()!!}
		</div>
		<div class="col-md-4"></div>
		</div>
		<footer><p class="text-center">&copy; {{date('Y')}} STIKI Malang</p></footer>
	</div>
</body>
</html>