<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link href="{{ url('/gentelella') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1>Login</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Email" value="{{ old('email') }}"
                                name="email" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                        </div>
                        <div>
                            <button class="btn btn-success btn-block submit">Log In</button>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div>
                                <h1><i class="fa fa-hospital-o"></i> Klinik ABC</h1>
                                <p>©2024 All Rights Reserved by Gentelella Alela!<br>Software Developed by Kulit Manggis
                                </p>
                            </div>
                        </div>
                    </form>


                </section>
            </div>

        </div>
    </div>
</body>

</html>



{{-- @if ($errors->any())
<div style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" required>
        @error('password')
        <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form> --}}
