const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
  imgItem.addEventListener('click', (event) => {
    event.preventDefault();
    imgId = imgItem.dataset.id;
    slideImage();
  });
});

function slideImage() {
  const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

  document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

let swiper = new Swiper(".pro-container", {
  slidesPerView: 3,
  spaceBetween: 22,
  loop: true,
  centerSlide: "true",
  fade: "true",
  grabCursor: "true",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    450: {
      slidesPerView: 2,
      spaceBetween: 10,
      centerSlide: false
    },
    520: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
      loop: true
    },
    1000: {
      slidesPerView: 4,
    },
  },
});


//Calculo de CEP e Prazo

let cepInput = document.getElementById("inputCalculaCep");
let buttonCep = document.querySelector(".button-cep-calc");
let valueProduto = document.getElementById("valueFreteInput");

//Elementos para exibição
let valueSedex = document.getElementById("valueSedex");
let prazoSedex = document.getElementById("prazoSedex");
let valuePAC = document.getElementById("valuePac");
let prazoPAC = document.getElementById("prazoPac");
let txtObs = document.getElementById("textObs");



cepInput.addEventListener("blur", () => {
  if (cepInput.value.length === 0) {
    buttonCep.disabled;
    console.log(cepInput.value.length);

  } else {
    buttonCep.addEventListener('click', () => {
      let cepValue = {
        cep: cepInput.value,
        value: valueProduto.value
      }

      let data = JSON.stringify(cepValue);
      //LINK DO MODEL TIRADO DA HOSPEDAGEM, PODE DAR ERRO AO TESTAR
      // let url = '../../app/model/CEP.php?cep=' + cepInput.value + '&value=' + valueProduto.value;
      let url = 'http://127.0.0.1:8000/produtos/get/produto/ ' + cepInput.value;
      let dataResponse = [];

      fetch(url, {
        method: 'POST',
        body: data,
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          // 'url': '/payment',
          "X-CSRF-Token": valueProduto.value
        },
      }).then(response => response.json())
        .then(response => {
          dataResponse = response;

          if (response[0] == false || response[1] == false) {
            txtObs.innerText = 'Ocorreu um erro ao obter o frete, por favor tente com outro CEP!';
          } else {

            valueSedex.innerText = "Sedex - Valor: R$ " + dataResponse[1]['valor'];
            valuePAC.innerText = "PAC - Valor: R$ " + dataResponse[0]['valor'];

            prazoSedex.innerText = "Prazo de Entrega: " + dataResponse[1]['prazo']
              + " Dias úteis";
            prazoPAC.innerText = "Prazo de Entrega: " + dataResponse[0]['prazo']
              + " Dias úteis";

            if (Object.entries(dataResponse[0]['obsFim']).length !== 0 && dataResponse[0]['obsFim'].constructor !== Object) {
              txtObs.innerText = dataResponse[0]['obsFim'];
            }
          }

        }).catch(error => console.log(error));
    });
  }
});
