var swiperProduto = new Swiper(".pro-container", {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: false,
    centerSlide: "true",
    fade: "true",
    grabCursor: "",
    pagination: {
        el: ".swiper-pagination-produto",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next-produto",
        prevEl: ".swiper-button-prev-produto",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1000: {
            slidesPerView: 4,
        },
    },
});
