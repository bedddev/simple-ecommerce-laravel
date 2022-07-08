var galleryThumbs = new Swiper(".gallery-thumbs", {
    spaceBetween: 5,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
        0: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        },
    },
});

var galleryTop = new Swiper(".gallery-top", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: galleryThumbs,
    },
});

let productCarouselTopWidth = $(".gallery-top").outerWidth();
$(".gallery-top").css("height", productCarouselTopWidth);

let productCarouselThumbsItemWith = $(
    ".gallery-thumbs .swiper-slide"
).outerWidth();
$(".gallery-thumbs").css("height", productCarouselThumbsItemWith);

var $easyzoom = $(".easyzoom").easyZoom();
