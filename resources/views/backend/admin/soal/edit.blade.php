@extends('master')
@section('title')
<title>Update Soal - UJIAN ONLINE</title>
@stop
@section('text-info')
<h1>Tambah Soal
</h1>
<ol class="breadcrumb">
    <li><a href="{{url('index/dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{url('index/manajemen/soal')}}"><i class="fa fa-hashtag"></i> Manajemen Soal</a></li>
    <li class="active"><a> Update Soal</a></li>
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
                    {!! Form::model($soal, ['class' => 'form-horizontal form-label-left', 'method' => 'patch', 'action' => ['soalController@update', $soal->id_soal]]) !!}<!-- start form -->
                    {!! Form::token() !!}
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('mapel', 'Mapel', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                {!! Form::select('mapel', $mapel, null, ['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('kelas', 'Kelas', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                {!! Form::select('kelas', $kelas, null, ['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('jumlah_soal', 'Jumlah soal', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12'])!!}
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                {!! Form::select('jumlah_soal', [
                                '10' => '10',
                                '15' => '15',
                                '20' => '20',
                                '25' => '25',
                                '30' => '30',
                                '35' => '35',
                                '40' => '40',
                                '45' => '45',
                                '50' => '50',
                                ], null, ['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-success">Buat soal</button> &nbsp;
                            <a class="btn btn-default" id="cancel" href="{{url('index/manajemen/soal')}}">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop