<header class="scrolled">
    <ion-icon name="menu" class="nav-menu"></ion-icon>
    <a href="index.php">
        <img src="assets/logo.png" alt="">
    </a>
    <div class="usuario">
        <a href="carrinho.php"><ion-icon name="cart"></ion-icon></a>
        <ion-icon name="person-circle"></ion-icon>
        <?php
        if (!isset($_SESSION['nome'])) {
            echo "<a href=\"logout.php\"><p id=\"user\">Entrar</p></a>";
        } else {
            echo "<p id=\"user\">" . $_SESSION['nome'] . "</p>";
        }
        ?>
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