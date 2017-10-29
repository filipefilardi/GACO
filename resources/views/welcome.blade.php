<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GACO</title>

        <link rel="icon" href="/img/planet-earth.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/gaco.css" rel="stylesheet">
        <link href="/css/welcome.css" rel="stylesheet">
        <link href="/css/footer.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!-- Styles -->
        <style>

            
        </style>

    </head>
    <body>

        <div class="header-nightsky" id="inicio">
            <div class="fade">
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
                                    <li><a href="#gaco">GACO</a></li>
                                    <li><a href="#funcionamento">Como funciona</a></li>
                                    <!-- <li><a href="#parcerias">Parcerias</a></li> -->
                                </ul>
                            </li>
                            
                            <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
                            <li><a href="{{ url('/login') }}">Entrar</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="hero">
                <h1>DESCARTE SEU E-RESÍDUO SEM SAIR DE CASA</h1>
                <div class="text-justify">
                    <p><i>Colabore com a cidade de São Paulo, dedicando apenas alguns minutos, a se tornar uma cidade mais sustentável, descartando seu resíduo eletrônico de forma prática e <b>totalmente sem custos para pessoas físicas e coletivos</b>.</i></p>
                </div>
                <a href="{{ url('/register') }}" class="btn btn-primary">COMECE AGORA</a>
                <p style="margin-top:80px;"><a href="#gaco" style="color: white; font-size: 40px"><i class="fa fa-angle-down" aria-hidden="true"></i></p></a>
            </div>
            </div>
        </div>

    <div class="content">
    <div class="marketing">
        <div class="container" id="gaco">
            <div class="fade">
            <h1 class="text-center header">GACO</h1>
            <div class="right-text text-justify" style="font-size: 19px;">
                
                <div class="wrapper">
                    <iframe src="https://www.youtube.com/embed/fe_Xx49nODc" frameborder="0" allowfullscreen></iframe>
                </div>

                <p style="margin-top: 30px; padding-bottom: 40px">O Projeto GACO surgiu em 2015 tendo como objetivo reduzir o impacto dos resíduos eletroeletrônicos na cidade de São Paulo. Assim, a equipe buscou desenvolver uma plataforma capaz de conectar e comunicar pessoas que desejam descartar seus resíduos de forma apropriada e algumas cooperativas de reciclagem que são capacitadas a destinar corretamente esses resíduos.<p>

            </div>
            </div>
        </div>        
    </div>
    
    <div class="marketing">
        <div class="gray-background">
        <div class="container" id="funcionamento">
        <div class="fade">
            <h1 class="text-center header">Como funciona</h1>
            <div class="row" style="font-size: 15px;">
                <div class="text-justify">
                    <div class="col-lg-4">
                        <img src="/img/file.png" alt="Agendamento" width="180" height="180">
                        <h2>Agendamento</h2>
                        <p>Através do GACO, você pode se comunicar com as cooperativas parceiras, escolhendo qual resíduo eletrônico você deseja doar gratuitamente e agendando sua coleta.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="/img/laptop.png" alt="Coleta" width="180" height="180">
                        <!-- <h2>Logistica Reversa</h2> -->
                        <h2>Coleta</h2>
                       <!--  <p>A cooperativa é capacitada no manuseio do seu equipamento de forma responsável e irá coletar seu resíduo assim que possível.</p> -->
                       <p>Após o agendamento, será realizada a coleta, feita por cooperativas capacitadas tecnicamente para receber, separar, descartar e destinar resíduos eletroeletrônicos de modo ambientalmente responsável.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="/img/planet-earth.png" alt="Colaboratividade" width="180" height="180">
                        <h2>Colaboratividade</h2>
                        <p>O GACO é software livre, entre no nosso  <a href="https://github.com/filipefilardi/GACO" target="_blank" style="color: #385169;">repositório</a> para entender como você pode colaborar ainda mais com a sustentabilidade ambiental na cidade de São Paulo.</p>
                    </div>
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
        </div>
<!-- 
        <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-block">
                    <h3 class="card-title">Special title treatment</h3>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-block">
                    <h3 class="card-title">Special title treatment</h3>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>
        </div> -->

    

