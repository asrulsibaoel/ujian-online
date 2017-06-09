@extends('master')
@section('title')
<title>Manajemen Ulangan - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Manajemen Ujian
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><a><i class="fa fa-hashtag"></i> Manajemen ujian</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
  <div class="box-body">
    <div class="row">
      <div class="col-md-2 pull-left">
        <a class="btn btn-primary btn-x" href="{{url('index/manajemen/ujian/create')}}"> Tambah Ujian</a>
      </div>
      <div class="col-md-10 pull-right">
        <div class="pull-right">
          <a class="btn btn-primary btn-x" id="search">Filter</a>
        </div>
        <div class="pull-right" style="margin-right: 10px">
          {!! Form::select('Jurusan', $jurusan, null, ['class' => 'form-control btn-x', 'id' => 'jurusan'])!!}
        </div>
        <div class="pull-right" style="margin-right: 10px">
          {!! Form::select('Kelas', $kelas, null, ['class' => 'form-control btn-x', 'id' => 'kelas'])!!}
        </div>
        
      </div>
      
    </div>
    @if($ujian->count() == 0)
    <h3 class="text-danger text-center"> Tidak ada Ulangan</h3>
    @endif
    @if($ujian->count() != 0)
    <table class="table table-hover text-center" id="result">
      
      <tr style="background-color:#346357; color: white;">
        <td width="10%">Id Ujian</td>
        <td>Kelas</td>
        <td>Jurusan</td>
        <td>Mapel</td>
        <td>Waktu</td>
        <td>KKM</td>
        <td>Publisher</td>
        <td>Status</td>
        <td>Last Updated</td>
        <td width="15%"></td>
      </tr>
      @foreach($ujian as $ulangan)

      <?php $waktu = $ulangan->waktu / 60; ?>
      <form action="{{url('index/manajemen/ujian/'.$ulangan->id_ujian)}}" method=POST>
        <input type=hidden value=delete name=_method>
        <tr>
          <td>{{$ulangan->id_ujian}}</td>
          <td>{{$ulangan->kelas->kelas}}</td>
          <td>{{$ulangan->jurusan->jurusan}}</td>
          <td>{{$ulangan->mapel->mapel}}</td>
          <td>{{$waktu.' Menit'}}</td>
          <td>{{$ulangan->kkm}}</td>
          <td>{{$ulangan->user_admin->fullname}}</td>
          <td>
            @if($ulangan->status == 1)
            <i style="color:green;font-weight: bolder">Active</i>
            @else
            <i style="color:red;font-weight: bolder">Not Active</i>
            @endif
          </td>
          <td>{{indonesiaDate($ulangan->postdate)}}</td> 
          <td>
          <a href="{{url('index/manajemen/ujian/view/'.$ulangan->id_ujian)}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Lihat hasil ujian" class="btn btn-primary pull-right" style="margin-left:5px">
              <span class="fa fa-eye"></span>
            </a>
            <button type="submit" onclick="return confirm('Are you sure you want to delete Ujian {{$ulangan->mapel->mapel}} ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
            <span class="fa fa-remove"></span>
            </button>
            
            <a href="{{route('index.manajemen.ujian.edit', array($ulangan->id_ujian))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn color2 pull-right">
              <span class="fa fa-edit"></span>
            </a>
            <!--
            <a href="{{url('index/manajemen/ujian/view', array($ulangan->id_ujian))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Lihat Hasil" class="btn btn-block color1 pull-right">
              <span class="fa fa-eye"></span>
            </a>-->
          </td>
        </tr>
      </form>
      @endforeach
    </table>
    {!!$ujian->render()!!}
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