(function($) {
    "use strict";

    // Spinner
    var spinner = function() {
        setTimeout(function() {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function() {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });


    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    // theme-toggle.js

    document.addEventListener('DOMContentLoaded', () => {
        const themeToggleButton = document.getElementById('theme-toggle');
        const themeStylesheet = document.getElementById('theme-stylesheet');

        // Check local storage for saved theme
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            themeStylesheet.setAttribute('href', currentTheme === 'dark' ? 'dark-mode.css' : 'styles.css');
        }

        themeToggleButton.addEventListener('click', () => {
            let newTheme = 'dark';
            if (themeStylesheet.getAttribute('href') === 'dark-mode.css') {
                newTheme = 'light';
                themeStylesheet.setAttribute('href', 'styles.css');
            } else {
                themeStylesheet.setAttribute('href', 'dark-mode.css');
            }

            // Save the selected theme in local storage
            localStorage.setItem('theme', newTheme);
        });
    });


    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

})(jQuery);
const progress = document.getElementById('progress');
const prev = document.getElementById('prev');
const next = document.getElementById('next');
const circles = document.querySelectorAll('.circle');

let currentActive = 1;

next.addEventListener('click', () => {
    currentActive++;

    if (currentActive > circles.length) {
        currentActive = circles.length;
    }

    update();
});

prev.addEventListener('click', () => {
    currentActive--;

    if (currentActive < 1) {
        currentActive = 1;
    }

    update();
});