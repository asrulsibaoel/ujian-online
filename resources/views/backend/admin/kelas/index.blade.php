@extends('master')

@section('title')
    <title>Manajemen Kelas - UJIAN ONLINE</title>
@stop

@section('text-info')
          <h1>Manajemen Kelas
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a><i class="fa fa-bell"></i> Kelas</a></li>
          </ol>
@stop

@section('content')

      <div class="box box-success">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 pull-left">
              <a class="btn btn-primary btn-x" href="{{url('index/manajemen/kelas/create')}}"> Tambah Kelas</a>
              <hr>
            </div>
          </div>

          @if($kelas->count() == 0)
            <h3 class="text-danger text-center"> Tidak ada Kelas</h3>
          @endif

          @if($kelas->count() != 0)
            <table class="table table-hover text-center">
              
                <tr style="background-color:#605CA8; color: white;">
                  <td width="10%">Id kelas</td>
                  <td>Kelas</td>
                  <td></td>
                </tr>
              @foreach($kelas as $class)
                <tr>
                  <td>{{$class->id_kelas}}</td>
                  <td>{{$class->kelas}}</td>
                  <td>                   
                  <button type="submit" onclick="return confirm('Are you sure you want to delete Kategori {{$class->kelas}} ?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger pull-right" style="margin-left:5px">
                    <span class="fa fa-remove"></span>
                  </button>

                  <a href="{{route('index.manajemen.kelas.edit', array($class->id_kelas))}}" id="edit-user" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary pull-right">
                    <span class="fa fa-edit"></span>
                  </a>

                  </td>
                </tr>
              @endforeach
            </table>
          @endif
        </div>
      </div>

@stop