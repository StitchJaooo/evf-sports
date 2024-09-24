const navmenu = document.querySelector(".nav-menu");
navmenu.onclick = function () {
    document.querySelector('nav').classList.toggle('ativo');
    document.querySelector('.usuario').classList.toggle('ativo');
}
const sections = document.querySelectorAll('.section'); //home, camisas, bandeiras, logos
const navItems = document.querySelectorAll('.sidebar ul a li');
const vetorSections = ["home", "camisas", "bandeiras", "logos"];

window.addEventListener('scroll', () => {
    let currentSection = '';
    let nextSection = null;

    sections.forEach((section, index) => {
        const sectionTop = section.offsetTop;
        if (pageYOffset >= sectionTop - 60) {
            currentSection = section.getAttribute('id');
            nextSection = sections[index + 1];
        }
    });

    navItems.forEach(li => {
        li.classList.remove('selecionado');
        if (li.getAttribute('data-section') === currentSection) {
            li.classList.add('selecionado');
        }
    });

    if (nextSection) {
        if (nextSection=="home") {
            nextSection.style.animation="5s Surgir ease-in-out";
        }
        nextSection.classList.add('animation-surgir');
    }
});
