const user = document.getElementById('user');
user.onclick = function () {
    document.querySelector(".seta-user").classList.toggle("selecionado");
    document.querySelector(".config-conta").classList.toggle("selecionado");
}
user.addEventListener("mouseover", () => {
    document.querySelector(".seta-user").classList.toggle("selecionado");
})
user.addEventListener("mouseout", () => {
    document.querySelector(".seta-user").classList.toggle("selecionado");
})