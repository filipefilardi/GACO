<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GACO</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/welcome.css" rel="stylesheet">
        <!-- Styles -->
        <style>

            
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
                                <li><a href="#descubra">Descubra</a></li>
                                <li><a href="#parcerias">Parcerias</a></li>
                                <li><a href="#contato">Contato</a></li>
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
        <div class="container" id="descubra">
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
            <div class="container" id="parcerias">
                <h1 class="text-center header">Parcerias</h1>
                <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                        <a href="http://www.lassu.usp.br"><img src="/img/lassu.png" class="parcerias"></a>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <a href="{{ url('/register') }}" class="btn btn-primary join-btn">COMECE AGORA</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="contato">
            <h1 class="text-center header">Contato</h1>
            <h3 class="text-center">Nosso Contato</h3>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <a href="{{ url('/register') }}" class="btn btn-primary join-btn">COMECE AGORA</a>
                </div>
            </div>
        </div>  
    </div>
        <script src="/js/app.js"></script>
    </body>
</html>
