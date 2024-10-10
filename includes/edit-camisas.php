<?php
include('conexao.php');
$sql_camisas = "SELECT * FROM produtos WHERE classificacao = 'camisa';";
$camisas = $mysqli->query($sql_camisas);
?>
<div class="section" id="camisas">
    <h1>Camisas</h1>
</div>
<div class="container">
    <?php
    while ($dados_camisas = mysqli_fetch_assoc($camisas)) {
        echo "<div class='card'>";
        echo "<div class=\"icon-left\" onclick=\"Update(" . $dados_camisas['id_produto'] . ")\"><ion-icon name=\"pencil\"></ion-icon></div>";
        echo "<div class=\"icon-right\" onclick=\"Delete(" . $dados_camisas['id_produto'] . ")\"><ion-icon name=\"trash\"></ion-icon></div>";
        echo "<h4 class='card-estoque-adm'>Estoque: " . $dados_camisas['estoque'] . "</h4>";
        echo "<img src=\"" . $dados_camisas['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
        echo "<div class='card-body'>";
        echo "<h2 class='card-title'>" . $dados_camisas['nome'] . " - " . $dados_camisas['cor_principal'] . "</h2>";
        echo "<h2 class='card-price'>R$" . $dados_camisas['preco'] . "</h2>";
        echo "<h2 class='card-subtitle'> COD PRODUTO: " . $dados_camisas['id_produto'] . "</h2>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>