<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php 
    include("includes/header.php");
    include("includes/nav.html"); 
    include("includes/home.html"); 
    include("includes/section-camisas.php"); 
    include("includes/section-logos.php"); 
    include("includes/footer.html"); 
    ?>

    <script>
        function createLogo() {
            window.location.href = "create-logo.php"
        }
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/carousel-camisas.js"></script>
    <script src="js/user-animation.js"></script>
    <script src="js/nav-animation.js"></script>
    <script src="js/header-animation.js"></script>
    <script src="js/exibir-produto.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>