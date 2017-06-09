@extends('master')
@section('title')
<title>Update Siswa - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Update Siswa
</h1>
<ol class="breadcrumb">
    <li><a href="{{url('index/dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('index/manajemen/siswa')}}"><i class="fa fa-users"></i> Manajemen Siswa</a></li>
    <li class="active"><a> Update Siswa</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
    <div class="box-body">
        <div class="panel-body" id="kontainer">
            <div class="panel panel-default" style="border: 1px solid #346357; border-radius: 0px">
                <div class="panel-heading" style="background-color: #346357; color: white; border-radius: 0px">
                    <h3 class="panel-title"><i class="fa fa-plus"></i> Update Record</h3>
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
                    {!! Form::model($siswa, ['class' => 'form-horizontal form-label-left', 'method' => 'patch', 'action' => ['siswaController@update', $siswa->id_siswa]]) !!}<!-- start form -->
                    {!! Form::token() !!}

                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('fullname', 'Fullname ', ['class' => 'control-label col-md-offset-1 col-md-3 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-7 col-xs-12">
                                {!! Form::text('fullname', null, ['class' => 'form-control col-md-7 col-xs-12', 'rows' => '5']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('id_kelas', 'Kelas', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                {!! Form::select('id_kelas', $kelas, null, ['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('id_jurusan', 'Jurusan', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                {!! Form::select('id_jurusan', $jurusan, null, ['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('status', 'Status', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                {!! Form::select('status', [
                                '0' => 'Not active',
                                '1' => 'Active'
                                ], null, ['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-success">Save</button> &nbsp;
                            <a class="btn btn-default" id="cancel" href="{{url('index/manajemen/siswa')}}">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop