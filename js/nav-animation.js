const navmenu = document.querySelector(".nav-menu");
navmenu.onclick = function(){
    document.querySelector('nav').classList.toggle('ativo');
    document.querySelector('.conteudo').classList.toggle('ativo');
}