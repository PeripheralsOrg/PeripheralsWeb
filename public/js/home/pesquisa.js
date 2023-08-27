const value = document.getElementById("value");
const input = document.getElementById("valueInput");
value.textContent = input.value;
input.addEventListener("input", (event) => {
    value.textContent = event.target.value;
});


function submitFilter(select) {
    let value = select.options[select.selectedIndex].value;

    console.log(select.name);
    console.log(value);

    let formSubmit = document.getElementById('formFilter');
    let inputName = document.getElementById('selectName');
    let inputValue = document.getElementById('selectValue');

    inputName.value = select.name;
    inputValue.value = value;

    formSubmit.submit();
}