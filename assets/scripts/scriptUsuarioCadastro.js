let senha = document.getElementById('senha');
let senhaC = document.getElementById('confirmar_senha');

senhaC.addEventListener('input', validarSenha);

function validarSenha() {
    if (senha.value != senhaC.value) {
        senhaC.setCustomValidity("Senhas diferentes!");
        senhaC.reportValidity();
        return false;
    } else {
        senhaC.setCustomValidity("");
        return true;
    }
}

function TestaCPF(strCPF) {
    strCPF = strCPF.replace(/[^\d]+/g, '');
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}


function formatar(mascara, documento) {

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

const cpfAviso = document.getElementById(elementId = 'cpf-aviso');
const telefoneAviso = document.getElementById(elementId = 'telefone-aviso');
let telefone = document.getElementById('telefone');
let cpf = document.getElementById('cpf');
const btnSubmit = document.getElementById('btn-submit');


cpf.addEventListener('input', () => {
    cpfAviso.style.display = 'none';
});

telefone.addEventListener('input', () => {
    telefoneAviso.style.display = 'none';
}); 

btnSubmit.addEventListener('click', (event) => {
    let cpfValido = TestaCPF(cpf.value);
    if (!cpfValido) {
        event.preventDefault();
        cpfAviso.style.display = 'block';
    }

    if (telefone.value.length < 14) {
        event.preventDefault();
        telefoneAviso.style.display = 'block';
    }

    if (!validarSenha()) {
        event.preventDefault();
    }
});

function esconderAviso(element) {
    element.style.display = 'none';
}



