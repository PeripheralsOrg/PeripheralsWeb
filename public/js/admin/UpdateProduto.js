document.querySelectorAll("input").forEach(($input) => {
    const field = $input.dataset.js;
    $input.addEventListener(
        "input",
        (e) => {
            e.target.value = masks[field](e.target.value);
        },
        false
    );
});

let inputFiles = [];

function newInput(input) {
    var filesStr = "";

    for (let i = 0; i < input.files.length; i++) {
        inputFiles.push(input.files[i]);
        filesStr +=
            "<li>" +
            input.files[i].name +
            "<button id='btnRemoveFile' onclick='removeLi(this)'>Remover</button>" +
            "</li>";
    }


    document.getElementById("dpFiles").innerHTML += filesStr;
}


function removeLi(e) {
    inputFiles = inputFiles.filter(function (file) {
        return file.name !== e.parentNode.innerHTML.split("<button")[0];
    });
    e.parentNode.parentNode.removeChild(e.parentNode);

}

function removeAllImages() {
    document.getElementById("inputImgMultiple").value = "";
    document.getElementById("dpFiles").innerHTML = '';
}

let msgDelete = document.getElementById('msgImg');
let inputDeleteImg = document.getElementById('inputDeleteImg');
let formUpdateProduto = document.getElementById('formUpdateProduto');
let arrayImgDelete = [];


function deletarImg(id, img) {
    if (!arrayImgDelete.find(element => element === id)) {
        arrayImgDelete.push(id);
    }
    msgDelete.innerHTML = 'Para concluir o processo de exclusão da imagem ' + img + ' - <mark>Clique em atualizar</mark>';
    console.log(arrayImgDelete);
}

formUpdateProduto.addEventListener('submit', () => {
    inputDeleteImg.value = arrayImgDelete;
});