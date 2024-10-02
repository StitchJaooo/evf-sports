function verSenha(inputClass) {
    const senha = document.querySelector(`.${inputClass}`);
    const icone = senha.nextElementSibling;

    if (senha.type === 'password') {
        senha.type = 'text';
        icone.setAttribute('name', 'eye-off');
    } else {
        senha.type = 'password';
        icone.setAttribute('name', 'eye');
    }
}