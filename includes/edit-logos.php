<?php
include('conexao.php');
$sql_logos = "SELECT * FROM produtos WHERE  classificacao = 'logo';";
$logos = $mysqli->query($sql_logos);
?>
<div class="section" id="logos">
    <h1>Logos</h1>
    <div class="container">
        <?php
        while ($dados_logos = mysqli_fetch_assoc($logos)) {
            echo "<div class='card'>";
            echo "<div class=\"icon-left\"><ion-icon name=\"pencil\"></ion-icon></div>";
            echo "<div class=\"icon-right\" onclick=\"Delete(" . $dados_logos['id_produto'] . ")\"><ion-icon name=\"trash\"></ion-icon></div>";
            echo "<h4 class='card-estoque-adm'>Estoque: " . $dados_logos['estoque'] . "</h4>";
            echo "<img src=\"" . $dados_logos['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
            echo "<div class='card-body'>";
            echo "<h2 class='card-title'>" . $dados_logos['nome'] . " - " . $dados_logos['cor_principal'] . "</h2>";
            echo "<h2 class='card-price'>R$" . $dados_logos['preco'] . "</h2>";
            echo "<h2 class='card-subtitle'> COD PRODUTO: " . $dados_logos['id_produto'] . "</h2>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>