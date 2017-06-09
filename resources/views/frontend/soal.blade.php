@extends('master-siswa')
@section('title')
<title>Lembar Soal</title>
@stop
@section('css')
<style>
input[type="checkbox"], input[type="radio"] {
    margin: 4px 4px 0px;
    line-height: normal;
}
.image:hover {
    width: 20px;
}
body {
  background-color:#fefaec;
}
.input-radio {
  margin-top: 10px;
}
.pertanyaan {
  text-align:justify;
}
</style>
<?php
if(Session::has('mulai_waktu')){
 $telah_berlalu = time() - Session::get('mulai_waktu');
 }
else {
 Session::put('mulai_waktu', time());
 $telah_berlalu = 0;
 }
?>
<script type="text/javascript">
function setActiveBox($name, $value) {
    if(!($radioButton instanceof jQuery)) {
        $radioButton = $($radioButton);
    }
    
    var name = $name;
    var value = $value;
    saveData(name,value);    
}
function saveData(key,value) {
       localStorage.setItem(key,value) || (document.cookie = key + "=" + value);
}

function getData(key) {
    return localStorage.getItem(key) || document.cookie.match(new RegExp(key + "\=(.+?)(?=;)"))[1];
}
  $(document).ready(function() {
      // Initialize Smart Wizard
        $('#wizard').smartWizard({
        transitionEffect: 'slideleft',
        labelFinish:'Submit',
        enableAllSteps: true, 
    });
  }); 
</script>
</head>
@stop

@section('content')


 {!! Form::open(['url' => '/ujian/'.$id_ujian, 'method' => 'post','name' => 'formUjian']) !!}


<div id="wizard" class="swMain">

  <?php $i = 1;?>
 
  @foreach($soal as $list)
    <div id="step-{{$i}}">   
      <h2 class="StepTitle">{{$i}}</h2>
      <div class="pertanyaan">{!!$list->pertanyaan.'<br>'!!}</div>
      @if($list->gambar != "")
        <center><img src="{{asset('public/admin/img/uploads/'.$list->gambar)}}" alt="{{$list->gambar}}"></center><br>
      @endif
      <script>

        
      </script>
      <div class="row">
      <div class="col-md-6 input-radio">
      <div class="col-md-1">
        {!!'<input type="radio" no="'.$list->id_listsoal.'" name="soal['.$list->id_listsoal.']" value="a"'!!}
        @if(Cookie::get('soal['.$list->id_listsoal.']') == 'a')
            {{'checked'}}
        @endif
        {!!'>'!!}
        </div>
        <div class="col-md-11">
        {{$list->a}}
        </div>
      </div>

      <div class="col-md-6 input-radio">
      <div class="col-md-1">
        {!!'<input type="radio" no="'.$list->id_listsoal.'" name="soal['.$list->id_listsoal.']" value="b"'!!}
        @if(Cookie::get('soal['.$list->id_listsoal.']') == 'b')
            {{'checked'}}
        @endif
        {!!'>'!!}
        </div>
        <div class="col-md-11">
        {{$list->b}}
        </div>
      </div>
      </div>

      <div class="row">
      <div class="col-md-6 input-radio">
      <div class="col-md-1">
        {!!'<input type="radio" no="'.$list->id_listsoal.'" name="soal['.$list->id_listsoal.']" value="c"'!!}
        @if(Cookie::get('soal['.$list->id_listsoal.']') == 'c')
            {{'checked'}}
        @endif
        {!!'>'!!}
        </div>
        <div class="col-md-11">
        {{$list->c}}
        </div>
      </div>

      <div class="col-md-6 input-radio">
      <div class="col-md-1">
        {!!'<input type="radio" no="'.$list->id_listsoal.'" name="soal['.$list->id_listsoal.']" value="d"'!!}
        @if(Cookie::get('soal['.$list->id_listsoal.']') == 'd')
            {{'checked'}}
        @endif
        {!!'>'!!}
        </div>
        <div class="col-md-11">
        {!!$list->d!!}
        </div>
      </div>
      </div>

        <script>
        
            $(document).ready(function(){

            $('#wizard').smartWizard('setError',{stepnum:{{$i}},iserror:true});
              $('.buttonNext').click(function() {
                if($("input[name='soal[{{$list->id_listsoal}}]']:checked").val()) {
                   $('#wizard').smartWizard('setError',{stepnum:{{$i}},iserror:false});
                }
                else {
                  $('#wizard').smartWizard('setError',{stepnum:{{$i}},iserror:true});
                }

              });
              $('.buttonPrevious').click(function() {
                if ($("input[name='soal[{{$list->id_listsoal}}]']:checked").val()) {
                   $('#wizard').smartWizard('setError',{stepnum:{{$i}},iserror:false});
                }
                else {
                  $('#wizard').smartWizard('setError',{stepnum:{{$i}},iserror:true});
                }
              });
            });
        </script>
    </div>

        <?php $i++; ?>
@endforeach


</div>
{!!Form::close()!!}
@stop

@section('javascript')
<style>

</style>
  <script>
 var waktu = {{$waktu}};
 var sisa_waktu = waktu - <?php echo $telah_berlalu ?>;
 var longWayOff = sisa_waktu;
 var x = $('#timer').attr('data-seconds-left',longWayOff);
    $('.timer').startTimer({
      onComplete: function(){
    alert("selesai dikerjakan!");
 document.formUjian.submit();
  }
    });
</script>
<script>
    $('#pesan').fadeIn(2000);
    $('#pesan').fadeOut(2000);
$('input[type="radio"]').click(function() {
    var id_soal = $(this).attr("name");
    var checked = $(this).attr("value");
    $.ajax({
                type: "PATCH",
                url: "{{ URL('checkradio') }}",
                dataType: "json",
                data: {id_soal: id_soal, checked: checked},
                success: function(){
                    console.log('Reborn Dev is here!');
                }
            });
});   

</script>
@stop