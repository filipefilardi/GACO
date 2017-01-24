<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/carousel.css" rel="stylesheet">
        <!-- Styles -->
        <style>

            .header-nightsky {
                color: white;
                background: url("/img/nightsky.jpg") no-repeat;
                background-size: cover;
                background-position: bottom;
                padding-bottom: 100px;
            }

            .header-nightsky .navbar-nav>li>a {
                color: white;
                font-size: 17px;
                border-radius: 10px;
            }

            .header-nightsky .navbar {
                margin-bottom: 0px;
                padding-top: 20px;
                padding-bottom: 20px;
                width: 100%;
                border-bottom:none;
                background-color: transparent;
                min-width: 300px;
                border: none;
            }

            .header-nightsky .navbar-default .navbar-nav>.open>a,
            .header-nightsky .navbar-default .navbar-nav>.open>a:focus,
            .header-nightsky .navbar-default .navbar-nav>.open>a:hover {
                color: #ccc;
                background-color: transparent;
            }

            .header-nightsky .nav>li>a:focus,
            .header-nightsky .nav>li>a:hover {
                color: #ccc;
                background-color: transparent;
            }

            .header-nightsky .navbar-nav>li {
                margin-right: 20px;
            }

            .header-nightsky .navbar-nav {
               margin-top: 12px;
            }

            .header-nightsky .navbar-toggle {
                background-color: transparent !important;
                margin-top: 20px; 
                border: 1px solid #fff;
            }

            .header-nightsky .navbar-toggle .icon-bar {
                background-color: white;
            }

            .header-nightsky .navbar-brand {
                color: white;
                font-size: 30px;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .header-nightsky .navbar-brand:hover {
                color: #ccc;
            }

            .header-nightsky .hero {
                text-align: center;
                margin-top: 80px;
                margin-bottom: 100px;
            }

            .header-nightsky .hero h1 {
                color: white;
                font-weight: bold;
                font-size: 50px;
                margin-bottom: 36px;
            }


            .header-nightsky .hero p {
                font-size: 20px;
                max-width: 660px;
                margin: 0 auto 20px;
            }

            .header-nightsky .btn-primary {
                color: #fff;
                background-color: transparent;
                border-color: #fffbfb !important;
                outline:none;
                margin-right: 20px;
                margin-top: 20px;
                font-size: 22px;
                padding: 18px 50px;
                transition:0.4s background-color;
            }

            .header-nightsky .btn-primary:hover {
                background-color:rgba(255,255,255,0.1);
            }

            .header-nightsky .btn-primary:active {
                transform:translateY(1px);
            }

            @media screen and (max-width: 767px) {

                .header-nightsky .navbar-default .navbar-nav .open .dropdown-menu>li>a{
                    color: #fff;
                    font-size: 16px;
                }

                .header-nightsky .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover{
                    color: #ccc;
                }

                .header-nightsky .navbar-collapse {
                    margin-left: 20px;
                    border-top: none;
                    box-shadow: none;
                }

                .header-nightsky .hero{
                    margin-top: 40px;
                    margin-bottom: 40px;
                }

                .header-nightsky .hero h1{
                    font-size: 42px;
                }
            }

        </style>
    </head>
    <body>

        <div class="header-nightsky">
        <nav class="navbar navbar-default">
            <div class="container">
                <a class="navbar-brand" href="#">GACO</a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Descubra</a></li>
                                <li><a href="#">Parcerias</a></li>
                                <li><a href="#">Contato</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
                        <li><a href="{{ url('/login') }}">Entrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="hero">
            <h1>Não acumule lixo eletrônico</h1>
            <p>Ajude dedicando apenas alguns minutos a cidade de São Paulo a se tornar uma cidade mais limpa e bonita, totalmente sem custos.</p>
            <a href="{{ url('/register') }}" class="btn btn-primary">COMECE AGORA</a>
            <p style="margin-top:80px;"><span class="glyphicon glyphicon-chevron-down"></span></p>
        </div>

    </div>

    <div class="marketing">
        <div class="container">
            <h1 class="text-center header">Descubra sobre GACO</h1>
            <div class="row">
                <div class="col-lg-4">
                    <img class="img-circle" src="/img/carousel_1.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2>Saúde</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                </div>
                <div class="col-lg-4">
                    <img class="img-circle" src="/img/carousel_1.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2>Logistica Reversa</h2>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                </div>
                <div class="col-lg-4">
                    <img class="img-circle" src="/img/carousel_1.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2>Sustentabilidade</h2>
                    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <a href="{{ url('/register') }}" class="btn btn-primary join-btn">COMECE AGORA</a>
                </div>
            </div>
        </div>

        <div class="white-background">
            <div class="container">
                <h1 class="text-center header">Parcerias</h1>
                <h3 class="text-center">Algo sobre as parcerias</h3>
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <a href="{{ url('/register') }}" class="btn btn-primary join-btn">COMECE AGORA</a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
        <script src="/js/app.js"></script>
    </body>
</html>
