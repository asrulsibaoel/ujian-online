<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SISTEM UJIAN ONLINE SMK NEGERI 5 MALANG</title>
		<link rel="stylesheet" href="{{asset('public/front/bootstrap.css')}}">
		<link rel="stylesheet" href="{{asset('public/front/template.css')}}">
		<link href="{{asset('public/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
		<script src="{{asset('public/front/jquery-1.js')}}"></script>
		<script src="{{asset('public/front/bootstrap.js')}}"></script>
		<style>
		.tulisan {
			font-size:15px;
		}
			.fa {
				margin-right: 5px;
				width: 30px;
			}
			.btn {
				border-radius:0px;
			}
			.rifki-style {
					max-width: 330px;
					padding: 15px;
					margin: 0px auto;
				}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="margin-bottom:10px;background-color: white;border-top: 1px solid #346357; border-bottom: 1px solid #346357;padding: 10px">
					<center><img src="{{asset('public/admin/img/assalamualaikum.png')}}" alt=""></center>
				</div>
			</div>
			@if (count($errors) > 0)
			<div class="row">
				<div class="alert alert-danger"> <!-- jika ada error, tampilkan -->
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		</div>
		@endif
		@if($ujian->count() < 1)
		<div class="col-md-4 col-md-offset-4">
			<p style="color:red">Tidak ada ulangan yang tersedia untuk anda, harap hubungi petugas ujian / Server</p>
		</div>
		@endif
		@foreach($ujian as $ulangan)

		<div class="col-sm-6 col-md-4 pull-left">
			<div class="account-wall">
				<div class="rifki-style">
					<?php $waktu = $ulangan->waktu / 60; ?>
					<p class="tulisan"><i class="fa fa-book"></i>{{'Mata Pelajaran : '.$ulangan->mapel->mapel}}</p>
					<!--<p class="tulisan"><i class="fa fa-graduation-cap"></i>{{'Guru : '.$ulangan->user_admin->fullname}}</p>-->
					<p class="tulisan"><i class="fa fa-clock-o"></i>{{'Waktu: '.$waktu.' Menit'}}</p>
					<p class="tulisan"><i class="fa fa-briefcase"></i>{{'Jumlah Soal: '.$ulangan->soal->jumlah_soal}}</p>
					<p class="tulisan"><i class="fa fa-flag"></i>{{'KKM: '.$ulangan->kkm}}</p>
					<a class="btn btn-lg btn-primary btn-block" href="{{url('ujian/'.$ulangan->id_ujian)}}">Mulai</a>
				</div>
			</div>
		</div>
		@endforeach
		<div class="row">
			<div class="col-md-12 text-center" style="margin-top: 10px">
			<p>&copy; {{date('Y')}} STIKI Malang</p>
			</div>
		</div>
	</div>
</div>
</body></html>