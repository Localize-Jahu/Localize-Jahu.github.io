document.getElementById('imagem').addEventListener('change', (event) => {
    document.getElementById('texto-imagem').value = event.target.files[0].name;
})

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

const cep = document.getElementById('cep');

cep.addEventListener('input', () => {
    cep.value = cep.value.replace(/[a-zA-Z]/g, '');
})

