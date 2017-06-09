@extends('master')
@section('title')
<title>Update Soal - UJIAN ONLINE</title>
@stop
@section('css')
<style type="text/css">
label {
font-size: 12px;
}
textarea {margin-top: 10px;}
.swMain .stepContainer div.content img {
width: 320px;
padding: 5px;
}
.swMain .stepContainer div.content img:hover {
cursor: pointer;
width: 320px;
padding: 5px;
}
</style>
<script>
$(document).ready(function() {
// Initialize Smart Wizard
$('#wizard').smartWizard({
transitionEffect: 'slideleft',
labelFinish:'Submit',
enableAllSteps: true,
});
});
</script>
@stop
@section('text-info')
<h1>Update Soal
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('index/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li><a href="{{url('index/manajemen/soal')}}"><i class="fa fa-hashtag"></i> Manajemen soal</a></li>
  <li class="active"><a> Update soal</a></li>
</ol>
@stop
@section('content')
<div class="box box-success">
  <div class="box-body">
    <div class="panel-body" id="kontainer">
      <div class="panel panel-default" style="border: 1px solid #346357; border-radius: 0px">
        <div class="panel-heading" style="background-color: #346357; color: white; border-radius: 0px">
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
          {!! Form::model('new App\listsoal', ['class' => 'form-horizontal form-label-left', 'method' => 'post', 'files' => 'true', 'action' => ['soalController@updateSoal', $soal->id_soal   ]]) !!}<!-- start form -->
          {!! Form::token() !!}
          <?php $i = 1;?>
          <div id="wizard" class="swMain">
            @foreach($listsoal as $soals)
            <div id="step-{{$i}}">
              <h2 class="StepTitle">{{$i}}</h2>
              <br>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-offset-3 col-md-4 col-sm-1 col-xs-12">
                    <a class='btn btn-info' href='javascript:;'>
                      Upload Images...
                      {!! Form::file('gambar[]', ['class' => 'control-label col-md-offset-2 col-md-2 col-sm-1 col-xs-12', 'style' => 'position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent']) !!}
                    </a>
                  </div>
                </div>
              </div>
              @if($soals->gambar != "")
              <center><img src="{{asset('public/admin/img/uploads/'.$soals->gambar)}}" alt="{{$soals->gambar}}"></center><br>
              @endif
              <input type="hidden" name="hidden[]" value="{{$soals->gambar}}">
              <div class="row">
                <div class="form-group">
                  {!! Form::label('pertanyaan', 'Pertanyaan', ['class' => 'control-label col-md-2 col-md-offset-1 col-sm-1 col-xs-12'])!!}
                  <div class="col-md-8 col-sm-3 col-xs-12">
                    <textarea name="pertanyaan[]" class="form-control">{{$soals->pertanyaan}}</textarea>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group">
                  {!! Form::label('a', 'A', ['class' => 'control-label col-md-2 col-md-offset-1 col-sm-1 col-xs-12'])!!}
                  <div class="col-md-8 col-sm-3 col-xs-12">
                    <textarea name="a[]" class="form-control">{{$soals->a}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  {!! Form::label('b', 'B', ['class' => 'control-label col-md-2 col-md-offset-1 col-sm-1 col-xs-12'])!!}
                  <div class="col-md-8 col-sm-3 col-xs-12">
                    <textarea name="b[]" class="form-control">{{$soals->b}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  {!! Form::label('c', 'C', ['class' => 'control-label col-md-2 col-md-offset-1 col-sm-1 col-xs-12'])!!}
                  <div class="col-md-8 col-sm-3 col-xs-12">
                    <textarea name="c[]" class="form-control">{{$soals->c}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  {!! Form::label('d', 'D', ['class' => 'control-label col-md-2 col-md-offset-1 col-sm-1 col-xs-12'])!!}
                  <div class="col-md-8 col-sm-3 col-xs-12">
                    <textarea name="d[]" class="form-control">{{$soals->d}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  {!! Form::label('jawaban', 'Kunci Jawaban', ['class' => 'control-label col-md-3 col-sm-1 col-xs-12'])!!}
                  <div class="col-md-8 col-sm-4 col-xs-12">
                    {!! Form::select('jawaban[]', [
                    'a' => 'A',
                    'b' => 'B',
                    'c' => 'C',
                    'd' => 'D'
                    ], $soals->jawaban, ['class' => 'form-control'])!!}
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <?php $i++;?>
            @endforeach
          
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop