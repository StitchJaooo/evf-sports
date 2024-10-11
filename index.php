<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8"> <!-- Define o conjunto de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Configura a visualização em dispositivos móveis -->
    <title>EVF SPORTS</title> <!-- Título da página que aparece na aba do navegador -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon"> <!-- Ícone da aba do navegador -->

    <!-- Link para a fonte Arquivo Black do Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />

    <!-- Links para os estilos do slick-carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- Link para o CSS customizado do projeto -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    // Inclui os componentes do site, como cabeçalho, navegação, e seções
    include("includes/header.php"); // Inclui o cabeçalho do site
    include("includes/nav.html"); // Inclui o menu de navegação
    include("includes/home.html"); // Inclui a seção principal da página inicial
    include("includes/section-camisas.php"); // Inclui a seção que exibe as camisas
    include("includes/section-logos.php"); // Inclui a seção que exibe os logos
    include("includes/footer.html"); // Inclui o rodapé do site
    ?>

    <script>
        // Função para redirecionar o usuário para a página de criação de logo
        function createLogo() {
            window.location.href = "create-logo.php"; // Muda a URL da janela atual
        }
    </script>

    <!-- Importação do jQuery, necessário para o funcionamento do slick-carousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Importação do slick-carousel para criar carrosséis de forma fácil -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Script específico para o carrossel de camisas -->
    <script type="text/javascript" src="js/carousel-camisas.js"></script>

    <!-- Outros scripts de animação do usuário e navegação -->
    <script src="js/user-animation.js"></script>
    <script src="js/nav-animation.js"></script>
    <script src="js/header-animation.js"></script>
    <script src="js/exibir-produto.js"></script>

    <!-- Importação de ícones do Ionicons, com suporte para módulos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>