<!-- 
        <div class="fade">
        <div class="white-background">
            <div class="container" id="parcerias">
                <h1 class="text-center header">Parcerias</h1>
                <div class="row">
                    <div class="col-lg-3">
                        <a href="http://www.lassu.usp.br"><img src="/img/lassu_logo.png" class="img-responsive img-parcerias"></a>
                    </div>
                    <div class="col-lg-3">
                        <a href="http://www.institutogea.org.br/"><img src="/img/igea_logo.png" class="img-responsive img-parcerias"></a>
                    </div>
                    <div class="col-lg-3">
                        <a href="https://www.facebook.com/COOPERECIFAVELA"><img src="/img/recifavela_logo.png" class="img-responsive img-parcerias"></a>
                    </div>
                    <div class="col-lg-3">
                        <a href="https://www.coopernovacotiarecicla.com/"><img src="/img/coopernova_logo.png" class="img-responsive img-parcerias"></a>
                    </div>
                </div>
            </div>
        </div>
        </div> -->
<!-- 
        <div class="container" id="contato">
            <h1 class="text-center header">Contato</h1>
            <h3 class="text-center">Nosso Contato</h3>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-block" style="margin-bottom:15px;">COMECE AGORA</a>
                </div>
            </div>
        </div>
         -->  
    </div>

    </content>
    
    <div id="app"></div>

    <footer class="footer-distributed">
        <div class="footer-right">

            <a href="https://www.facebook.com/gaco.sp" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://github.com/filipefilardi/GACO" target="_blank"><i class="fa fa-github"></i></a>
                
            </div>

            <div class="footer-left">

                <p class="footer-links">
                    <a href="#inicio">INÍCIO</a>
                    ·
                    <a href="#gaco">GACO</a>
                    ·
                    <a href="#funcionamento">COMO FUNCIONA</a>
                    <!-- ·
                    <a href="#parcerias">Parcerias</a>
                 -->
                    <!-- <div class="footer-logo">>
                        <a href="http://www.lassu.usp.br"><img src="/img/lassu_logo.png" class="img-responsive img-parcerias"></a>
                        <a href="http://www.lassu.usp.br"><img src="/img/lassu_logo.png" class="img-responsive img-parcerias"></a>
                        <a href="http://www.lassu.usp.br"><img src="/img/lassu_logo.png" class="img-responsive img-parcerias"></a>
                        <a href="http://www.lassu.usp.br"><img src="/img/lassu_logo.png" class="img-responsive img-parcerias"></a>
                    </div> -->

                </p>

                <p>GACO &copy; 2017</p>
            </div>
    </footer>

        <script src="/js/app.js"></script>
    </body>
    <script type="text/javascript">
        $(window).on("load",function() {
          function fade(pageLoad) {
            var windowTop=$(window).scrollTop(), windowBottom=windowTop+$(window).innerHeight();
            var min=0.3, max=1, threshold=0.01;
            
            $(".fade").each(function() {
              /* Check the location of each desired element */
              var objectHeight=$(this).outerHeight(), objectTop=$(this).offset().top, objectBottom=$(this).offset().top+objectHeight;
              
              /* Fade element in/out based on its visible percentage */
              if (objectTop < windowTop) {
                if (objectBottom > windowTop) {$(this).fadeTo(0,min+((max-min)*((objectBottom-windowTop)/objectHeight)));}
                else if ($(this).css("opacity")>=min+threshold || pageLoad) {$(this).fadeTo(0,min);}
              } else if (objectBottom > windowBottom) {
                if (objectTop < windowBottom) {$(this).fadeTo(0,min+((max-min)*((windowBottom-objectTop)/objectHeight)));}
                else if ($(this).css("opacity")>=min+threshold || pageLoad) {$(this).fadeTo(0,min);}
              } else if ($(this).css("opacity")<=max-threshold || pageLoad) {$(this).fadeTo(0,max);}
            });
          } fade(true); //fade elements on page-load
          $(window).scroll(function(){
            fade(false);}
            ); //fade elements on scroll
        });
    </script>
</html>
