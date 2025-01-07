let clickStartTime = 0;

function handleCardMouseDown() {
    clickStartTime = new Date().getTime();
    // Registrar o tempo inicial do clique
}

function handleCardMouseUp(event) {
    let clickEndTime = new Date().getTime();
    let clickDuration = clickEndTime - clickStartTime;
    // Registrar o tempo final do clique
    
    let id_produto = event.currentTarget.getAttribute('data-id-produto');
    // Recuperar o ID do produto do atributo `data-id-produto`

    if (clickDuration < 200) {
        exibirProduto(id_produto);
        // Se o clique durar menos de 200ms, chamar a função exibirProduto
    }
}

function attachCardEvents() {
    let cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        card.addEventListener('mousedown', handleCardMouseDown);
        card.addEventListener('mouseup', handleCardMouseUp);
    });
}

// Chamar a função ao carregar a página
window.onload = attachCardEvents;

function exibirProduto(id_produto){
    window.location.href = "produto.php?id="+id_produto;
}