<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

        <script src="https://kit.fontawesome.com/68d770198c.js" crossorigin="anonymous"></script>

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/scripts.js') }}"></script>
    </head>
    <body>
        @yield('content')

        <footer>
            <div id="footer-content">
                <div id="footer-about">
                    <h1>SOBRE A LET'S CODE</h1>
                    <p>Como alternativa viável e de baixo custo para informatização de estacionamentos surgiu a Let's Park, uma empresa 100% dedicada a desenvolver um sistema facilitado de estacionamento.</p>
                    <p>Há mais de 10 anos tornando estacionamentos mais eficientes e gestores mais eficazes, abastecendo-os com informações privilegiadas sobre seu negócio, além de oferecer controle e segurança para todos envolvidos.</p>
                </div>
                <div id="footer-social-media">
                    <a href="#" class="footer-link" id="instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="footer-link" id="facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="footer-link" id="whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            <div id="footer-copyright">
                &#169
                2023 all rights reserved
            </div>
        </footer>
    </body>
</html>
