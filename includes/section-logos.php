<?php
include('conexao.php');
$sql_logos = "SELECT * FROM produtos WHERE  classificacao = 'logo';";
$logos = $mysqli->query($sql_logos);
?>
<div class="section" id="logos">
    <p>Veja também os melhores Escudos e Logos de interclasse de todas os campeonatos deste país!!!</p>
    <h1>Logos</h1>
    <div class="slick-carousel">
        <?php
        while ($dados_logos = mysqli_fetch_assoc($logos)) {
            echo "<div class='card exibir-logos' data-id-produto=\"" . $dados_logos['id_produto'] . "\">";
            echo "<img src=\"" . $dados_logos['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
            echo "<div class='card-body'>";
            echo "<h2 class='card-title'>" . $dados_logos['nome'] . " - " . $dados_logos['cor_principal'] . "</h2>";
            echo "<h2 class='card-price'>R$" . $dados_logos['preco'] . "</h2>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>
<div id="create">
    <button class="flat" onclick="createLogo()">Crie sua Logo
        <ion-icon name="add-circle"></ion-icon>
    </button>
</div>