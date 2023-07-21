function openMenu() {

    // var display = document.getElementsByClassName(boxAbertaNav).style.display;
    // if (display == "none")
    //     document.getElementById(boxAbertaNav).style.display = 'block';
    // else
    // document.getElementById(boxAbertaNav).style.display = 'none';


    var boxAbertaNav = document.querySelector('.boxAbertaNav');
    var btnAbrirMenu = document.querySelector('.btnAbrirMenu');
    var btnFecharMenu = document.querySelector('.btnFecharMenu');

    boxAbertaNav.style.display = 'block';
    btnAbrirMenu.style.display = 'none';
    btnFecharMenu.style.display = 'block';
}

function closeMenu() {
    var boxAbertaNav = document.querySelector('.boxAbertaNav');
    var btnAbrirMenu = document.querySelector('.btnAbrirMenu');
    var btnFecharMenu = document.querySelector('.btnFecharMenu');

    boxAbertaNav.style.display = 'none';
    btnAbrirMenu.style.display = 'block';
    btnFecharMenu.style.display = 'none';
}

function openbar() {
    const icones = document.querySelector('#icones');
    const mobile = document.querySelector('.mobile');
    icones.onclick = function () {
        busca.classList.toggle('active')
    }
}

function openSearchMob() {
    document.getElementById("inputPesquisa").style.display = "block";
    document.getElementById("btnFecharPesquisa").style.display = "block";
    document.getElementById("btnPesquisaMB").style.display = "none";

}

function closeSearchMob() {
    document.getElementById("inputPesquisa").style.display = "none";
    document.getElementById("btnFecharPesquisa").style.display = "none";
    document.getElementById("btnPesquisaMB").style.display = "block";
}

function openSearchNav() {
    document.getElementById("inputPesquisaNav").style.display = "block";
    document.getElementById("btnFecharPesquisaNav").style.display = "block";
    document.getElementById("btnNavPesquisa").style.display = "none";
    document.getElementById("btnNavUser").style.display = "none";
    document.getElementById("btnNavFavoritos").style.display = "none";
    document.getElementById("btnNavCarrinho").style.display = "none";

}

function closeSearchNav() {
    document.getElementById("inputPesquisaNav").style.display = "none";
    document.getElementById("btnFecharPesquisaNav").style.display = "none";
    document.getElementById("btnNavPesquisa").style.display = "block";
    document.getElementById("btnNavUser").style.display = "block";
    document.getElementById("btnNavFavoritos").style.display = "block";
    document.getElementById("btnNavCarrinho").style.display = "block";

}
