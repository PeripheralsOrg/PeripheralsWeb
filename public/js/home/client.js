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