
function esconderAviso(element) {
    element.style.display = 'none';
}


const cpfAviso = document.getElementById('cpf-aviso');
const telefoneAviso = document.getElementById('telefone-aviso');

const cpf = document.getElementById('cpf');
const btnSubmit = document.getElementById('btn-submit');

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

    if (strCPF.length != 11) return false;

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


let senha = document.getElementById('senha');
let senhaC = document.getElementById('confirmar_senha');

senhaC.addEventListener('input', validarSenha);


cpf.addEventListener('input', () => {
    cpfAviso.style.display = 'none';
    cpf.value = cpf.value.replace(/[a-zA-Z]/g, '');
});

const telefone = document.getElementById('telefone');

telefone.addEventListener('input', () => {
    telefoneAviso.style.display = 'none';
    telefone.value = telefone.value.replace(/[a-zA-Z]/g, '');
});     

btnSubmit.addEventListener('click', (event) => {

    let numerico = cpf.value.replace(/[^0-9]/g, '');
    let cpfValido = TestaCPF(cpf.value);
    if (!cpfValido) {
        event.preventDefault();
        cpfAviso.style.display = 'block';
    }
    if (cpf.value.length != 14) {
        event.preventDefault();
        cpfAviso.style.display = 'block';
    }

    numerico = telefone.value.replace(/[^0-9]/g, '');
    if (telefone.value.length < 14) {
        event.preventDefault();
        telefoneAviso.style.display = 'block';
    } 
    if (numerico.length != 11) {
        event.preventDefault();
        telefoneAviso.style.display = 'block';
    }

    if (!validarSenha()) {
        event.preventDefault();
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

