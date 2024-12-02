const btnMais = document.getElementById('btn-mais');
const alerta = document.getElementById('alerta');
const data = document.getElementById('data');
const hora_inicio = document.getElementById('hora_inicio');
const hora_termino = document.getElementById('hora_termino');
const cep = document.getElementById('cep');
const btnSubmit = document.getElementById('submit');
const categoria = document.getElementById('categoria');
const bairro = document.getElementById('bairro');
const logradouro = document.getElementById('logradouro');
const titulo = document.getElementById('titulo');


function confirmarExclusao(idOcorrencia, idEvento, idPromotor) {

    let diasCadastrados = document.getElementsByName('dia-cadastrado[]').length;
    if (diasCadastrados === 1) {
        alert('Não é possível excluir! \nO evento deve ter pelo menos uma data cadastrada.');
        return
    }
    if (confirm('Deseja realmente excluir este evento? \nEsta ação não poderá ser desfeita.')) {
        window.location.href = `/localize-jahu/evento/excluir?id_ocorrencia=${idOcorrencia}&id_evento=${idEvento}&id_promotor=${idPromotor}`;
    }
}

document.getElementById('imagem').addEventListener('change', (event) => {
    document.getElementById('texto-imagem').value = event.target.files[0].name;
})

function formatar(mascara, elemento) {
    let i = elemento.value.length;
    if (i < mascara.length) {
        let saida = '#';
        let texto = mascara.substring(i);
        while (texto.substring(0, 1) != saida && texto.length) {
            elemento.value += texto.substring(0, 1);
            i++;
            texto = mascara.substring(i);
        }
    }
    else {
        elemento.value = elemento.value.substring(0, elemento.value.length - 1);
    }
}


cep.addEventListener('input', () => {

    const numerico = cep.value.replace(/[^0-9]/g, '');
    cep.value = cep.value.replace(/[a-zA-Z]/g, '');
    if (cep.value.length != 9) {
        cep.style.outlineColor = '#C64126';
    }
    else if (numerico.length != 8) {
        cep.style.outlineColor = '#C64126';
    }
    else {
        cep.style.outlineColor = 'green';
    }

})

const btnLimpar = document.getElementById('reset');

btnLimpar.addEventListener('click', (event) => {
    event.preventDefault();
    window.location.reload();
    document.getElementById('titulo').focus();
});

document.addEventListener('DOMContentLoaded', () => {
    titulo.focus();
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
    document.getElementsByName('dia-cadastrado[]').forEach(element => {
        if (element.value == data.value) {
            alerta.innerHTML = 'Data duplicada.';
            erro = true;
            return;
        }
    });

    if (erro) {
        return;
    }

    if (data.value < new Date().toISOString().split('T')[0]) {
        alerta.innerHTML = 'Data inválida.';
        return;
    }

    const dataLimite = new Date(new Date().getFullYear() + 1, new Date().getMonth(), new Date().getDate());
    if (new Date(data.value) > dataLimite) {
        alerta.innerHTML = 'Data ultrapassa o prazo limite de um ano.';
        return;
    }

    const today = new Date().toISOString().split('T')[0];
    if (data.value === today) {
        alerta.innerHTML = 'Só é possivel cadastrar eventos para datas futuras.';
        return;
    }

    if (hora_inicio.value >= hora_termino.value) {
        alerta.innerHTML = 'Hora de término deve ser maior que a hora de início.';
        return;
    }


    const inicio = new Date(`1970-01-01T${hora_inicio.value}:00`);
    const termino = new Date(`1970-01-01T${hora_termino.value}:00`);
    const diferenca = (termino - inicio) / (1000 * 60); // difference in minutes
    if (diferenca < 30) {
        alerta.innerHTML = 'A diferença entre a hora de início e a hora de término deve ser de no mínimo 30 minutos.';
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
    inputData.setAttribute('value', new Date(data.value).toISOString().split('T')[0]);
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
    inputHoraFim.setAttribute('name', 'hora_termino[]');
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

categoria.addEventListener('change', () => {
    if (categoria.value != '0') {
        categoria.style.outlineColor = 'green';
    }
});

bairro.addEventListener('input', () => {
    if (bairro.checkValidity() == false) {
        bairro.style.outlineColor = '#C64126';
    }
    else {
        bairro.style.outlineColor = 'green';
    }
});

logradouro.addEventListener('input', () => {
    if (logradouro.checkValidity() == false) {
        logradouro.style.outlineColor = '#C64126';
    }
    else {
        logradouro.style.outlineColor = 'green';
    }
}
);

titulo.addEventListener('input', () => {
    if (titulo.checkValidity() == false) {
        titulo.style.outlineColor = '#C64126';
    }
    else {
        titulo.style.outlineColor = 'green';
    }
}
);


btnSubmit.addEventListener('click', (event) => {

    
    if (!titulo.checkValidity()) {
        titulo.focus();
        titulo.style.outlineColor = '#C64126';
        event.preventDefault();
        return;
    }

    if (!logradouro.checkValidity()) {
        logradouro.focus();
        logradouro.style.outlineColor = '#C64126';
        event.preventDefault();
        return;
    }

    if (!bairro.checkValidity()) {
        bairro.focus();
        bairro.style.outlineColor = '#C64126';
        event.preventDefault();
        return;
    }

    const cepNumerico = cep.value.replace(/[^0-9]/g, '');
    if (cep.value.length < 9) {
        cep.focus();
        event.preventDefault();
        return;
    }
    else if (cepNumerico.length != 8) {
        cep.focus();
        event.preventDefault();
        return;
    }

    if (categoria.value == '0') {
        categoria.focus();
        categoria.style.outlineColor = '#C64126';
        event.preventDefault();
        return;
    }

    document.getElementById('texto-imagem').disabled = false;

    const datas = document.getElementsByName('data[]');

    datas.forEach(element => {
        element.disabled = false;
    });

    document.getElementsByName('hora_inicio[]').forEach(element => {
        element.disabled = false;
    });

    document.getElementsByName('hora_termino[]').forEach(element => {
        element.disabled = false;
    });


});