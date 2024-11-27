function abrirNav() {
    document.getElementById("navCelular").style.width = "100%";
    document.getElementById("menu-fechar").style.display = "block";
    document.getElementById("menu-abrir").style.display = "none";
}


function fecharNav() {
    document.getElementById("navCelular").style.width = "0%";
    document.getElementById("menu-fechar").style.display = "none";
    document.getElementById("menu-abrir").style.display = "block";
}

function irTopo() {
    window.scrollTo({ top: 0, behavior: 'smooth' });

}

function abrirDropdown(content) {
    const dropdownContent = document.getElementById(content);
    dropdownContent.style.display = "block";
};
