<?php
include('conexao.php');
$sql_camisas = "SELECT * FROM produtos WHERE classificacao = 'camisa';";
$camisas = $mysqli->query($sql_camisas);
?>
<div class="section" id="camisas">
    <p>Conheça agora as melhoras camisas de interclasse de todas as escolas deste país!!!</p>
    <h1>Camisas já feitas</h1>
</div>
<div class="slick-carousel">
    <?php
    while ($dados_camisas = mysqli_fetch_assoc($camisas)) {
        echo "<div class='card' data-id-produto=\"" . $dados_camisas['id_produto'] . "\">";
        echo "<img src=\"" . $dados_camisas['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
        echo "<div class='card-body'>";
        echo "<h2 class='card-title'>" . $dados_camisas['nome'] . " - " . $dados_camisas['cor_principal'] . "</h2>";
        echo "<h2 class='card-price'>R$" . $dados_camisas['preco'] . "</h2>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
<div id="create">
    <a href="create-camisas.php">
        <button class="flat">Crie sua camisa
            <ion-icon name="shirt"></ion-icon>
        </button>
    </a>
</div>