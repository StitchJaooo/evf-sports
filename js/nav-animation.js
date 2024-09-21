const navmenu = document.querySelector(".nav-menu");
navmenu.onclick = function () {
    document.querySelector('nav').classList.toggle('ativo');
}
const sections = document.querySelectorAll('.section');
const navItems = document.querySelectorAll('.sidebar ul a li');
window.addEventListener('scroll', () => {
    let currentSection = '';

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        if (pageYOffset >= sectionTop - 60) {
            currentSection = section.getAttribute('id');
        }
    });

    navItems.forEach(li => {
        li.classList.remove('selecionado');
        if (li.getAttribute('data-section') === currentSection) {
            li.classList.add('selecionado');
        }
    });
});