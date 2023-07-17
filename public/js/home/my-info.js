const button_perfil = document.getElementById('button-perfil');
const button_pedidos = document.getElementById('button-pedidos');
const button_conta = document.getElementById('button-conta');


const box_perfil = document.getElementById('box-infos-perfil');
const box_pedidos = document.getElementById('box-infos-pedidos');
const box_conta = document.getElementById('box-infos-conta');

button_perfil.addEventListener('click', function () {
    box_perfil.classList.remove('hidden');
    box_pedidos.classList.add('hidden');
    box_conta.classList.add('hidden');

    button_perfil.classList.add('active');
    button_pedidos.classList.remove('active');
    button_conta.classList.remove('active');
});

button_pedidos.addEventListener('click', function () {
    box_perfil.classList.add('hidden');
    box_pedidos.classList.remove('hidden');
    box_conta.classList.add('hidden');

    button_perfil.classList.remove('active');
    button_pedidos.classList.add('active');
    button_conta.classList.remove('active');
});

button_conta.addEventListener('click', function () {
    box_perfil.classList.add('hidden');
    box_pedidos.classList.add('hidden');
    box_conta.classList.remove('hidden');

    button_perfil.classList.remove('active');
    button_pedidos.classList.remove('active');
    button_conta.classList.add('active');
});

