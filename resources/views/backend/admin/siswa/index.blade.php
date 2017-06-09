@extends('master')
@section('title')
<title>Manajemen Siswa - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Manajemen Siswa
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><a><i class="fa fa-users"></i> Manajemen siswa</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
  <div class="box-body">
    <div class="row">
      <div class="col-md-2 pull-left">
        <a class="btn btn-primary btn-x" href="{{url('index/manajemen/siswa/create')}}"> Tambah Siswa</a>
      </div>
      <div class="col-md-10 pull-right">
        <div class="pull-right">
          <a class="btn btn-primary btn-x" id="search">Filter</a>
        </div>
        
        <div class="pull-right" style="margin-right: 10px">
          <div class="col-md-6">{!! Form::text('kelas', null, ['class' => 'form-control btn-x', 'id' => 'kelas', 'placeholder' => 'kelas'])!!}</div>
          <div class="col-md-6">{!! Form::select('jurusan', $jurusan, null, ['class' => 'form-control btn-x', 'id' => 'nama-jurusan', 'placeholder' => 'jurusan'])!!}</div>
        </div>
        <div class="pull-right" style="margin-right: 10px">
        </div>
        
      </div>
      
    </div>
    @if($siswa->count() == 0)
    <h3 class="text-danger text-center"> Tidak ada Siswa</h3>
    @endif
    @if($siswa->count() != 0)
    <table class="table table-hover text-center" id="result">
      
      <tr style="background-color:#346357; color: white;">
        <td width="10%">NIS</td>
        <td>Nama</td>
        <td>Alamat</td>
        <td>Semester</td>
        <td>Kelas</td>
        <td>Jurusan</td>
        <td width="15%"></td>
      </tr>
      @foreach($siswa as $daftar_siswa)

      <form action="{{url('index/manajemen/siswa/'.$daftar_siswa->nis)}}" method=POST>
        <input type=hidden value=delete name=_method>
        <tr>
          <td>{{$daftar_siswa->nis}}</td>
          <td>{{$daftar_siswa->nama_siswa}}</td>
          <td>{{$daftar_siswa->alamat}}</td>
          <td>{{$daftar_siswa->semester}}</td>
          <td>{{$daftar_siswa->kelas}}</td>
          <td>{{$daftar_siswa->jurusan->nama_jurusan}}</td>
            <button type="submit" onclick="return confirm('Are you sure you want to delete {{$daftar_siswa->fullname}} ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
            <span class="fa fa-remove"></span>
            </button>
            
            <a href="{{route('index.manajemen.siswa.edit', array($daftar_siswa->nis))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn color2 pull-right">
              <span class="fa fa-edit"></span>
            </a>

          </td>
        </tr>
      </form>
      @endforeach
    </table>
    {!!$siswa->render()!!}
    @endif
  </div>
</div>
@stop
@section('javascript')
<script>
function search() {
var kelas = $('#kelas').val();
var jurusan = $('#nama-jurusan').val();
$('#result').html('<img src={{asset("public/admin/img/loading.gif")}}>');
$.ajax({
type:"post",
url:"{{url('index/manajemen/siswa/search')}}",
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