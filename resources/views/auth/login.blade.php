
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistem Ujian Online SMKN 5 Malang - Login Siswa</title>
        <link rel="stylesheet" href="{{asset('public/login/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('public/login/template.css')}}">
        <link href="{{asset('public/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
        <script src="{{asset('public/login/jquery-1.js')}}"></script>
        <script src="{{asset('public/login/bootstrap.js')}}"></script>
    </head>
    <body>
        <div class="container-fluid">
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <form action='{{url('login')}}' autocomplete='off' method="POST" class="form-signin">
                            @include('flash::message')
                            @if (count($errors) > 0)

                            <div class="alert alert-danger"> <!-- jika ada error, tampilkan -->
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            {!!Form::token()!!}
                            <input name="id" class="form-control" placeholder="NIS" required="" autofocus="" type="text" autocomplete="off">
                            <input name="password" class="form-control" placeholder="Password" required="" type="password" autocomplete="off">
                            <p style="color:red">* Password case sensitive</p>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">ENTER</button>
                        </form>
                    </div>
                    <a href="#" class="text-center copyright">&copy; {{date('Y')}} STIKI Malang</a>
                </div>
            </div>
        </div>
</body></html>