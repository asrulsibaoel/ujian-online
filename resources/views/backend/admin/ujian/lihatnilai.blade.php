@extends('master')
@section('title')
<title>Hasil nilai ujian {{$mapel}} - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Hasil nilai ujian {{$mapel}}
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li><a href="{{url('index/manajemen/ujian')}}"><i class="fa fa-hashtag"></i> Manajemen ujian</a></li>
  <li class="active"><a> Hasil ujian {{$mapel}}</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
  <div class="box-body">

    @if($keterangan->count() == 0)
    <h3 class="text-danger text-center"> Belum ada yang mengikuti ujian ini</h3>
    @else
    <h4>Data siswa yang <i><b>Telah mengikuti ujian</b></i>:</h4>
    <table class="table table-hover text-center" id="result">
      <tr style="background-color:#346357; color: white;">
        <td>Nama siswa</td>
        <td>Nilai</td>
        <td>Keterangan</td>
      </tr>
      @foreach($keterangan as $siswa_lulus)
      <tr>
      <td>{{$siswa_lulus->siswa->fullname}}</td>
      <td>{{$siswa_lulus->nilai}}</td>
      <td>{{$siswa_lulus->keterangan}}</td>
      </tr>
      @endforeach
    </table>
    </div>
    </div>
    
    @endif
@stop
