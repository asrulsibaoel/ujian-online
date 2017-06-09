@extends('master')
@section('title')
<title>Manajemen jurusan - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Manajemen Jurusan
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><a><i class="fa fa-briefcase"></i> Manajemen Jurusan</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
  <div class="box-body">
    <div class="row">
      <div class="col-md-2 pull-left">
        <a class="btn btn-primary btn-x" href="{{url('index/manajemen/jurusan/create')}}"> Tambah Jurusan</a>
      </div>

      
    </div>
    @if($jurusan->count() == 0)
    <h3 class="text-danger text-center"> Tidak ada jurusan</h3>
    @endif
    @if($jurusan->count() != 0)
    <table class="table table-hover text-center" id="result">
      
      <tr style="background-color:#346357; color: white;">
        <td width="10%">Id jurusan</td>
        <td>Nama Jurusan</td>
        <td width="15%"></td>
      </tr>
      @foreach($jurusan as $daftar_jurusan)

      <form action="{{url('index/manajemen/jurusan/'.$daftar_jurusan->id_jurusan)}}" method=POST>
        <input type=hidden value=delete name=_method>
        <tr>
          <td>{{$daftar_jurusan->id_jurusan}}</td>
          <td>{{$daftar_jurusan->nama_jurusan}}</td>
          <td>
            <button type="submit" onclick="return confirm('Are you sure you want to delete {{$daftar_jurusan->nama_jurusan}} ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
            <span class="fa fa-remove"></span>
            </button>
            
            <a href="{{route('index.manajemen.jurusan.edit', array($daftar_jurusan->id_jurusan))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn color2 pull-right">
              <span class="fa fa-edit"></span>
            </a>

          </td>
        </tr>
      </form>
      @endforeach
    </table>
    {!!$jurusan->render()!!}
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