<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GACO') }}</title>

    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="jquery.maskedinput.js" type="text/javascript"></script>
    <link href="/css/app.css" rel="stylesheet">
    @yield('stylesheet')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @if(Auth::guest())
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'GACO') }}
                        </a>
                    @else
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            {{ config('app.name', 'GACO') }}
                        </a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if(Auth::guest())
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>
                    @else
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li><a href="{{ url('/request') }}">Coleta</a></li>
                            <li><a href="{{ url('/home') }}">Cooperativas</a></li>
                            <li><a href="{{ url('/garbage') }}">Lixo Eletrônico</a></li>
                            <li><a href="{{ url('/home') }}">Parcerias</a></li>
                            <li><a href="{{ url('/home') }}">Contate-nos</a></li>
                            @if(Auth::user()->id_cat == 4)
                                <!-- Apenas para administradores -->
                                <li><a href="{{ url('/admin') }}">Painel do Administrador</a></li>
                            @endif
                            <!-- Só se não tiver sido completado -->
                            @if(!Auth::user()->isComplete())
                                @if(Auth::user()->id_cat == 1 || Auth::user()->id_cat == 2)
                                    <li><a href="{{ url('/complete_registration') }}">Complete seu Cadastro</a></li>
                                @endif
                            @endif
                            @if(Auth::user()->id_cat == 4)
                                <li><a href="{{ url('/complete_registration') }}">Complete seu Cadastro</a></li>
                            @endif
                        </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
                            <li><a href="{{ url('/login') }}">Entrar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Sair
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
