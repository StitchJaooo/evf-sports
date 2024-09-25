<?php include('protect.php'); ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EVF SPORTS</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
        <link rel="stylesheet" type="text/css"
            href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" type="text/css"
            href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    </head>

    <body>
        <header>
            <ion-icon name="menu" class="nav-menu"></ion-icon>
            <img src="assets/logo.png" alt="">
            <div class="usuario">
                <ion-icon name="cart"></ion-icon>
                <ion-icon name="person-circle"></ion-icon>
                <p id="user"><?php echo $_SESSION['nome']; ?>
                    <ion-icon name="chevron-forward" class="seta-user"></ion-icon>
                </p>
                <div class="config-conta">
                    <p id="myuser">Minha conta</p>
                    <div class="borda"></div>
                    <p id="exit">
                        <a style="color:red;" href="logout.php">Sair</a>
                    </p>
                </div>
            </div>
        </header>
        <nav class="sidebar">
            <ul>
                <a href="#home">
                    <li data-section="home" class="selecionado">Home</li>
                </a>
                <div class="borda"></div>
                <a href="#camisas">
                    <li data-section="camisas">Camisas</li>
                </a>
                <div class="borda"></div>
                <a href="#bandeiras">
                    <li data-section="bandeiras">Bandeiras</li>
                </a>
                <div class="borda"></div>
                <a href="#logos">
                    <li data-section="logos">Logos</li>
                </a>
                <div class="borda"></div>
                <a href="">
                    <li>Quem Somos</li>
                </a>
                <div class="borda"></div>
            </ul>
        </nav>
        <div class="section" id="home">
            <h1>Bem vindo ao nosso site!</h1>
            <h3>Encontre aqui a camiseta que é do seu jeito!</h3>
            <div class="buttons">
                <a href="#camisas">
                    <button class="flat">Coleção de camisas</button>
                </a>
                <button class="raised">Montar sua camisa</button>
            </div>
        </div>
        <div class="propaganda" id="propaganda">
            <div class="anuncio">
                <ion-icon name="car-sport" class="icons-anuncio"></ion-icon>
                <h1 class="anuncio-title">Frete Grátis</h1>
                <h3 class="anuncio-sub">Para toda zona leste - SP</h3>
            </div>
            <div class="anuncio">
                <ion-icon name="call" class="icons-anuncio"></ion-icon>
                <h1 class="anuncio-title">Suporte 24H</h1>
                <h3 class="anuncio-sub">Atendimento online a todo momento.</h3>
            </div>
            <div class="anuncio">
                <ion-icon name="refresh-outline" class="icons-anuncio"></ion-icon>
                <h1 class="anuncio-title">Dinheiro de volta</h1>
                <h3 class="anuncio-sub">Em caso de erro, tenha seu dinheiro de volta.</h3>
            </div>
        </div>
        <div class="section" id="camisas">
            <p>Conheça agora as melhoras camisas de interclasse de todas as escolas deste país!!!</p>
            <h1>Camisas já feitas</h1>
        </div>
        <div class="slick-carousel">
            <div class="card">
                <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">2° DS - AZUL</h2>
                    <h2 class="card-price">R$ 63,00</h2>
                </div>
            </div>
            <div class="card">
                <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">1° ADM - VERDE</h2>
                    <h2 class="card-price">R$ 48,00</h2>
                </div>
            </div>
            <div class="card">
                <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">ADM 2023 - ROXO</h2>
                    <h2 class="card-price">R$ 50,00</h2>
                </div>
            </div>
            <div class="card">
                <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">1° DS - ROSA</h2>
                    <h2 class="card-price">R$ 50,00</h2>
                </div>
            </div>
            <div class="card">
                <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">2° MA - LARANJA</h2>
                    <h2 class="card-price">R$ 40,00</h2>
                </div>
            </div>
            <div class="card">
                <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">MA 2023 - VERMELHO</h2>
                    <h2 class="card-price">R$ 40,00</h2>
                </div>
            </div>
        </div>
        <div id="create">
            <button class="flat">Crie sua camisa
                <ion-icon name="shirt"></ion-icon>
            </button>
        </div>
        <div class="section" id="bandeiras">
            <p>Confira as melhores Bandeiras de interclasse de todas as escolas do Brasil!</p>
            <h1>Bandeiras</h1>
            <div class="slick-carousel">
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">2° DS - AZUL</h2>
                        <h2 class="card-price">R$ 63,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">1° ADM - VERDE</h2>
                        <h2 class="card-price">R$ 48,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">ADM 2023 - ROXO</h2>
                        <h2 class="card-price">R$ 50,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">1° DS - ROSA</h2>
                        <h2 class="card-price">R$ 50,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">2° MA - LARANJA</h2>
                        <h2 class="card-price">R$ 40,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">MA 2023 - VERMELHO</h2>
                        <h2 class="card-price">R$ 40,00</h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="create">
            <button class="flat">Crie sua bandeira
                <ion-icon name="flag"></ion-icon>
            </button>
        </div>
        <div class="section" id="logos">
            <p>Veja também os melhores Escudos e Logos de interclasse de todas os campeonatos deste país!!!</p>
            <h1>Logos</h1>
            <div class="slick-carousel">
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">2° DS - AZUL</h2>
                        <h2 class="card-price">R$ 63,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">1° ADM - VERDE</h2>
                        <h2 class="card-price">R$ 48,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">ADM 2023 - ROXO</h2>
                        <h2 class="card-price">R$ 50,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">1° DS - ROSA</h2>
                        <h2 class="card-price">R$ 50,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">2° MA - LARANJA</h2>
                        <h2 class="card-price">R$ 40,00</h2>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/camisa.png" alt="Imagem do Card" class="card-img">
                    <div class="card-body">
                        <h2 class="card-title">MA 2023 - VERMELHO</h2>
                        <h2 class="card-price">R$ 40,00</h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="create">
            <button class="flat">Crie sua Logo
                <ion-icon name="add-circle"></ion-icon>
            </button>
        </div>
        <footer>
            <div class="infos">
                <div class="item-footer">
                    <h1>Sobre nós</h1>
                    <p>Somos uma empresa de confecção de camisas, bandeiras e designs, vendemos itens prontos já feitos
                        por
                        nossa empresa!</p>
                </div>
                <div class="item-footer">
                    <h1>Nossos contatos</h1>
                    <p>random@teste.com</p>
                    <p>1199999999999999</p>
                </div>
            </div>
            <p class="copy">Copyrights © 2024 - EVF SPORTS</p>
        </footer>


        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script type="text/javascript" src="js/carousel-camisas.js"></script>
        <script src="js/user-animation.js"></script>
        <script src="js/nav-animation.js"></script>
        <script src="js/header-animation.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>

    </html>