@extends('master')

@section('title')
    <title>Dashboard - UJIAN ONLINE</title>
@stop

@section('text-info')
          <h1>Dashboard
            <small>Report and Statistics</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
@stop

@section('content')

      <div class="col-md-12" style="margin-bottom:10px;background-color: white;border-top: 1px solid #346357; border-bottom: 1px solid #346357;padding: 10px">
      <center><img src="{{asset('public/admin/img/assalamualaikum.png')}}" alt=""></center>
      <h4 style="font-size: 18px; font-style: italic;text-align:center">Selamat datang di Sistem ujian online</h4>
      </div>

      <!--
        <div class="col-md-3 col-sm-6">
          <div class="info-box">
          
            <!-- Apply any bg-* class to to the icon to color it 
            <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">320</span>
                <span class="info-box-text">data murid</span>
                
              </div><!-- /.info-box-content 
          </div><!-- /.info-box 
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it 
            <span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
              <span class="info-box-number">64</span>
              <span class="info-box-text">data guru</span>
                
              </div><!-- /.info-box-content 
          </div><!-- /.info-box 
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it 
            <span class="info-box-icon bg-red"><i class="fa fa-trophy"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">27</span>
                <span class="info-box-text">Soal</span>
                
              </div><!-- /.info-box-content 
          </div><!-- /.info-box 
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it 
            <span class="info-box-icon bg-green"><i class="fa fa-graduation-cap"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">16</span>
                <span class="info-box-text">Mata Pelajaran</span>
              </div><!-- /.info-box-content 
          </div><!-- /.info-box 
        </div> -->

@stop