let getSelect = document.getElementById("selectCategoria");
let getBox = document.querySelectorAll(".options");
getBox.forEach((box) => {
    box.style.display = 'none';
});

getSelect.addEventListener('change', () => {
    let textSelect = getSelect.options[getSelect.selectedIndex].text;
    let searchBox = document.getElementById('box' + textSelect);
    if (searchBox) {
        getBox.forEach((box) => {
            box.style.display = 'none';
        });
        searchBox.style.display = 'flex';
    }
    
})

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