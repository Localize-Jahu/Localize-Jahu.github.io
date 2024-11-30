
function formatar(mascara, documento) {
    documento.value = documento.value.replace(/[a-zA-Z]/g, '');
    let i = documento.value.length;
    if (i < mascara.length) {
        let saida = '#';
        let texto = mascara.substring(i);
        while (texto.substring(0, 1) != saida && texto.length) {
            documento.value += texto.substring(0, 1);
            i++;
            texto = mascara.substring(i);
        }
    }
    else {
        documento.value = documento.value.substring(0, documento.value.length - 1);
    }

}




const telefone = document.getElementById('telefone');

telefone.addEventListener('input', () => {
    telefone.value = telefone.value.replace(/[a-zA-Z]/g, '');
})


document.getElementById('reset').addEventListener('click', () => {
    document.getElementById('nome_publico').value = '';
    document.getElementById('nome_publico').focus();
    document.getElementById('email_contato').value = '';
    telefone.value = '';
    document.getElementById('biografia').value = '';
    document.getElementById('website').value = '';
    document.getElementById("alerta").innerHTML = '';
});

document.getElementById('btn-submit').addEventListener('click', (event) => {


    if (document.getElementById('nome_publico').value == '') {
        event.preventDefault();
        document.getElementById("alerta").innerHTML = '* Os campos com (*) devem ser preenchidos.';
        document.getElementById('nome_publico').focus();
    }
    if (telefone.value < 14 || telefone.value != '') {
        event.preventDefault();
        telefone.focus();

    }
    let numerico = telefone.value.replace(/[^0-9]/g, '');
    if (numerico.length < 11) {
        event.preventDefault();
        telefone.focus();
    }

});

function validar(element) {

    if (!element.checkValidity()) {
        element.style.outlineColor = '#C64126';
    }
    else {
        element.style.outlineColor = 'green';
    }
};


telefone.addEventListener('input', () => {

    let numerico = telefone.value.replace(/[^0-9]/g, '');
    if (telefone.value.length < 14) {
        telefone.style.outlineColor = '#C64126';
    }
    else if (numerico.length < 11) {
        telefone.style.outlineColor = '#C64126';
    }
    else {
        telefone.style.outlineColor = 'green';
    }
});


