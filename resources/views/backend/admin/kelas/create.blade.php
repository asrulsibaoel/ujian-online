@extends('master')

@section('title')
    <title>Tambah Kelas - UJIAN ONLINE</title>
@stop

@section('text-info')
          <h1>Tambah Kelas
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{url('index/manajemen/kelas')}}"><i class="fa fa-bell"></i> Kelas</a></li>
            <li class="active"><a> Tambah Kelas</a></li>
          </ol>
@stop

@section('content')

      <div class="box box-success">
        <div class="box-body">
          <div class="panel-body" id="kontainer">
                <div class="panel panel-default" style="border: 1px solid #605CA8; border-radius: 0px">
                  <div class="panel-heading" style="background-color: #605CA8; color: white; border-radius: 0px">
                    <h3 class="panel-title"><i class="fa fa-plus"></i> New Record</h3>

                  </div>
                  <div class="panel-body">
                    @if($errors->any())
                        <ul class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    {!! Form::model('new App\kelas', ['class' => 'form-horizontal form-label-left', 'method' => 'post', 'action' => ['kelasController@store']]) !!}<!-- start form -->
                    {!! Form::token() !!}
                    <div class="row">
                    <div class="form-group">
                        {!! Form::label('kelas', 'Kelas', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            {!! Form::text('kelas', null, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Kelas']) !!}
                        </div>
                    </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-success">Save</button> &nbsp;
                            <a class="btn btn-default" id="cancel" href="{{url('index/manajemen/kelas')}}">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
            </div>
        </div>
      </div>

@stop