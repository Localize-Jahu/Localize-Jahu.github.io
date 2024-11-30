
function esconderAviso(element) {
    element.style.display = 'none';
}


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
    telefoneAviso.style.display = 'none';
    telefone.value = telefone.value.replace(/[a-zA-Z]/g, '');
});     

btnSubmit.addEventListener('click', (event) => {


    numerico = telefone.value.replace(/[^0-9]/g, '');
    if (telefone.value.length < 14) {
        event.preventDefault();
        telefoneAviso.style.display = 'block';
    } 
    if (numerico.length != 11) {
        event.preventDefault();
        telefoneAviso.style.display = 'block';
    }

});

document.getElementById('reset').addEventListener('click', () => {
    document.getElementById('nome').value = '';
    document.getElementById('email').value = '';
    cpf.value = '';
    telefone.value = '';
    document.getElementById('senha').value = '';
    document.getElementById('confirmar_senha').value = '';
    document.getElementById('email-aviso').style.display = 'none';
    document.getElementById('cpf-aviso').style.display = 'none';
    document.getElementById('cpf2-aviso').style.display = 'none';
    cpfAviso.style.display = 'none';
    telefoneAviso.style.display = 'none';
    document.getElementById('nome').focus();
}); 

