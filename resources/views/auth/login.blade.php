<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ mix('/css/app.css')}} ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UrunStok</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="login-body bg-primary" >
<style type="text/css">
    #email{
        border-radius: 10px;
    }
    #password{
        border-radius: 10px;
    }
    #button{
        border-radius: 20px;
    }
    #button:active{
        background: #1cc88a;
    }

    #div{
        border-radius:30px ;

    }
    #div2{
        margin-top: 120px;
    }
</style>
<div id="app">
    <div class="container fluid" id="div2" >

        <!-- Outer Row -->
        <div class="row justify-content-center fluid">

            <div class="col-lg-6" >

                <div class="card o-hidden border-0 shadow-lg my-5 " id="div">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="container col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hoşgeldin!</h1>
                                    </div>
                                    <form action="{{ route('login')  }}" method="post">
                                        {{ csrf_field() }}

                                        <div>
                                            @if(isset($warningMessage))
                                                @foreach($warningMessage as $message)
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email adresinizi giriniz...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Şifrenizi giiriniz...">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Hatırla beni</label>
                                            </div>
                                        </div>
                                        <button type="submit" id="button" class="btn btn-primary btn-user btn-block">
                                            Giriş
                                        </button>



                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    </div>
</div>
</body>
</html>
