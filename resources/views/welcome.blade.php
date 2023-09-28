<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
        
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        
    </head>
    <body>
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-4" src="{{ asset('assets/images/Laravel.png') }}" alt="" width="72" height="57">
            <h1 class="display-5 fw-bold">{{ env('APP_NAME') }}</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">Your Direct Line to Swift Solutions: Where Every Support Ticket Finds Its Resolution. <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quo nisi eveniet doloremque at consectetur consequatur, atque quibusdam. Delectus, non sint. Nihil aut cumque quos dolorum incidunt dolore corporis!</p>
              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                @if (Route::has('login'))
               
                    @auth
                      <a  href="{{ url('/home') }}" class="btn btn-primary btn-lg px-4 gap-3">Home</a>

                    @else
                      
                        <a  href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Log in</a>
                        
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Register</a>
                        @endif
                    @endauth
               
            @endif
                
                
              </div>
            </div>
          </div>

          <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
