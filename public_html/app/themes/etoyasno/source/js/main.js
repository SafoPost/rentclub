document.addEventListener("DOMContentLoaded", function (event) {

    // slider
    jQuery('.home-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 5000,
    });

    jQuery('.products-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 700,
        slidesToShow: 4,
        autoplay: true,
        autoplaySpeed: 5000,
    });


    // tabs
    const tabs = (tabSelector, contentSelector, activeClass) => {
        const tab = document.querySelectorAll(tabSelector),
            content = document.querySelectorAll(contentSelector);

        function hideTabContent() {
            content.forEach(item => {
                item.classList.remove(activeClass);

            });

            tab.forEach(item => {
                item.parentElement.classList.remove(activeClass);
            });
        }

        function showTabContent(i = 0) {
            content[i].classList.add(activeClass);
            tab[i].parentElement.classList.add(activeClass);
        }

        hideTabContent();
        showTabContent();

        tab.forEach((item, i) => {
            item.addEventListener('click', (e) => {
                const target = e.target;
                if (target === item || target.parentNode === item) {
                    hideTabContent();
                    showTabContent(i);
                }
            });
        });
    };
    if (document.querySelector('.map-content')) {
        tabs('.map-tabs button', '.map-content', 'active');
    }

    if (document.querySelector('.product-info-content')) {
        tabs('.product-info-tabs button', '.product-info-content', 'active');
    }


    if (document.querySelector('.ads-tabs')) {
        tabs('.tabs-header button', '.tabs-content .content', 'active');
    }
    if (document.querySelector('.orders-tabs')) {
        tabs('.orders-header button', '.tabs-content .content', 'active');
    }
});

jQuery(document).ready(function () {
    jQuery('.show-seo-block').on('click', function () {
        let seo = jQuery(this).siblings('.seo-block');
        if (jQuery(this).hasClass('active')) {
            jQuery(this).text('Читать полностью').removeClass('active');
        } else {
            jQuery(this).text('Скрыть').addClass('active');
        }
        seo.toggleClass('active').find('.hidden').slideToggle(200);
    });
    jQuery('.product-gallery .main-images').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        infinity: true,
        asNavFor: '.product-gallery .gallery-nav .thumbs-list'
    });
    jQuery('.product-gallery .gallery-nav .thumbs-list').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.product-gallery .main-images',
        arrows: true,
        dots: false,
        prevArrow: jQuery('.product-gallery .gallery-nav .left'),
        nextArrow: jQuery('.product-gallery .gallery-nav .right'),
        infinite: true,
        focusOnSelect: true
    });
    jQuery('.modal').on('click', function(e) {
        if (jQuery(e.target).closest('.modal-block').length === 0){
            closeModal();
        }
    });
});

function openModal(id, args = {}) {
    jQuery('body').addClass('overflow');
    jQuery('.modal#' + id).addClass('show');
}

function closeModal() {
    jQuery('body').removeClass('overflow');
    jQuery('.modal.show').removeClass('show');
}
