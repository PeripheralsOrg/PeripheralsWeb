const value = document.getElementById("value");
const input = document.getElementById("valueInput");
value.textContent = input.value;
input.addEventListener("input", (event) => {
    value.textContent = event.target.value;
});