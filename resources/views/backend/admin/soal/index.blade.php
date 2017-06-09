@extends('master')
@section('title')
<title>Manajemen Soal Ujian - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Manajemen Soal
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><a><i class="fa fa-hashtag"></i> Manajemen Soal</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
  <div class="box-body">
    <div class="row">
      <div class="col-md-2 pull-left">
        <a class="btn btn-primary btn-x" href="{{url('index/manajemen/soal/create')}}"> Tambah Soal</a>
      </div>
      <div class="col-md-10 pull-right">


        
      </div>
      
    </div>
    @if($soal->count() == 0)
    <h3 class="text-danger text-center"> Tidak ada Soal</h3>
    @endif
    @if($soal->count() != 0)
    <table class="table table-hover text-center" id="result">
      
      <tr style="background-color:#346357; color: white;">
        <td width="10%">Id Soal</td>
        <td>kode soal</td>
        <td>Jumlah soal</td>
        <td>publisher</td>
        <td>postdate</td>
        
        <td>
      </tr>
      @foreach($soal as $nsoal)
      <form action="{{url('index/manajemen/soal/'.$nsoal->id_soal)}}" method=POST>
        <input type=hidden value=delete name=_method>
        <tr>
          <td>{{$nsoal->id_soal}}</td>
          <td>{{$nsoal->kode_soal}}</td>
          <td>{{$nsoal->jumlah_soal}} Soal</td>
          <td>{{$nsoal->user->fullname}}</td>
          <td>{{indonesiaDate($nsoal->postdate)}}</td>
          
          <td>
            <button type="submit" onclick="return confirm('Are you sure you want to delete Soal {{$nsoal->kode_soal}} ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
            <span class="fa fa-remove"></span>
            </button>
            <a style="margin-left: 5px" href="{{url('index/manajemen/soal/list', array($nsoal->id_soal))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Masukkan soal" class="btn color1 pull-right">
              <span class="fa fa-clone"></span>
              </a>
            <a href="{{route('index.manajemen.soal.edit', array($nsoal->id_soal))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn color2 pull-right">
              <span class="fa fa-edit"></span>
            </a>

            
          </td>
        </tr>
      </form>
      @endforeach
    </table>
    {!!$soal->render()!!}
    @endif
  </div>
</div>
@stop
@section('javascript')
<script>
function search() {
var kelas = $('#kelas').val();
var jurusan = $('#jurusan').val();
$('#result').html('<img src={{asset("public/admin/img/loading.gif")}}>');
$.ajax({
type:"post",
url:"{{url('index/manajemen/ujian/search')}}",
data: {kelas: kelas, jurusan: jurusan},
success:function(data) {
$('#result').html(data);
$(".pagination").hide();
}
});
}
$('#search').click(function() {
search();
});
</script>
@stop