const getPassword = document.getElementById('inputSenha');
const openEye = document.getElementById('openEye');
const closeEye = document.getElementById('closeEye');
closeEye.style.display = 'none';

function functionEye() {
    
    if (closeEye.style.display === 'none') {
        closeEye.style.display = 'block';
        openEye.style.display = 'none';
        getPassword.setAttribute('type', 'text');
    } else {
        closeEye.style.display = 'none';
        openEye.style.display = 'block';
        getPassword.setAttribute('type', 'password');
    }
}


