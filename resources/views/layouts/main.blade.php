<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('styles/fontawesome.css' )}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&family=Dancing+Script&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/beauty.png') }}" alt="Logo" />
            <h1>Beauty Salon</h1>

            <a class="burger" href="#"><i class="fas fa-bars"></i></a>
        </div>

        <nav>
            <a href="{{ route('welcome') }}">Home</a>
            <div class="dropdown">
                <button class="dropbtn">{{ __('OUR SERVICES') }}</button>
                <div class="dropdown-content">
                    <a href="{{ route('nailServices') }}">Nail Artist</a>
                    <a href="{{ route('hairServices') }}">Hairdresser</a>
                    <a href="{{ route('skinServices') }}">Beautician</a>
                </div>
                </div>
                
            <a href="{{ route('contact') }}">Contact us</a>
            <a class="cta" href="#">Book now</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/script.js' )}}"></script>
    @yield('scripts')
</body>
</html>
