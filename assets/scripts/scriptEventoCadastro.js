const btnMais = document.getElementById('btn-mais');
const alerta = document.getElementById('alerta');
const data = document.getElementById('data');
const hora_inicio = document.getElementById('hora_inicio');
const hora_termino = document.getElementById('hora_termino');
const cep = document.getElementById('cep');
const btnSubmit = document.getElementById('submit');

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


cep.addEventListener('input', () => {
    cep.value = cep.value.replace(/[a-zA-Z]/g, '');
    if (cep.value.length < 9) {
        cep.style.outlineColor = '#C64126';
    }
    else {
        cep.style.outlineColor = 'green';
    }
})

const btnLimpar = document.getElementById('reset');

btnLimpar.addEventListener('click', () => {
    document.getElementById('titulo').value = '';

    cep.value = '';
    document.getElementById('logradouro').value = '';
    document.getElementById('bairro').value = '';
    document.getElementById('categoria').value = '0';
    document.getElementById("texto-imagem").value = '';
    document.getElementById("imagem").value = '';

    document.getElementById("descricao").value = '';

    document.getElementById('titulo').focus();

    alerta.innerHTML = '';
    hora_inicio.value = '';
    hora_termino.value = '';
    data.value = '';

    document.getElementById('div-clone').innerHTML = '';

});




function desativarAlerta() {
    alerta.innerHTML = '';
}


btnMais.addEventListener('click', () => {



    if (data.value == '' || hora_inicio.value == '' || hora_termino.value == '') {
        alerta.innerHTML = 'Os campos Data, Hora de Início e Hora de Termino devem ser preenchidos.';
        return;
    }


    erro = false;
    i = 0;
    document.getElementsByName('data[]').forEach(element => {
        if (i != 0) {
            if (element.value == data.value) {
                alerta.innerHTML = 'Data duplicada.';
                erro = true;
                return;
            }
        }
        i++;
    });

    if (erro) {
        return;
    }

    if (data.value < new Date().toISOString().split('T')[0]) {
        alerta.innerHTML = 'Data inválida.';
        return;
    }

    const dataLimite = new Date(new Date().getFullYear() + 1, 0, 0);
    if (new Date(data.value) > dataLimite) {
        alerta.innerHTML = 'Data ultrapassa o prazo de um ano.';
        return;
    }

    const container = document.createElement('div');
    container.classList.add('container');
    container.classList.add('quebra');

    const containerData = document.createElement('div');
    containerData.classList.add('container');
    containerData.classList.add('div-dia');

    const containerHoraInicio = document.createElement('div');
    containerHoraInicio.classList.add('container');
    containerHoraInicio.classList.add('div-dia');

    const containerHoraTermino = document.createElement('div');
    containerHoraTermino.classList.add('container');
    containerHoraTermino.classList.add('div-dia');

    const labelData = document.createElement('label');
    labelData.innerHTML = 'Data:';

    const inputData = document.createElement('input');
    inputData.setAttribute('type', 'date');
    inputData.setAttribute('name', 'data[]');
    inputData.setAttribute('value', data.value);
    inputData.setAttribute('disabled', true);


    containerData.appendChild(labelData);
    containerData.appendChild(inputData);

    const labelHoraInicio = document.createElement('label');
    labelHoraInicio.innerHTML = 'Hora de Início:';

    const inputHoraInicio = document.createElement('input');
    inputHoraInicio.setAttribute('type', 'time');
    inputHoraInicio.setAttribute('name', 'hora_inicio[]');
    inputHoraInicio.setAttribute('value', hora_inicio.value);
    inputHoraInicio.setAttribute('disabled', true);

    containerHoraInicio.appendChild(labelHoraInicio);
    containerHoraInicio.appendChild(inputHoraInicio);

    const labelHoraTermino = document.createElement('label');
    labelHoraTermino.innerHTML = 'Hora de término:';

    const inputHoraFim = document.createElement('input');
    inputHoraFim.setAttribute('type', 'time');
    inputHoraFim.setAttribute('name', 'hora_fim[]');
    inputHoraFim.setAttribute('value', hora_termino.value);
    inputHoraFim.setAttribute('disabled', true);

    containerHoraTermino.appendChild(labelHoraTermino);
    containerHoraTermino.appendChild(inputHoraFim);

    const a = document.createElement('a');
    a.classList.add('botao');
    a.onclick = function () { this.parentNode.remove(); };

    const img = document.createElement('img');
    img.setAttribute('src', 'assets/images/fechar-login.png');
    img.classList.add('img-fechar');

    a.appendChild(img);

    const labelRemover = document.createElement('label');
    labelRemover.innerHTML = 'Remover';
    labelRemover.classList.add('label-mais');
    a.appendChild(labelRemover);


    container.appendChild(containerData);
    container.appendChild(containerHoraInicio);
    container.appendChild(containerHoraTermino);
    container.appendChild(a);

    document.getElementById('div-clone').appendChild(container);

    data.value = '';
    hora_inicio.value = '';
    hora_termino.value = '';


});

btnSubmit.addEventListener('click', (event) => {

    


}