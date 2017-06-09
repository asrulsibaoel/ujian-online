@extends('master-siswa')
@section('title')
<title>Hasil akhir - Sistem ujian online</title>
@stop
@section('css')
<style>
p {
  font-weight: 300;
  font-size: 30px;
  text-align: center;
  color: #346357;
}
body {
  background-color:#EFF3F8;
}
#box {
  padding: 20px 20px;
}
.hasil {
  font-size: 40px;
}
.account-wall {
  margin-top: 20px;
  padding: 40px 0px 20px 0px;
  background-color: #fff;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  /* margin-bottom: 5px; */
}
.copyright {
  color: #666;
  display: block;
  margin-top: 10px;
  font-size: 85%;
}
</style>
@stop

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="account-wall">
    <p>Jumlah benar: {{$benar}}</p>
    <p>Jumlah salah: {{$salah}}</p>
    <p class="nilai">Nilai: {{substr($nilaiakhir, 0,4)}}</p>
    <hr>
    @if($nilaiakhir < $kkm)
    <p class="hasil">Maaf, anda tidak lulus ujian ini!</p>
    @else
    <p class="hasil">Selamat, anda lulus ujian ini!</p>
    @endif
    </div>
  </div>
</div>
<a href="#" class="text-center copyright">© 2016 SMK INFOKOM BOGOR</a>

@stop