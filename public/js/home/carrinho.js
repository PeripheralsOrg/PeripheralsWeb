function submitQuant(select, id) {

    let formID = 'quantForm-' + id;
    let inputID = 'quantInput-' + id;

    let formSubmit = document.getElementById(formID);
    let inputSubmit = document.getElementById(inputID);

    inputSubmit.value = select.value;
    formSubmit.submit();
}