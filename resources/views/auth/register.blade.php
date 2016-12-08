<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="{{ URL::to('backend/img/ico/favicon.png') }}">
    <title>Login</title>

    <!-- Base Styles -->
    <link href="{{ URL::to('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::to('backend/css/style-responsive.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ URL::to('backend/js/html5shiv.min.js') }}"></script>
    <script src="{{ URL::to('backend/js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body class="login-body">
    <h2 class="form-heading">Register</h2>
    <div class="container log-row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-signin" role="form" method="POST" action="{{ URL::to('/register') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Your Name" autofocus name="name" value="{{ old('name') }}">
                <input type="text" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}" />
                <input type="password" class="form-control" placeholder="Password" name="password" />
                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                <button class="btn btn-lg btn-success btn-block" type="submit">REGISTER</button>
            </div>
        </form>
    </div>

    <!--jquery-1.10.2.min-->
    <script src="{{ URL::to('backend/js/jquery-1.11.1.min.js') }}"></script>
    <!--Bootstrap Js-->
    <script src="{{ URL::to('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('backend/js/respond.min.js') }}"></script>
</body>
</html>