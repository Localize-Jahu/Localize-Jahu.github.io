const divCategoria = document.getElementById('div-categoria');
const pesquisar = document.getElementById('pesquisar');
const opcoes = document.getElementById('opcoes');
const categoria = document.getElementById('categoria');

opcoes.addEventListener('click', function (event) {
    if (divCategoria.style.display === 'block') {
        divCategoria.style.display = 'none';
    } else {
        divCategoria.style.display = 'block';
    }
    event.preventDefault();
});

pesquisar.addEventListener('click', function () {
    if (divCategoria.style.display === 'none') {
        categoria.value = '0';
    }
});